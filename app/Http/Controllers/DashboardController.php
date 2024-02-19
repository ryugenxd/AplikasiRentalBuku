<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\{
    User,
    Category,
    Book,
    History
};

class DashboardController extends Controller
{
    public function index(): view
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $histories = History::with(['user','book'])->get();

        return view('dashboard',compact('bookCount','categoryCount','userCount','histories'));
    }
}
