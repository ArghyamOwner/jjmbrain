<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Answer;
use App\Models\Campaign;
use App\Models\Question;
use App\Models\QuizScore;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\WithApiHelpers;

class QuestionAttemptController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Campaign $campaign, Request $request)
    {
        $validated = $request->validate([
            'answers' => ['required', 'array', 'min:1'],
            'answers.*.question_id' => ['required', 'exists:questions,id'],
            'answers.*.selected_option' => ['required', Rule::in(['option_1', 'option_2', 'option_3', 'option_4'])]
        ]);

        try {
            return DB::transaction(function () use ($validated, $campaign) {
                $correctAnswers = 0;
                $totalMarks = 0;
                
                $answersAttemped = collect($validated['answers'])->map(function ($answer) use (&$correctAnswers, &$totalMarks) {
                    $question = Question::find($answer['question_id']);
                    if ($question && $question->correct_answer === $answer['selected_option']) {
                        $correctAnswers += 1;
                        $totalMarks += $question->marks;
                    }

                    return [
                        'id' => strtolower((string) Str::ulid()),
                        'user_id' => auth()->id(),
                        'question_id' => $answer['question_id'],
                        'selected_option' => $answer['selected_option'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })->all();

                Answer::insert($answersAttemped);

                QuizScore::create([
                    'campaign_id' => $campaign->id,
                    'user_id' => auth()->id(),
                    'correct_answers' => $correctAnswers,
                    'score' => $totalMarks
                ]);

                return $this->respondCreated();
            });
        } catch (\Exception $e) {
            // return $e->getMessage();
            return $this->respondWithUnprocessableEntity('Something went wrong. Try again.');
        }
    }
}
