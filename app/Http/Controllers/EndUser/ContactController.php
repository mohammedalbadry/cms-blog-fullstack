<?php

namespace App\Http\Controllers\EndUser;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ContactMessage;
use App\Http\Traits\NotificationTraits;

class ContactController extends Controller
{
    use NotificationTraits;

    public $model_name = "App\Models\Contact";

    public function index(){
        return view('enduser/contact');
    }

    //رد وحزف عند الادمن
    public function store(Request $request){

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'subject' => 'required',
        ]);

        $object = $this->model_name::create($data);

        $NotificationData = $this->DataNotification(
            Auth::id(),
            'fas fa-envelope',
            'يوجد رسالة جديدة',
            $object->id
        );
        $this->ShortNotification('multi', new ContactMessage($NotificationData), Admin::all());

        session()->flash('add', 'تم الاضافة بنجاح');
        return back();
    }
}
