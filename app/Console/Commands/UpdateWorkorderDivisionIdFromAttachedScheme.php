<?php

namespace App\Console\Commands;

use App\Models\Workorder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateWorkorderDivisionIdFromAttachedScheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-workorder-division-id-from-attached-scheme';

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
        try {
            DB::transaction(function () {
                $exclude = [
                    "01h3kht9f5z32jdtz0mdnhp9v9",
                    "01h8nfr0xsga0cyme2geqcw7p2",
                    "01h906h3ts0q9zwsxdgvrznrp2",
                    "01h937bsy2n8t5kned2004z5tk",
                    "01h937q8p8mb9c9rzbsnzmeg6f",
                    "01h938azja6yqja06w7py4e2t1",
                    "01h93awsenatt5e1q3fgc56zrg",
                    "01h9q45272rmt47e6bch21z76f",
                    "01h9qantw52qpe4s230pajc0y5",
                    "01h9st908dz5rcyfs2q3z878mx",
                    "01h9ssw2101wewz518pxe6vrde",
                    "01h9t1ancjx0mrpggvtx9madsj",
                    "01h9w465b8eyqrt8rm0j0m2wab",
                    "01h9w4jd5v3nnkbf2xwgjq410j",
                    "01h9wbcg8cfckfqz6sv4sch09r",
                    "01h9weanq1e2eq574m3t8ray4n",
                    "01h9xeeh38ks3nmd26qv4hk1mf",
                    "01hbg67t8g6wxa6nkt8h56n33k",
                    "01hbzd4sywe239s08sgccr7f7x",
                    "01hbzdmq16kgcbmd79t9bhqfx0",
                    "01hemdkwckkvsswefkfr137r0t",
                ];

                $workorders = Workorder::query()
                    ->with('schemes')
                    ->whereNull('division_id')
                    ->whereNotIn('id', $exclude)
                    ->get();

                $progressBar = $this->output->createProgressBar(count($workorders));
                $this->line('Updating Workorders division id from attached schemes...');
                $progressBar->start();

                foreach ($workorders as $workorder) {
                    $workorder->update([
                        'division_id' => $workorder?->schemes?->first()?->division_id,
                    ]);
                    $progressBar->advance();
                }
                $progressBar->finish();
                $this->line('');
                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
