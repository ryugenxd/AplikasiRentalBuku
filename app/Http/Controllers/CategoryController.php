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
      return view('edit_category',compact('category'));
    }

    public function update(Request $request): RedirectResponse
    {
      $validated = $request -> validate([
        "name"=>"required|min:3|unique:categories:max:100",
      ]);
      $category = Category::where("id",$request->id)->firstOrFail();
      $category -> name = $validated['name'];
      $category -> slug = null;
      Session::flash('message','Category Has Been Updated');
      return back();
    }

    public function delete(string $slug): RedirectResponse
    {
      $category = Category::where('slug',$slug)->firstOrFail();
      $category -> delete();
      Session::flash('message','Category Has Been Deleted');
      return back();
    }

}
