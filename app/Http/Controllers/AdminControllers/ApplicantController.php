<?php

namespace App\Http\Controllers\AdminControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

use App\Models\Applicant;
use App\Models\ApplicationStatus;
use App\Models\ApplicantAddress;
use App\Models\ApplicantEducationQualification;
use App\Models\ApplicantInternship;
use App\Models\ApplicantUploadedDocument;


class ApplicantController extends WebAppBaseController
{

    public function listApplicants()
    {
        return view('admin.pages.applicant.applicant-list', []);
    }

    public function ajaxLoadApplicantList(Request $request)
    {
        try {
            $data = $request->all();
            $projectionData = array();
            $params['draw'] = $data['draw'];
            $start = $data['start'];
            $length = $data['length'];
            $orderByColNo = $data['order'][0]['column'];
            $orderByCol = $data["columns"][$orderByColNo]["name"];
            $orderByDir = $data['order'][0]['dir'];

            $orderInfo = array(
                'orderByCol' => $orderByCol,
                'orderByDir' => $orderByDir
            );

            parse_str($data['frmData'], $frmData);

            $objApplicant = new Applicant();
            $recordsTotal = $objApplicant->getCount($frmData);

            $recordsFiltered = $objApplicant->ajaxApplicantList($length, $start, $frmData, true)[0]->ApplicantCount;
            $projectionData = $objApplicant->ajaxApplicantList($length, $start, $frmData, false, $orderInfo);

            $jsonData = array(
                "draw" => intval($params['draw']),
                "recordsTotal" => intval($recordsTotal),
                "recordsFiltered" => intval($recordsFiltered),
                "data" => $projectionData
            );

            return $jsonData;
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    public function viewApplicantAddPage()
    {
        try {
            return view('admin.pages.applicant.applicant-add', []);
        } catch (\Exception $ex) {
            return redirect()->to('/admin-users')->withInput()->with('error', $ex->getMessage());
        }
    }

    public function viewApplicantEditPage($id)
    {
        $applicant = Applicant::with(['address', 'educations', 'internship', 'documents'])
            ->findOrFail($id);

        // Return to form view with existing data
        return view('admin.pages.applicant.applicant-edit', compact('applicant'));
    }

    public function deleteApplicant($applicantId)
    {
        try {
            $objApplicant = new Applicant();
            $update = $objApplicant->remove($applicantId);

            return redirect('/admin/applicants')->with('status', 'Applicant has been deleted.');
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }

    /**
     * Add or Update full applicant form in one go.
     */
    public function save(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1️⃣ Applicant Details
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('uploads/photos'), $photoName);
                $photoPath = 'uploads/photos/' . $photoName;
            } else {
                $photoPath = null;
            }

            if ($request->hasFile('signature')) {
                $signature = $request->file('signature');
                $signatureName = time() . '_' . $signature->getClientOriginalName();
                $signature->move(public_path('uploads/signatures'), $signatureName);
                $signaturePath = 'uploads/signatures/' . $signatureName;
            } else {
                $signaturePath = null;
            }

            $applicant = Applicant::updateOrCreate(
                ['application_no' => $request->application_no],
                [
                    'applicant_name' => $request->applicant_name,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'place_of_birth' => $request->place_of_birth,
                    'fathers_name' => $request->fathers_name,
                    'category' => $request->category,
                    'religion' => $request->religion,
                    'mobile_no' => $request->mobile_no,
                    'aadhaar_no' => $request->aadhaar_no,
                    'nationality' => $request->nationality,
                    'enrollment_no' => $request->enrollment_no,
                    'roll_no' => $request->roll_no,
                    'highest_degree' => $request->highest_degree,
                    'photo_url' => $photoPath,
                    'signature_url' => $signaturePath,
                    'declaration' => $request->declaration,
                ]
            );

            // Address
            ApplicantAddress::updateOrCreate(
                [
                    'applicant_id' => $applicant->applicant_id,
                ],
                [
                    'permanent_house_no' => $request->permanent_house_no,
                    'permanent_village_locality' => $request->permanent_village_locality,
                    'permanent_police_station' => $request->permanent_police_station,
                    'permanent_district' => $request->permanent_district,
                    'permanent_state' => $request->permanent_state,
                    'permanent_country' => $request->permanent_country,
                    'permanent_pin_code' => $request->permanent_pin_code,
                    'correspondence_house_no' => $request->correspondence_house_no,
                    'correspondence_village_locality' => $request->correspondence_village_locality,
                    'correspondence_police_station' => $request->correspondence_police_station,
                    'correspondence_district' => $request->correspondence_district,
                    'correspondence_state' => $request->correspondence_state,
                    'correspondence_country' => $request->correspondence_country,
                    'correspondence_pin_code' => $request->correspondence_pin_code,
                ]
            );

            // Multiple Education Records
            ApplicantEducationQualification::where('applicant_id', $applicant->id)->delete();
            if ($request->education && is_array($request->education)) {
                foreach ($request->education as $edu) {
                    ApplicantEducationQualification::create([
                        'applicant_id' => $applicant->applicant_id,
                        'qualification_name' => $edu['qualification_name'] ?? null,
                        'examining_body' => $edu['examining_body'] ?? null,
                        'institution_name' => $edu['institution_name'] ?? null,
                        'course_start_year' => $edu['course_start_year'] ?? null,
                        'course_end_year' => $edu['course_end_year'] ?? null,
                        'maximum_marks' => $edu['maximum_marks'] ?? null,
                        'obtained_marks' => $edu['obtained_marks'] ?? null,
                        'secured_percentage' => $edu['secured_percentage'] ?? null,
                        'cgpa' => $edu['cgpa'] ?? null,
                    ]);
                }
            }

            // Internship
            ApplicantInternship::updateOrCreate(
                ['applicant_id' => $applicant->applicant_id],
                [
                    'organization_name' => $request->organization_name,
                    'address' => $request->internship_address,
                    'district' => $request->internship_district,
                    'internship_start' => $request->internship_start,
                    'internship_end' => $request->internship_end,
                ]
            );

            // Required Documents
            ApplicantUploadedDocument::where('applicant_id', $applicant->applicant_id)->delete();

            if ($request->documents && is_array($request->documents)) {
                foreach ($request->documents as $doc) {
                    if (isset($doc['file_url']) && $doc['file_url'] instanceof \Illuminate\Http\UploadedFile) {

                        $file = $doc['file_url'];
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $destination = public_path('uploads/documents');

                        // Create folder if missing
                        if (!file_exists($destination)) {
                            mkdir($destination, 0775, true);
                        }

                        // Move file to public/uploads/documents
                        $file->move($destination, $fileName);

                        // Save relative path (for use with asset())
                        $filePath = 'uploads/documents/' . $fileName;

                        // Create record
                        ApplicantUploadedDocument::create([
                            'applicant_id' => $applicant->applicant_id,
                            'document_name' => $doc['document_name'],
                            'file_url' => $filePath,
                        ]);
                    }
                }
            }

            DB::commit();
            // return redirect()->back()->with('success', 'Applicant form saved successfully.');

            return $this->sendResponse(array(
                'userData' => $applicant
            ), 'Applicant form saved successfully', '/applicants');
        } catch (\Exception $e) {
            DB::rollBack();
            // return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
            return $this->sendErrorJson('', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $applicant = Applicant::findOrFail($id);

            $photoPath = $applicant->photo_url;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('uploads/photos'), $photoName);
                $photoPath = 'uploads/photos/' . $photoName;
            }

            $signaturePath = $applicant->signature_url;
            if ($request->hasFile('signature')) {
                $signature = $request->file('signature');
                $signatureName = time() . '_' . $signature->getClientOriginalName();
                $signature->move(public_path('uploads/signatures'), $signatureName);
                $signaturePath = 'uploads/signatures/' . $signatureName;
            }

            if ($request->password != '') {
                $password = Hash::make($request->application_no);
            } else {
                $password = $applicant->password;
            }

            $applicant->update([
                'applicant_name' => $request->applicant_name,
                'password' => $password,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'place_of_birth' => $request->place_of_birth,
                'fathers_name' => $request->fathers_name,
                'category' => $request->category,
                'religion' => $request->religion,
                'mobile_no' => $request->mobile_no,
                'aadhaar_no' => $request->aadhaar_no,
                'nationality' => $request->nationality,
                'enrollment_no' => $request->enrollment_no,
                'roll_no' => $request->roll_no,
                'highest_degree' => $request->highest_degree,
                'photo_url' => $photoPath,
                'signature_url' => $signaturePath,
                'declaration' => $request->declaration,
            ]);

            // Address
            ApplicantAddress::updateOrCreate(
                [
                    'applicant_id' => $applicant->applicant_id,
                ],
                [
                    'permanent_house_no' => $request->permanent_house_no,
                    'permanent_village_locality' => $request->permanent_village_locality,
                    'permanent_police_station' => $request->permanent_police_station,
                    'permanent_district' => $request->permanent_district,
                    'permanent_state' => $request->permanent_state,
                    'permanent_country' => $request->permanent_country,
                    'permanent_pin_code' => $request->permanent_pin_code,
                    'correspondence_house_no' => $request->correspondence_house_no,
                    'correspondence_village_locality' => $request->correspondence_village_locality,
                    'correspondence_police_station' => $request->correspondence_police_station,
                    'correspondence_district' => $request->correspondence_district,
                    'correspondence_state' => $request->correspondence_state,
                    'correspondence_country' => $request->correspondence_country,
                    'correspondence_pin_code' => $request->correspondence_pin_code,
                ]
            );

            // Update Education (recreate for simplicity)
            ApplicantEducationQualification::where('applicant_id', $applicant->applicant_id)->delete();
            foreach ($request->education as $edu) {
                ApplicantEducationQualification::create([
                    'applicant_id' => $applicant->applicant_id,
                    'qualification_name' => $edu['qualification_name'],
                    'examining_body' => $edu['examining_body'],
                    'institution_name' => $edu['institution_name'],
                    'course_start_year' => $edu['course_start_year'],
                    'course_end_year' => $edu['course_end_year'],
                    'maximum_marks' => $edu['maximum_marks'],
                    'obtained_marks' => $edu['obtained_marks'],
                    'secured_percentage' => $edu['secured_percentage'],
                    'cgpa' => $edu['cgpa'],
                ]);
            }

            // Update Internship
            ApplicantInternship::updateOrCreate(
                ['applicant_id' => $applicant->applicant_id],
                [
                    'organization_name' => $request->organization_name,
                    'address' => $request->internship_address,
                    'district' => $request->internship_district,
                    'internship_start' => $request->internship_start,
                    'internship_end' => $request->internship_end,
                ]
            );

            // Update Uploaded Documents (reupload if new file provided)
            foreach ($request->documents as $index => $doc) {
                if (isset($doc['file_url']) && $doc['file_url'] instanceof \Illuminate\Http\UploadedFile) {

                    $file = $doc['file_url'];
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $destination = public_path('uploads/documents');

                    // Ensure the directory exists
                    if (!file_exists($destination)) {
                        mkdir($destination, 0775, true);
                    }

                    // Move the uploaded file
                    $file->move($destination, $fileName);

                    // Relative path for database (so you can use asset())
                    $filePath = 'uploads/documents/' . $fileName;

                    // Update existing record or create new one
                    ApplicantUploadedDocument::updateOrCreate(
                        [
                            'applicant_id' => $applicant->applicant_id,
                            'document_name' => $doc['document_name'],
                        ],
                        [
                            'file_url' => $filePath,
                        ]
                    );
                }
            }
            DB::commit();

            return $this->sendResponse(array(
                'userData' => $applicant
            ), 'Applicant form updated successfully', '/applicants');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendErrorJson('', $e->getMessage());
        }
    }

    public function uploadResultView($id)
    {
        $existing = \App\Models\ApplicantResult::where('applicant_id', $id)
            ->orderByDesc('published_at')
            ->first();

        // Return to form view with existing data
        return view('admin.pages.applicant.upload-result', ['id' => $id, 'existing' => $existing]);
    }

    public function uploadResult(Request $request)
    {
        try {
            $request->validate([
                'applicant_id' => 'required|exists:applicants,applicant_id',
                'result_title' => 'required|string|max:255',
                'result_file' => 'required|file|mimes:pdf,jpg,png,doc,docx|max:5120'
            ]);

            $applicantId = $request->applicant_id;

            // Check if old result exists
            $existing = \App\Models\ApplicantResult::where('applicant_id', $applicantId)
                ->orderByDesc('published_at')
                ->first();

            if ($existing) {
                // Delete the old file from /public/uploads/results
                $oldFilePath = public_path($existing->result_file_url);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }

                // Delete old record from database
                $existing->delete();
            }

            // Upload and move new file to /public/uploads/results
            if ($request->hasFile('result_file')) {
                $file = $request->file('result_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destination = public_path('uploads/results');

                // Ensure directory exists
                if (!file_exists($destination)) {
                    mkdir($destination, 0775, true);
                }

                // Move the uploaded file
                $file->move($destination, $fileName);

                // Save relative path for DB
                $path = 'uploads/results/' . $fileName;
            }

            // Insert new record
            \App\Models\ApplicantResult::create([
                'applicant_id' => $applicantId,
                'result_title' => $request->result_title,
                'result_file_url' => $path,
                'remarks' => $request->remarks,
                'published_at' => now()
            ]);

            return $this->sendResponse([], 'Applicant result uploaded successfully', '/applicants');
        } catch (\Exception $e) {
            return $this->sendErrorJson('', $e->getMessage());
        }
    }

    public function updateApplicantStatus($applicant_id)
    {
        $applicant = Applicant::findOrFail($applicant_id);
        $statuses = ApplicationStatus::where('applicant_id', $applicant_id)
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
                    'applicant_id' => $applicant_id,
                    'step_no' => $stepNo,
                    'step_name' => $stepName,
                    'status' => 'Pending',
                ]);
            }
        }

        $statuses = ApplicationStatus::where('applicant_id', $applicant_id)->orderBy('step_no')->get();

        return view('admin.pages.applicant.applicant-update-registration-status', compact('applicant', 'statuses'));
    }

    public function updateApplicantStatusAction(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'in:Pending,Accepted,Rejected',
                'remarks' => 'nullable|string',
                'query_text' => 'nullable|string',
                'response_text' => 'nullable|string',
                'download_link' => 'nullable|file|max:5120',
            ]);

            $status = ApplicationStatus::findOrFail($id);

            if ($request->hasFile('download_link')) {
                $file = $request->file('download_link');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destination = public_path('uploads/certificates');

                // Ensure directory exists 
                if (!file_exists($destination)) {
                    mkdir($destination, 0775, true);
                }

                // Move the uploaded file
                $file->move($destination, $fileName);

                // Save relative path for DB
                $status->download_link = 'uploads/certificates/' . $fileName;
            }

            $status->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
                'query_text' => $request->query_text,
                'response_text' => $request->response_text,
                'query_date' => $request->query_text ? now() : $status->query_date,
                'response_date' => $request->response_text ? now() : $status->response_date,
            ]);

            return $this->sendResponse([], 'Application status updated successfully.', '');
        } catch (\Exception $e) {
            return $this->sendErrorJson('', $e->getMessage());
        }
    }



    // Applicant controller
}
