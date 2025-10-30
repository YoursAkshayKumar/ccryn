<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Admin;

class HomeController extends WebAppBaseController
{

    public function dashboard()
    {
        try {
            return view('admin.pages.dashboard', []);
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage(), $ex->getTrace(), 500);
        }
    }
}
