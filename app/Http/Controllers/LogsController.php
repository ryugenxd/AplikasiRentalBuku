<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\History;

class LogsController extends Controller
{
    public function index(): View
    {
        $histories = History::with(['user','book'])->get();
        return view('logs',compact('histories'));
    }
}
