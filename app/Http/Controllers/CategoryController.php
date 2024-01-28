<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        return view('categories',compact('categories'));
    }

    public function add(): View 
    {
        $categories = Category::latest()->paginate(6);
        return view('add_category',compact('categories'));
    }

    public function create(Request $request): RedirectResponse
    {
        $validated = $request -> validate([
          'name'=>'required|min:3|unique:categories|max:100',
          'slug'=>'nullable'
        ]);
        Category::create($validated);
        Session::flash('message','Category Has Been Created');
        return back();
    }

    public function edit(string $slug): View
    {
      $category = Category::where('slug',$slug)->firstOrFail();
      $categories = Category::latest()->paginate(6);
      return view('edit_category',compact('category','categories'));
    }

    public function update(Request $request): RedirectResponse
    {
      // dd($request->all());
      $validated = $request -> validate([
        "name"=>"required|min:3|unique:categories|max:100",
        "slug"=>"nullable"
      ]);
      // dd($validated);
      $category = Category::where("id",$request->id)->firstOrFail();
      $category -> name = $validated['name'];
      $category -> slug = null;
      $category -> save();
      Session::flash('message','Category Has Been Updated');
      return redirect()->route('categories');
    }

    public function delete(string $slug): RedirectResponse
    {
      $category = Category::where('slug',$slug)->firstOrFail();
      $category -> delete();
      Session::flash('message','Category Has Been Removed');
      return back();
    }

    public function restore(string $slug): RedirectResponse
    {
      $category = Category::withTrashed()
      ->where('slug', $slug)
      ->restore();
      return back();
    }

    public function deleted(): View
    {
      $categories = Category::onlyTrashed()->get();
      return view('category_deleted',compact('categories'));
    }

}
