<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Book;

class PublicController extends Controller
{
    public function index(): View 
    {
        $books = Book::all();
        return view('public_view',compact('books'));
    }
}
