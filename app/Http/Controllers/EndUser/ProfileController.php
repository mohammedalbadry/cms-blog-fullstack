<?php

namespace App\Http\Controllers\EndUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;
use Image;
use Storage;

class ProfileController extends Controller
{
    public $model_name = "App\Models\User";
    public $img_path = "/uploads/users_images//";

    public function index(){
        $user = $this->model_name::find(Auth::id());
        return view('enduser/profile', compact('user'));
    }

    public function update(Request $request){

        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('admins')->ignore(Auth::id())],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->has('password') && $request->password != null){
            $data['password'] = $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $data['password'] = bcrypt(request('password'));
        }
        if ($files = $request->file('image')) {  

            if($this->model_name::find(Auth::id())->image != "default.png") {      

                Storage::disk('public_uploads')->delete($this->img_path . $this->model_name::find(Auth::id())->image);

            }
            $ImageUpload = Image::make($files);
            $image_name = time().$files->getClientOriginalName();
            $ImageUpload->save(public_path() . $this->img_path . $image_name);
        
            $data['image'] = $image_name;
        }

        $user = $this->model_name::where('id', Auth::id())->update($data);
        session()->flash('update', 'تم التعديل بنجاح');
        return back();
    }
}
