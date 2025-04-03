<?php

namespace App\Http\Livewire\Schemes;

use App\Models\ReviewSection;
use Livewire\Component;
use App\Models\SchemeInspection;
use App\Traits\InteractsWithSlideoverModal;

class InspectionDetails extends Component
{
    use InteractsWithSlideoverModal;

    public $inspection;
    public $reviewSectionId;
   
    protected $listeners = [
        'inspectionDetailsSlideover' => 'openModal'
    ];

    public function openModal(SchemeInspection $review)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->inspection = $review;
        $this->reviewSectionId = $review->review_section_id;
    }

    public function getReviewSectionProperty()
    {
        return ReviewSection::findOrFail($this->reviewSectionId);
    }

    public function render()
    {
        return view('livewire.schemes.inspection-details');
    }
}
