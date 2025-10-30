<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Exception;

use App\Models\Applicant;

class AuthApplicantController extends WebAppBaseController
{
    //
    public function login()
    {
        return view('front.auth.login', ['title' => 'Login']);
    }

    public function loginValidate(LoginRequest $request)
    {
        try {
            $credentials = $request->getCredentials('username', 'password');
            $username = isset($credentials['username']) ? $credentials['username'] : '';
            $password = $credentials['password'];
            $isAuthenticated = false;

            if (isset($credentials['username'])) {
                $isAuthenticated = Auth::guard('applicant')->attempt(['application_no' => $credentials['username'], 'password' => $password]);
            }

            if ($isAuthenticated) {
                // Login was successful in the step above (Auth::guard('applicant')->attempt()).
                // We just retrieve the now-authenticated user instance.
                // $applicant = Auth::guard('applicant')->user();

                $applicantData = Applicant::where('application_no', $credentials['username'])
                                ->select(['applicant_id', 'application_no', 'applicant_name', 'photo_url'])
                                ->first();


                // Check for a required field (optional safety check)
                if (isset($applicantData->applicant_id)) {
                    
                    // --- Manual Session Management ---
                    // FIX: DO NOT store the entire Eloquent model instance.
                    // Store only necessary primitive data (ID, name, application_no, etc.)
                    request()->session()->put('applicant_id', $applicantData->applicant_id);
                    request()->session()->put('applicant_details', [
                        'applicant_id' => $applicantData->applicant_id,
                        'application_no' => $applicantData->application_no,
                        'applicant_name' => $applicantData->applicant_name,
                        'photo_url' => $applicantData->photo_url,
                        // Add any other non-sensitive fields your views rely on
                    ]);
                    
                    // Assuming you have an updateLastLogin method in your Applicant model
                    // $applicant->updateLastLogin(); 

                    return $this->sendResponse('', 'Login successful.', "/applicant-dashboard");
                } else {
                    // Log out if user model is somehow incomplete
                    Auth::guard('applicant')->logout(); 
                    return $this->sendError("Sorry! Could not retrieve applicant details.", [], 401);
                }
            } else {
                // Authentication failed
                return $this->sendError("Sorry! Incorrect login details.", [], 401);
            }
        } catch (Exception $ex) {
            return $this->sendError($ex->getMessage(), [], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('applicant')->logout(); 
       Session::forget('applicant'); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect('/applicant-login');
    }
}
