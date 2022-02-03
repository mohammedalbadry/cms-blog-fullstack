<?php

namespace App\Http\Controllers\CPanal;

use Illuminate\Http\Request;
use App\Notifications\BlockUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\NotificationTraits;

class UserController extends Controller
{
    use NotificationTraits;

    public $page_title = "المستخدمين";
    public $model_name = "App\Models\User";
    public $view_routh = "cpanal.user";
    public $url_redirect = 'admin/users';

    // search and show data
    public function index(Request $request)
    {
        $data = $this->model_name::when($request->search, function($query) use ($request){
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->orderBy('id', 'DESC')->paginate(25);

        $title = $this->page_title;

        return view($this->view_routh . '.index',compact(['data', 'title']));
    }

    public function block($id)
    {
        $model = $this->model_name::find($id);
        
        if($model->banned_status == 0){
            $model->update(array('banned_status' => 1));

            $NotificationData = $this->DataNotification(
                Auth::guard('admin')->id(),
                'fas fa-ban',
                'تم حظرك عن التعليق',
                null
            );
            $this->ShortNotification('single', new BlockUser($NotificationData), $model);

            session()->flash('success', 'تم الحظر بنجاح');
            return redirect($this->url_redirect);
            
        }

        $model->update(array('banned_status' => 0));

        $NotificationData = $this->DataNotification(
            Auth::guard('admin')->id(),
            'fas fa-comment-dots',
            'تم الغاء الحظر',
            null
        );
        $this->ShortNotification('single', new BlockUser($NotificationData), $model);

        session()->flash('success', 'تم الغاء الحظر بنجاح');
        return redirect($this->url_redirect);
    }
}
