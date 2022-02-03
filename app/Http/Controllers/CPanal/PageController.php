<?php

namespace App\Http\Controllers\CPanal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Category;

class PageController extends Controller
{
    public $page_title = "الصفحات";
    public $model_name = "App\Models\Page";
    public $view_routh = "cpanal.page";
    public $url_redirect = 'admin/pages';


    public function index(Request $request)
    {
        $data = $this->model_name::when($request->search, function($query) use ($request){
            return $query->where('title', 'like', '%' . $request->search . '%');
        })->orderBy('id', 'DESC')->paginate(25);

        
        $title = $this->page_title;

        return view($this->view_routh . '.index',compact(['data', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "اضافة صفحه";
        return view($this->view_routh . '.create', compact(['title']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'body' => 'required',
            'slug' => 'required',
            'excerpt' => 'required|max:160',
            'publish' => 'string',
            'visibility' => 'string',
            'comments' => 'string',
        ]);
        $data['admin_id'] = admin()->user()->id;

        $post = $this->model_name::create($data);

        session()->flash('add', 'تم الاضافة بنجاح');
        return redirect($this->url_redirect);
    }


    public function edit($id)
    {
        $model = $this->model_name::find($id);
        if ($model == null) {
            abort(404);
        }

        $title = "تعديل صفحه";
        return view($this->view_routh . '.edit', compact(['title', 'model']));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'excerpt' => 'required|max:160',
            'publish' => 'string',
            'visibility' => 'string',
            'comments' => 'string',
        ]);
        if($request->image){
            $data['image'] = $request->image;
        }
        $model = $this->model_name::find($id);

        $model->update($data);
        
        session()->flash('update', 'تم التعديل بنجاح');
        return redirect($this->url_redirect);
    }

    public function destroy($id)
    {
        abort(403);
        $model = $this->model_name::find($id);
        $model->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect($this->url_redirect);
    }
}