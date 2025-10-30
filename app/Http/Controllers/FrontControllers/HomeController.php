<?php

namespace App\Http\Controllers\FrontControllers;

use App\Models\Admin;
use App\Models\Applicant;
use App\Models\ApplicationStatus;

class HomeController extends WebAppBaseController
{

    public function dashboard()
    {
        try {
            return view('front.pages.home', []);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    public function requestForPharmacistRegistration()
    {
        try {

            $applicantId = request()->session()->get('applicant_details')['applicant_id'];

            return view('front.pages.request-for-pharmacist-reg', ['applicantId' => $applicantId]);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }


    public function downloadDocumentPdf($filename)
    {
        try {
            $path = public_path('uploads/document-required/' . $filename);

            if (!file_exists($path)) {
                abort(404, 'The requested PDF file could not be found.');
            }

            $headers = [
                'Content-Type' => 'application/pdf',
            ];

            return response()->file($path, $headers);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    public function viewAppStatus($applicantId)
    {
        try {
            $applicant = Applicant::findOrFail($applicantId);
            $statuses = ApplicationStatus::where('applicant_id', $applicantId)
                ->orderBy('step_no')
                ->get();

            // Predefined steps for new applicants if missing
            $defaultSteps = [
                1 => 'Document Verification',
                2 => 'Qualification Verification Form Generation',
                3 => 'Qualification Verification Reply Uploaded',
                4 => 'Application Approved',
                5 => 'Download Certificate',
            ];

            foreach ($defaultSteps as $stepNo => $stepName) {
                if (!$statuses->where('step_no', $stepNo)->first()) {
                    ApplicationStatus::create([
                        'applicant_id' => $applicantId,
                        'step_no' => $stepNo,
                        'step_name' => $stepName,
                        'status' => 'Pending',
                    ]);
                }
            }

            $statuses = ApplicationStatus::where('applicant_id', $applicantId)->orderBy('step_no')->get();

            return view('front.pages.applicant-registration-status', compact('applicant', 'statuses'));
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    public function viewApplicantDetails($id)
    {
        $applicant = Applicant::with(['address', 'educations', 'internship', 'documents'])
            ->findOrFail($id);

        // Return to form view with existing data
        return view('front.pages.show', compact('applicant'));
    }

    //Home Controller
}
