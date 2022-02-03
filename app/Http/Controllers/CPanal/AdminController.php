<?php

namespace App\Http\Controllers\CPanal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Rules\OnlyGmail;
use Illuminate\Validation\Rule;
use Image;
use Storage;

class AdminController extends Controller
{
    public $page_title = "المشرفين";
    public $model_name = "App\Models\Admin";
    public $view_routh = "cpanal.admin";
    public $img_path = "/uploads/admins_images//";
    public $url_redirect = 'admin/admins';
    
    public function __construct() {
        $this->middleware(['role:super_admin'])->except('edit', 'update');
    }
    
    // search and show data
    public function index(Request $request)
    {
        $data = $this->model_name::when($request->search, function($query) use ($request){
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->orderBy('id', 'DESC')->paginate(25);

        $title = $this->page_title;

        return view($this->view_routh . '.index',compact(['data', 'title']));
    }

    
    public function create()
    {
        $title = "اضافة مشرف";
        return view($this->view_routh . '.create', compact('title'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:admins', new OnlyGmail],
            'password' => 'required|confirmed|min:6',
            'password_confirmation' =>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['password'] = bcrypt(request('password'));
        if ($files = $request->file('image')) {        
            $ImageUpload = Image::make($files);
            $ImageUpload->resize(275, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_name = time().$files->getClientOriginalName();

            $ImageUpload->save(public_path() . $this->img_path . $image_name);
        
            $data['image'] = $image_name;
        }
        
        $model = $this->model_name::create($data);
        $model->attachRole($request->role);

        session()->flash('add', 'تم الاضافة بنجاح');
        return redirect($this->url_redirect);
    }

    public function edit($id)
    {
        $user = admin()->user();
        if($user->id == $id || $user->hasRole('super_admin')){
            $model = $this->model_name::find($id);
            if ($model == null) {
                abort(404);
            }
            $title = "تعديل مشرف";
            return view($this->view_routh . '.edit', compact(['title', 'model']));
        } else {
            abort(403, 'User does not have any of the necessary access rights.');
        }
    }


    public function update(Request $request, $id)
    {
        
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($id), new OnlyGmail],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->has('password') && $request->password != null){
            $data['password'] = $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $data['password'] = bcrypt(request('password'));
        }
        if ($files = $request->file('image')) {  

            if($this->model_name::find($id)->image != "default.png") {      

                Storage::disk('public_uploads')->delete($this->img_path . $this->model_name::find($id)->image);

            }
            $ImageUpload = Image::make($files);
            $image_name = time().$files->getClientOriginalName();
            $ImageUpload->save(public_path() . $this->img_path . $image_name);
        
            $data['image'] = $image_name;
        }
        $models = $this->model_name::where('id', $id)->update($data);
        if ($request->has('role')){
            $this->model_name::find($id)->syncRoles([$request->role]);
        }
        

        session()->flash('update', 'تم التعديل بنجاح');
        return back();
    }


    public function destroy($id)
    {
        $model = $this->model_name::find($id);
        if($model->image != "default.png") {
            Storage::disk('public_uploads')->delete($this->img_path . $model->image);
            $model->delete();
            session()->flash('success', 'تم الحذف بنجاح');
            return redirect($this->url_redirect);
        } else {
            $model->delete();
            session()->flash('success', 'تم الحذف بنجاح');
            return redirect($this->url_redirect);
        }
    }
}
