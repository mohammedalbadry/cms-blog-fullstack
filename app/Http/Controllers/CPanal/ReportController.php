<?php

namespace App\Http\Controllers\CPanal;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\BlockUser;
use App\Http\Controllers\Controller;
use App\Notifications\DeleteComment;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReportResponse;
use App\Http\Traits\NotificationTraits;

class ReportController extends Controller
{

    use NotificationTraits;

    public $page_title = "الابلاغات";
    public $model_name = "App\Models\Report";
    public $view_routh = "cpanal.report";
    public $url_redirect = 'admin/reports';

    public function index(Request $request){

        $data = $this->model_name::when($request->search, function($query) use ($request){
            return $query->where('reason', 'like', '%' . $request->search . '%');
        })->orderBy('id', 'DESC')->paginate(25);

        $title = $this->page_title;

        return view($this->view_routh . '.index',compact(['data', 'title']));
    }

    public function result(Request $request, $id){

        $data = $request->validate([
            'result' => 'required',
        ]);
        $model = $this->model_name::find($id);

        if($request->delete_comment){
            $model->comment->delete();
            $NotificationData = [
                'doer_id' => Auth::guard('admin')->id(),
                'icon' => 'fas fa-comment-slash',
                'text' => 'تم حذف تعليقك',
            ];
            $this->ShortNotification('single', new DeleteComment($NotificationData), $model->user);
        }
        if($request->block_user){
            $model->comment->user->update(array('banned_status' => 1));
            
            $NotificationData = [
                'doer_id' => Auth::guard('admin')->id(),
                'icon' => 'fas fa-ban',
                'text' => 'تم حظرك عن التعليق',
            ];
            $this->ShortNotification('single', new BlockUser($NotificationData), $model->comment->user);
        }

        $data['status'] = "تم الفحص";
        $model->update($data);
        
        $NotificationData = $this->DataNotification(
            Auth::guard('admin')->id(),
            'fas fa-exclamation-triangle',
            'تم مراجعة بلاغك',
            $model->id
        );
        $this->ShortNotification('single', new ReportResponse($NotificationData), $model->user);

        session()->flash('success', 'تم التنفيذ بنجاح');
        return redirect($this->url_redirect);
    }
}
