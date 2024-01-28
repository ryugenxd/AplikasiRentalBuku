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
        $book = Book::create($validated);
        $book -> categories() -> sync($validated['categories']);
        if(!empty($request->file('cover'))){
            $cover = $request->file('cover');
            $cover -> storeAs('public/covers',$cover->hashName());
            $book -> cover = $cover -> hashName();
        }
        Session::flash('message','Books Have Been Added');
        return back();
    }

    public function edit(string $slug): View
    {
        $book = Book::where('slug',$slug)->first();
        $books = Book::latest()->paginate(6);
        return view('update_books',compact('book','books'));
    }


    public function update(Request $request): RedirectResponse
    {
        $validated = $request -> validate([

        ]);
        return back();
    }


    public function delete(): RedirectResponse
    {               
        return back();
    }

}
