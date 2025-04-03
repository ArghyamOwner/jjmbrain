<?php

namespace App\Console\Commands;

use App\Models\AssignmentTask;
use App\Traits\WithLegacyApiFcm;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ContractorTaskReminder extends Command
{
    use WithLegacyApiFcm;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:contractor-task-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userTokens = [];
        $tasks = AssignmentTask::query()
            ->with('workorder.contractor', 'task:id,task_name', 'scheme:id,name', 'user:id,name,phone')
            ->whereDate('created_at', now()->subDays(3))
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($tasks as $task) {

            $task->update([
                'last_notification_sent' => now(),
            ]);

            $userTokens = $task?->workorder?->contractor?->tokens()?->toBase()?->get('name')?->unique('name') ?? [];
            $title = "New Task Assigned";
            // $body = "You have been assigned $task?->task?->task_name for $task?->scheme?->name by $task?->user?->name ($task?->user?->phone) on $task->created_at";
            $body = "You have been assigned Task - " . $task?->task?->task_name . " for Scheme - " . $task?->scheme?->name . " by " . $task?->user?->name . " (" . $task?->user?->phone . ") on " . $task->created_at;

            foreach ($userTokens as $token) {
                if (Str::length($token->name) > 25) {
                    $this->notifyFcm($token->name, ['title' => $title, 'body' => $body]);
                }
            }

        }
    }
}
