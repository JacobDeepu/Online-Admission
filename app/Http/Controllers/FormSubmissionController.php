<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class FormSubmissionController extends Controller
{
    /**
     * Print the form submission.
     */
    public function print(FormSubmission $formSubmission)
    {
        $data = [
            'title' => 'Application Form',
            'formSubmission' => $formSubmission,
            'headerPath' => 'storage/'.$formSubmission->institution->header_file_path,
        ];

        $file = Str::random(16).'.pdf';

        $pdf = Pdf::loadView('form-submissions.prints.print-'.$formSubmission->institution->code, $data);

        return $pdf->download($file);
    }
}
