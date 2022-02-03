<?php

namespace App\Http\Controllers\CPanal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $page_title = "الاقسام";
    public $model_name = "App\Models\Category";
    public $view_routh = "cpanal.category";
    public $url_redirect = 'admin/categories';


    public function index(Request $request)
    {
        $data = $this->model_name::when($request->search, function($query) use ($request){
            return $query->where('name', 'like', '%' . $request->search . '%');
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
        $title = "اضافة قسم";
        $categories = new \App\Models\Category;
        $categories = $categories->parent()->get();
        return view($this->view_routh . '.create', compact(['title', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('slug')){
            $request['slug'] = str_replace(" ", "-", $request->slug);
        }
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'description' => 'required|max:160',
            'parent_id' => 'integer'
        ]);
        $this->model_name::create($data);

        session()->flash('add', 'تم الاضافة بنجاح');
        return redirect($this->url_redirect);
    }


    public function edit($id)
    {
        $model = $this->model_name::find($id);
        if ($model == null) {
            abort(404);
        }
        $title = "تعديل القسم";
        $categories = new \App\Models\Category;
        $categories = $categories->parent()->get();

        return view($this->view_routh . '.edit', compact(['title', 'model','categories']));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required|max:160',
            'parent_id' => 'integer'
        ]);
        $this->model_name::where('id', $id)->update($data);

        session()->flash('update', 'تم التعديل بنجاح');
        return redirect($this->url_redirect);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model_name::find($id);
        $model->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect($this->url_redirect);
    }
}
