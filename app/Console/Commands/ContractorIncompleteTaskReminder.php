<?php

namespace App\Console\Commands;

use App\Models\AssignmentTask;
use App\Traits\WithLegacyApiFcm;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ContractorIncompleteTaskReminder extends Command
{
    use WithLegacyApiFcm;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:contractor-incomplete-task-reminder';

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
        AssignmentTask::query()
            ->with('workorder.contractor', 'task:id,task_name', 'scheme:id,name', 'user:id,name,phone')
            ->where(function ($query) {
                $query->whereNull('last_notification_sent')
                    ->orWhere('last_notification_sent', '<=', Carbon::now()->subDays(3));
            })
            ->where('status', '!=', 'completed')
            ->chunk(20, function ($records) {
                foreach ($records as $record) {
                    // $record->each(function ($task) {
                        $userTokens = $record?->workorder?->contractor?->tokens()?->toBase()?->get('name')?->unique('name') ?? [];
                        $title = "New Task Assigned";
                        $body = "You have unfinished task under Scheme - " . $record?->scheme?->name . " assigned to you, kindly complete the task within the time limit";
                        foreach ($userTokens as $token) {
                            if (Str::length($token->name) > 25) {
                                $this->notifyFcm($token->name, ['title' => $title, 'body' => $body]);
                            }
                        }
                        $record->update([
                            'last_notification_sent' => now(),
                        ]);
                    // });
                }
            });

        // $tasks = AssignmentTask::query()
        //     ->with('workorder.contractor', 'task:id,task_name', 'scheme:id,name', 'user:id,name,phone')
        // // ->where('last_notification_sent', '<=', Carbon::now()->subDays(3))
        //     ->where(function ($query) {
        //         $query->whereNull('last_notification_sent')
        //             ->orWhere('last_notification_sent', '<=', Carbon::now()->subDays(3));
        //     })
        //     ->where('status', '!=', 'completed')
        //     ->get();

        // $tasks->each(function ($task) {
        //     $userTokens = $task?->workorder?->contractor?->tokens()?->toBase()?->get('name')?->unique('name') ?? [];
        //     $title = "New Task Assigned";
        //     // $body = "You have been assigned $task?->task?->task_name for $task?->scheme?->name by $task?->user?->name ($task?->user?->phone) on $task->created_at";
        //     // $body = "You have been assigned Task - " . $task?->task?->task_name . " for Scheme - " . $task?->scheme?->name . " by " . $task?->user?->name . " (" . $task?->user?->phone . ") on " . $task->created_at;
        //     $body = "You have unfinished task under Scheme - " . $$task?->scheme?->name . " assigned to you, kindly complete the task within the time limit";

        //     foreach ($userTokens as $token) {
        //         if (Str::length($token->name) > 25) {
        //             $this->notifyFcm($token->name, ['title' => $title, 'body' => $body]);
        //         }
        //     }

        //     $task->update([
        //         'last_notification_sent' => now(),
        //     ]);
        // });
    }
}
