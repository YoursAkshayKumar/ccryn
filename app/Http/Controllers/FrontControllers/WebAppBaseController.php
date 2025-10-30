<?php

namespace App\Http\Controllers\FrontControllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Admin;
use App\Models\Visitors;

use Illuminate\Support\Facades\Config;

class WebAppBaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendResponse($result, $message, $redirect = '')
    {
        if (strlen($redirect) > 0) {
            $response = [
                'status' => 'success',
                'data'    => $result,
                'message' => $message,
                'redirect' => url($redirect),
            ];
        } else {
            $response = [
                'status' => 'success',
                'data'    => $result,
                'message' => $message,
            ];
        }

        return response()->json($response, 200);
    }


    public function sendErrorJson($result, $message, $redirect = '')
    {
        if (strlen($redirect) > 0) {
            $response = [
                'status' => 'danger',
                'data'    => $result,
                'message' => $message,
                'redirect' => url(env('ADMIN_URL_PREFIX').$redirect),
            ];
        } else {
            $response = [
                'status' => 'danger',
                'data'    => $result,
                'message' => $message,
            ];
        }

        return response()->json($response, 403);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendError($error, $errorMessages = [], $code = 403)
    {
        $response = [
            'status' => 'error',
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}
