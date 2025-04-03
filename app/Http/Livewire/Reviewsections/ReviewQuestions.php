<?php

namespace App\Http\Livewire\Reviewsections;

use Livewire\Component;
use App\Models\ReviewSection;
use App\Models\ReviewQuestion;
use App\Models\SchemeInspection;
use Illuminate\Support\Facades\DB;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Log;
use App\Models\ReviewQuestionOption;
use Livewire\WithFileUploads;

class ReviewQuestions extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $schemeId;
    public $schemeName;
    public $reviewSectionTitle;
    public $reviewsectionId;
    public $answers = [];
    public $photo;
    public $remark;

    public $schemeReviewCompleted = false;

    public function save()
    {
        $validated = $this->validate([
            'answers' => ['required', 'array', 'min:'.$this->totalQuestions, 'max:'. $this->totalQuestions],
            // 'answers' => ['required'],
            'answers.*.selected_option' => ['required'],
            'remark' => ['nullable'],
            'photo' => ['nullable']
        ], [
            'answers.min' => 'All questions must be attempted',
            'answers.max' => 'All questions must be attempted',
        ]);

        // dd($validated);

        try {
            return DB::transaction(function () use ($validated) {
                $totalMarks = 0;
                
                $answersAttemped = collect($validated['answers'])->map(function ($answer) use (&$totalMarks) {
                    [$questionId, $optionId] = explode('|', $answer['selected_option']);

                    $question = ReviewQuestion::findOrFail($questionId); 
                    $option = ReviewQuestionOption::findOrFail($optionId); 
                    // $totalMarks += $question->marks;
                    $totalMarks += $option->marks;

                    return [
                        'question_id' => $question->id,
                        'question_title' => $question->question,
                        'question_mark' => $question->marks,
                        'selected_option' => $option->option,
                    ];
                })->values()->all();

                $schemeInspection = SchemeInspection::create([
                    'user_id' => auth()->id(),
                    'scheme_id' => $this->schemeId,
                    'review_section_id' => $this->reviewsectionId,
                    // 'section_marks' => $this->reviewSection?->points ?? 0,
                    'section_marks' => $totalMarks ?? 0,
                    'user_marks' => $this->reviewSection?->points ?? 0,
                    'meta' => $answersAttemped,
                    'comment' => $validated['remark']
                ]);

                if ($validated['photo']) {
                    $schemeInspection->update([
                        'photo' => $validated['photo']->storePublicly('/', 'uploads')
                    ]);
                }

                $this->schemeReviewCompleted = true;
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            $this->bannerError('Something went wrong. Please try to review again.');
            return redirect()->route('schemesReviewsectionQuestions', [
                'scheme' => $this->schemeId,
                'reviewsection' => $this->reviewsectionId
            ]);
        }
    }

    public function getReviewQuestionsProperty()
    {
        return ReviewQuestion::query()
            ->with('options')
            ->where('review_section_id', $this->reviewsectionId)
            ->orderBy('order')
            ->get();
    }

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function getSchemeInspectionProperty()
    {
        return SchemeInspection::query()
            ->where('user_id', auth()->id())
            ->where('scheme_id', $this->schemeId)
            ->where('review_section_id', $this->reviewsectionId)
            ->first();
    }

    public function getReviewSectionProperty()
    {
        return ReviewSection::findOrFail($this->reviewsectionId);
    }

    public function getTotalQuestionsProperty()
    {
        return $this->reviewQuestions->count();
    }

    public function render()
    {
        if ($this->schemeInspection) {
            $this->schemeReviewCompleted = true;
        }

        return view('livewire.reviewsections.review-questions', [
            'questions' => $this->reviewQuestions
        ]);
    }
}
