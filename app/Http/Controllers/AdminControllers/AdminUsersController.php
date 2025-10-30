<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

use DateTime;
use DateTimeZone;

class AdminUsersController extends WebAppBaseController
{

	public function listAdminUsers()
	{
		return view('admin.pages.admin.admin-users', []);
	}

	public function loadAdminUserList(Request $request)
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

			$objAdmin = new Admin();
			$recordsTotal = $objAdmin->getCount($frmData);

			$recordsFiltered = $objAdmin->ajaxAdminList($length, $start, $frmData, true)[0]->AdminCount;
			$projectionData = $objAdmin->ajaxAdminList($length, $start, $frmData, false, $orderInfo);

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

	public function viewAdminUserAddPage()
	{
		try {
			return view('admin.pages.admin.admin-user-add', []);
		} catch (\Exception $ex) {
			return $ex->getMessage();
			exit();
			return redirect()->to('/admin-users')->withInput()->with('error', $ex->getMessage());
		}
	}

	public function viewAdminUserEditPage($id)
	{
		try {
			// Get Admin User
			$objAdmin = new Admin();
			$adminUser = $objAdmin->getRec($id);

			return view('admin.pages.admin.admin-user-edit', [
				'adminUser' => $adminUser,
			]);
		} catch (\Exception $ex) {
			return redirect()->to('/admin-users')->withInput()->with('error', $ex->getMessage());
		}
	}

	public function addAdminUser(Request $request)
	{
		try {
			$niceNames = array(
				'first_name' => 'First Name',
				'last_name' => 'Last Name',
				'email' => 'Email',
				'mobile' => 'Phone',
				'username' => 'Username',
				'password' => 'Password',
				'cpassword' =>  'Confirm Password',
			);

			$validate = Validator::make($request->all(), [
				'first_name'	=> 'required',
				'last_name'		=> 'required',
				'username'  => 'required|unique:admin,username',
				'email'  => 'required|email|unique:admin,email',
				'password' 		=> 'required',
				'cpassword' 	=> 'required',
				'mobile' 		=> 'required',
			], [], $niceNames);
			if ($validate->fails()) {
				return $this->sendErrorJson('', $validate->getMessageBag()->first());
			}

			$data = $request->all();

			if ($request->hasFile('image')) {
				$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
				$name_str = $date->format('dmYHis') . '_' . uniqid();

				$file = $request->file('image');
				$file_name = $file->getClientOriginalName();
				$file_ext = $file->getClientOriginalExtension();
				$file_name = '_' . $name_str . "." . $file_ext;

				$file_path = public_path() . '/assets/images/admin/profile/';
				$file->move($file_path, $file_name);
				$data['image'] = $file_name;

				if (isset($data['fileOld'])) {
					$fileOld = $data['fileOld'];
					$fileOld = $file_path . $fileOld;
					if (file_exists($fileOld) === true) {
						unlink($fileOld);
					}
				}
			} else {
				if (isset($data['fileOld']) && !empty($data['fileOld'])) {
					$data['image'] = $data['fileOld'];
				} else {
					$data['image'] = '';
				}
			}

			// Save Admin User
			$data['password_hash'] = Hash::make($data['password']);
			$data['mobile'] = $data['mobile'];
			$objAdmin = new Admin();
			$data['admin_id'] = $objAdmin->insertRec($data);
			$admin = $objAdmin->getRec($data['admin_id']);
		
			return $this->sendResponse(array(
				'userData' => $data['admin_id']
			), 'Admin was added successful!', '/admin-users');
		} catch (\Exception $ex) {
			return $this->sendErrorJson('', $ex->getMessage());
		}
	}

	public function editAdminUser(Request $request)
	{
		try {
			$id = $request->admin_id;
			$niceNames = array(
				'first_name' => 'First Name',
				'last_name' => 'Last Name',
				'email' => 'Email',
				'mobile' => 'Phone',
				'username' => 'Username',
				'password' => 'Password',
				'cpassword' =>  'Confirm password',
			);

			$validate = Validator::make($request->all(), [
				'first_name'	=> 'required',
				'last_name'		=> 'required',
				'username'  => "required|unique:admin,username,$id,admin_id",
				'email'  => "required|email|unique:admin,email,$id ,admin_id",
				'mobile' 		=> 'required',
			], [], $niceNames);


			if ($request->password !== '') {
				$validate = Validator::make($request->all(), [
					'first_name'	=> 'required',
					'last_name'		=> 'required',
					'username' 		=> "required",
					'email' 		=> 'required',
					'password' 		=> 'required',
					'cpassword' 	=> 'required',
					'mobile' 		=> 'required',
				], [], $niceNames);
			}

			if ($validate->fails()) {
				return $this->sendErrorJson('', $validate->getMessageBag()->first());
			}

			$objAdmin = new Admin();
			$objAdmin = $objAdmin->getRec($request->admin_id);

			$data = $request->all();

			// Check if entered email address and username is already present with is_delete as 1
			$email = $data['email'];
			$username = $data['username'];
			$emailRec = $objAdmin->getRecByEmail($email);
			if (isset($emailRec) == true && empty($emailRec) == false && $emailRec['admin_id'] != $data['admin_id'] && $emailRec['is_delete'] == 0) {
				return $this->sendErrorJson('', 'Email address already exists');
			}

			$usernameRec = $objAdmin->getRecByUsername($username);
			if (isset($usernameRec) == true && empty($usernameRec) == false && $usernameRec['admin_id'] != $data['admin_id'] && $usernameRec['is_delete'] == 0) {
				return $this->sendErrorJson('', 'Username already exists');
			}

			if ($request->hasFile('image')) {
				$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
				$name_str = $date->format('dmYHis') . '_' . uniqid();

				$file = $request->file('image');
				$file_name = $file->getClientOriginalName();
				$file_ext = $file->getClientOriginalExtension();
				$file_name = $data['admin_id'] . '_' . $name_str . "." . $file_ext;

				$file_path = public_path() . '/assets/images/admin/profile/';
				$file->move($file_path, $file_name);
				$data['image'] = $file_name;
				if (isset($data['fileOld'])) {
					$fileOld = $data['fileOld'];
					$fileOld = $file_path . $fileOld;
					if (file_exists($fileOld) === true) {
						unlink($fileOld);
					}
				}
			} else {
				if (isset($data['fileOld']) && !empty($data['fileOld'])) {
					$data['image'] = $data['fileOld'];
				} else {
					$data['image'] = '';
				}
			}

			// Save Admin User
			if ($request->password !== '') {
				$data['password_hash'] = Hash::make($data['password']);
			}

			$data['mobile'] = $data['mobile'];
			$data['admin_id'] = $objAdmin->updateRec($data);

			if (request()->session()->get('admin_id') == $request->admin_id) {
				request()->session()->put('image', $data['image']);
			}

			return $this->sendResponse(array(
				'admin' => $data['admin_id']
			), 'Record was updated successfully!', '/admin-users');
		} catch (\Exception $ex) {
			return $this->sendErrorJson('', $ex->getMessage());
		}
	}

	public function deleteAdminUser($admin_id)
	{
		try {

			$obj = new Admin();
			$update = $obj->remove($admin_id);

			return $this->sendResponse('', 'User Deleted Successfully.', '/admin-users');
			
		} catch (\Exception $ex) {
			return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
		}
	}


	// Admin User Controller
}
