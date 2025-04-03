<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function __invoke(Subject $subject, $tab = 'edit')
    {
        if (! collect(['edit', 'milestones', 'textbooks', 'videos'])->contains($tab)) {
            abort(404);
        }

        return view('subjects.show', [
            'tab' => $tab,
            'subjectId' => $subject->id
        ]);
    }
}
