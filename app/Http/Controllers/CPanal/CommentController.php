<?php

namespace App\Http\Controllers\CPanal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\DeleteComment;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\NotificationTraits;

class CommentController extends Controller
{
    use NotificationTraits;

    public $page_title = "التعليقات";
    public $model_name = "App\Models\Comment";
    public $view_routh = "cpanal.comment";
    public $url_redirect = 'admin/comments';

    public function index(Request $request){

        $data = $this->model_name::when($request->search, function($query) use ($request){
            return $query->where('body', 'like', '%' . $request->search . '%');
        })->orderBy('id', 'DESC')->paginate(25);

        $title = $this->page_title;

        return view($this->view_routh . '.index',compact(['data', 'title']));
    }

    public function delete($id){
        $model = $this->model_name::find($id);
        $model->delete();

        $NotificationData = $this->DataNotification(
            Auth::guard('admin')->id(),
            'fas fa-comment-slash',
            'تم حذف تعليقك',
            null
        );
        $this->ShortNotification('single', new DeleteComment($NotificationData), $model->user);

        session()->flash('success', 'تم الحذف بنجاح');
        return redirect($this->url_redirect);
    }
}
