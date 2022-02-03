<?php

namespace App\Http\Controllers\CPanal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Storage;

class SettingController extends Controller
{
    public $page_title = "الاعدادات";
    public $model_name = "App\Models\Setting";
    public $view_routh = "cpanal.setting";
    public $img_path = "/uploads/settings//";
    public $url_redirect = 'admin/setting';

    public function index()
    {
        $model = $this->model_name::first();
        $title = $this->page_title;
        return view($this->view_routh,compact(['model', 'title']));
    }

    public function update(Request $request)
    {        
        $data = $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'status' => 'required',
            'alt_text' => 'required',
        ]);

        $model = $this->model_name::orderBy('id', 'desc')->first();

        if ($files = $request->file('logo')) {  

            if($model->logo != "default.png") {      

                Storage::disk('public_uploads')->delete($this->img_path . $model->logo);

            }
            $ImageUpload = Image::make($files);
            $image_name = time().$files->getClientOriginalName();
            $ImageUpload->save(public_path() . $this->img_path . $image_name);
        
            $data['logo'] = $image_name;
        }
        if ($files = $request->file('icon')) {  

            if($model->icon != "default.png") {      

                Storage::disk('public_uploads')->delete($this->img_path . $model->icon);

            }
            $ImageUpload = Image::make($files);
            $image_name = time().$files->getClientOriginalName();
            $ImageUpload->save(public_path() . $this->img_path . $image_name);
        
            $data['icon'] = $image_name;
        }
        
        $model->update($data);

        session()->flash('update', 'تم التعديل بنجاح');

        return redirect($this->url_redirect);
    }
}
