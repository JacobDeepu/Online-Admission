<?php

namespace App\Exports;

use App\Models\FormSubmission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FormSubmissionsExport implements FromView
{
    public $submissions;

    public function __construct($submissions)
    {
        $this->submissions = $submissions;
    }

    public function view(): View
    {
        $submissions = FormSubmission::whereIn('id', $this->submissions)->get();

        return view('form-submissions.export', [
            'submissions' => $submissions,
        ]);
    }
}
