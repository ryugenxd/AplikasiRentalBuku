<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{
    User,
    Category,
    Book
};

class DashboardController extends Controller
{
    public function index(): view
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();

        return view('dashboard',compact('bookCount','categoryCount','userCount'));
    }
}
