<?php

namespace App\Http\Livewire\Campaigns;

use Livewire\Component;
use App\Models\Campaign;

class Result extends Component
{
    public $campaignId;

    public function render()
    {
        $campaign = Campaign::with('questions', 'surveys')->withCount('surveys')->findOrFail($this->campaignId);

        $result = [];

        if ($campaign->surveys->isNotEmpty()) {
            foreach ($campaign->questions as $question) {

                $optionAttempts = [];
                foreach (['option_1', 'option_2', 'option_3', 'option_4'] as $option) {
                    $optionAttempts[$option] = 0;
                }

                foreach ($campaign->surveys as $survey) {

                    $questionWithOptions = collect([
                        ['option' => $question->option_1, 'attempted' => 'option_1'],
                        ['option' => $question->option_2, 'attempted' => 'option_2'],
                        ['option' => $question->option_3, 'attempted' => 'option_3'],
                        ['option' => $question->option_4, 'attempted' => 'option_4'],
                    ])->firstWhere('option', $survey['answer'][$question->question] ?? null);

                    if (isset($questionWithOptions['attempted']) && $questionWithOptions['attempted'] !== '') {
                        $optionAttempts[$questionWithOptions['attempted']]++;
                    }
                }

                foreach ($optionAttempts as $optionId => $attempts) {
                    $percentage = ($attempts / $campaign->surveys_count) * 100;
                    $result[$question->question][$optionId] = $percentage;
                }
            }
        }

        return view('livewire.campaigns.result', [
            'results' => $result,
            'resultsCount' => $campaign->surveys_count
        ]);
    }
}
