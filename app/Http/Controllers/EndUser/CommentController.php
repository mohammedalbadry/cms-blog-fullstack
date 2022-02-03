<?php

namespace App\Http\Controllers\EndUser;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Notifications\AddComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\NotificationTraits;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    use NotificationTraits;

    public $model_name = "App\Models\Comment";

    public function store(Request $request)
    {
        if(!$request->ajax()){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'user_id' => 'integer',
            'parent_id' => 'integer',
            'approval' => 'boolean',
            'body' => 'required|string'
        ]);

        if($validator->fails()){
            $res = [
                'status'=> 0,
                'message' => $validator->errors()
            ];
            return response()->json($res);
        }  else {
            $data = [
                'post_id' => $request->post_id,
                'parent_id' => $request->parent_id,
                'body' => $request->body,
            ];
            $data['user_id'] = Auth::id() ? Auth::id() : $request->user_id;

            $object = $this->model_name::create($data);

            $res = [
                'status'=> 1,
                'message' => 'تم الاضافة بنجاح سيظهر خلال لحظات',
                'data'=> $object,

            ];
            
            if($request->parent_id){

                $parent_comment =  $this->model_name::find($request->parent_id);
                $parent_user = $parent_comment->user;
    
                if($parent_user->id !== Auth::id()) {
                    $NotificationData = $this->DataNotification(
                            Auth::id(),
                            'fas fa-comment-medical',
                            'تم الرد على تعليقك',
                            $object->id
                    );
                    $this->ShortNotification('single', new AddComment($NotificationData), $parent_user);
                }
    
            } else {
                $NotificationData = $this->DataNotification(
                    Auth::id(),
                    'fas fa-comment-medical',
                    'يوجد تعليق جديد',
                    $object->id
                );
                $this->ShortNotification('multi', new AddComment($NotificationData), Admin::all());
            }
            return response()->json($res);
        }

        $res = [
                'status'=> 1,
                'message' => 'حدث خطا غير متوقع'
            ];
        return response()->json($res);

    }


    public function update(Request $request, $id)
    {
        if(!$request->ajax()){
            abort(403);
        }
        $validator = Validator::make($request->all(), [
            'body' => 'required|string'
        ]);
        if($validator->fails()){
            $res = [
                'status'=> 0,
                'message' => $validator->errors()
            ];
            return response()->json($res);
        } else {
            $data = [
                'body' => $request->body,
            ];

            $object = $this->model_name::where('id', $id)->update($data);

            $res = [
                'status'=> 1,
                'message' => 'جارى حفظ التعديلات',
                'data'=> $request->body,

            ];
            return response()->json($res);
        }
        $res = [
            'status'=> 1,
            'message' => 'حدث خطا غير متوقع'
        ];
        return response()->json($res);

    }


    public function destroy($id)
    {
        $model = $this->model_name::find($id);
        $model->delete();

        $res = [
            'status'=> 1,
            'message' => 'تم الحذف بنجاح',
        ];
        return response()->json($res);
    }
}
 