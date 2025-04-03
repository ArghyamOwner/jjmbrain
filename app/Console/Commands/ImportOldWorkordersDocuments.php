<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use App\Models\Workorder;
use App\Models\Workdocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportOldWorkordersDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-old-workorders-documents';

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
                $workorders = File::json(base_path('database/workorders.json'));

                $progressBar = $this->output->createProgressBar(count($workorders));

                $this->line('Old Workorders Documents importing...');

                $progressBar->start();

                foreach ($workorders as $workorder) {
                    if (! blank($workorder['wo_pic'])) {
                        $imageUrl = 'https://jjmassam.in/crs/workorder_detail/' . $workorder['wo_pic'];
        
                        // Get the file name and extension
                        $fileName = pathinfo($imageUrl, PATHINFO_FILENAME);
                        $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
        
                        // Get the file size
                        $headers = get_headers($imageUrl, true);
                        $fileSize = isset($headers['Content-Length']) ? $headers['Content-Length'] : 0;
        
                        $originalName = $fileName .'.'. $extension;
    
                        // $fileContents = file_get_contents($imageUrl);
                        // $path = Storage::disk('workorderdocs')->put($originalName, $fileContents);
    
                        $workorderFound = Workorder::where('old_workorder_id', $workorder['id'])->first();
    
                        if ($workorderFound) {
                            Workdocument::create([
                                'workorder_id' => $workorderFound->id,
                                'name' => $fileName,
                                'path' => $originalName,
                                'size' => $fileSize,
                                'extension' => $extension,
                            ]);
     
                            $progressBar->advance();
                        }
                    }
                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            });
        } catch (\Exception $e) {
            Log::info($e);
        }
    }
}
