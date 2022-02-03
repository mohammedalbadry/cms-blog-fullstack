<?php

namespace App\Http\Controllers\CPanal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTraits;

class ContactController extends Controller
{
    use NotificationTraits;

    public $page_title = "الرسائل";
    public $model_name = "App\Models\Contact";
    public $view_routh = "cpanal.contact";
    public $url_redirect = 'admin/contacts';

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
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect($this->url_redirect);
    }
}
