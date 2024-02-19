<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Book;
use App\Models\Category;

class PublicController extends Controller
{
    public function index(Request $request): View 
    {
        if($request->category || $request -> title){
            $title = $request -> title;
            $books = Book::where('title','like','%'.$title.'%')
            -> orWhereHas('categories',function(Builder $query) use($request){
                $category = $request->category;
                $query -> where('categories.id',$category);
            })->get();
        }else {
            $books = Book::all();
        }
        $categories = Category::all();
        return view('public_view',compact('books','categories'));
    }
}
