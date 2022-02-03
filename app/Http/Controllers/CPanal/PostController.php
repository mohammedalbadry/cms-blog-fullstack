<?php

namespace App\Http\Controllers\CPanal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Category;

class PostController extends Controller
{
    public $page_title = "التدوينات";
    public $model_name = "App\Models\Post";
    public $view_routh = "cpanal.post";
    public $url_redirect = 'admin/posts';


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
        $title = "اضافة تدوينة";
        $categories = Category::all();
        $tags = Tag::all();
        return view($this->view_routh . '.create', compact(['title', 'categories', 'tags']));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'body' => 'required',
            'excerpt' => 'required|max:160',
            'tags' => 'required',
            'categories' => 'required',
            'publish' => 'string',
            'visibility' => 'string',
            'comments' => 'string',
        ]);
        $data['slug'] = $this->createSlug($data['title']);
        $data['admin_id'] = admin()->user()->id;

        $post = $this->model_name::create($data);
        $model = $this->model_name::find($post->id);

        $model->tags()->attach($request->tags);
        $model->categories()->attach($request->categories);

        session()->flash('add', 'تم الاضافة بنجاح');
        return redirect($this->url_redirect);
    }

    public function createSlug($title){
        $slug =  str_replace(" ", "-", $title);
        $check_slug = $this->model_name::where('slug', $slug)->count();

        if($check_slug == 0){
            return $slug;
        }

        $i = 1;
        do {
            $newSlug = $slug . '-' . $i;
            $check_new_slug = $this->model_name::where('slug', $newSlug)->count();
            if($check_new_slug == 0){
                return $newSlug;
            }
            $i++;
        } while ($i > 0);
    }

    public function edit($id)
    {
        $model = $this->model_name::find($id);
        if ($model == null) {
            abort(404);
        }

        $categories = Category::all();
        $tags = Tag::all();
        $selected_categories = [];
        $selected_tags = [];
        
        foreach ($model->categories as $category) {
            array_push($selected_categories, $category->id);
        }
        foreach ($model->tags as $tag) {
            array_push($selected_tags, $tag->id);
        }
        $title = "تعديل الوسم";
        return view($this->view_routh . '.edit', compact(['title', 'model', 'categories', 'selected_categories', 'tags', 'selected_tags']));
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
            'tags' => 'required',
            'categories' => 'required',
        ]);
        $data['slug'] = str_replace(" ", "-", $data['title']);
        if($request->image){
            $data['image'] = $request->image;
        }
        $model = $this->model_name::find($id);

        $model->update($data);
        $model->tags()->sync($request->tags);
        $model->categories()->sync($request->categories);
        
        session()->flash('update', 'تم التعديل بنجاح');
        return redirect($this->url_redirect);
    }

    public function destroy($id)
    {
        $model = $this->model_name::find($id);
        $model->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect($this->url_redirect);
    }
}