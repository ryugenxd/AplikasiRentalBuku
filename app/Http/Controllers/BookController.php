<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Models\{
    Book,
    Category
};

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::all();
        return view('books',compact('books'));
    }

    public function add(): View
    {
        $books = Book::latest()->paginate(6);
        $categories = Category::all();
        return view('add_books',compact('books','categories'));
    }

    public function created(Request $request): RedirectResponse
    {
        // dd($request->all());
        $validated = $request -> validate([
            'code'=>'required|min:3|max:16|unique:books',
            'title'=>'required|min:3|max:100',
            'cover'=>'nullable|image',
            'categories'=>'required|array',
            'slug'=>'nullable|unique:books'
        ]);
        if($request->hasFile('cover')){
            $cover = $request->file('cover');
            $cover -> storeAs('public/covers',$cover->hashName());
            $validated["cover"] = $cover -> hashName();
        }
        $book = Book::create($validated);
        $book -> categories() -> sync($validated['categories']);
        Session::flash('message','Books Have Been Added');
        return back();
    }

    public function edit(string $slug): View
    {
        $book = Book::where('slug',$slug)->firstOrFail();
        $books = Book::latest()->paginate(6);
        $categories = Category::all();
        return view('update_books',compact('book','books','categories'));
    }


    public function update(Request $request): RedirectResponse
    {
        $validated = $request -> validate([
            'code'=>'required|min:3|max:16',
            'title'=>'required|min:3|max:100',
            'cover'=>'nullable|image',
            'categories'=>'nullable|array',
            'slug'=>'nullable|unique:books',
            'id'=>'integer'
        ]);


        if($request -> hasFile('cover')){
            $cover = $request->file('cover');
            $cover -> storeAs('public/covers',$cover->hashName());
            $validated["cover"] = $cover -> hashName();
        }


        $book = Book::where('id',$validated['id'])->firstOrFail();
        if($book->code = $validated['code']){
            unset($validated['code']);
        }
        if($request->has('categories')){
            $book -> categories() -> sync($validated['categories']);
        }
        $book -> fill($validated);
        $book -> save();
        Session::flash('message','Book Have Been Updated');
        return back();
    }

    public function deleted(): View
    {
        $books = Book::onlyTrashed()->get();
        return view('book_deleted',compact('books'));
    }

    public function restore(string $slug): RedirectResponse
    {
        $book = Book::withTrashed() -> where('slug', $slug) ->restore();
        Session::flash('message','Category Has Been Restored');
        return back();
    }

    public function delete(string $slug): RedirectResponse
    {   $book = Book::where('slug',$slug)->firstOrFail();
        $book -> delete();
        Session::flash('message','Category Has Been Removed');
        return back();
    }

}
