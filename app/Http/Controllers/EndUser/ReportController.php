<?php

namespace App\Http\Controllers\EndUser;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Notifications\AddReport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\NotificationTraits;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    use NotificationTraits;

    public $model_name = "App\Models\Report";

    public function index(Request $request)
    {
        if(!$request->ajax()){
            abort(403);
        }
        $validator = Validator::make($request->all(), [
            'comment_id' => 'required',
            'user_id' => 'integer',
            'status' => 'integer',
            'reason' => 'required|string|min:5',
            'result' => 'string'
        ]);

        if($validator->fails()){
            $res = [
                'status'=> 0,
                'message' => $validator->errors()
            ];
            return response()->json($res);
        }  else {
            $data = [
                'comment_id' => $request->comment_id,
                'status' => "pending",
                'reason' => $request->reason,
            ];
            $data['user_id'] = Auth::id() ? Auth::id() : $request->user_id;

            $object = $this->model_name::create($data);
            $NotificationData = $this->DataNotification(
                Auth::id(),
                'fas fa-ban',
                'يوجد بلاغ جديد',
                $object->id
            );
            $this->ShortNotification('multi', new AddReport($NotificationData), Admin::all());

            $res = [
                'status'=> 1,
                'message' => 'تم ارسال البلاغ',

            ];
            return response()->json($res);

        }

    }
}
