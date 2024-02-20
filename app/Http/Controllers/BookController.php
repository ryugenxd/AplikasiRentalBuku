<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Models\{
    User,
    Book,
    Category,
    History
};

class BookController extends Controller
{
    private ?string $message;
    private string $type;
    public function __construct()
    {
        $this -> message = null;
        $this -> type = "alert-danger";
    }
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
        $this -> message = 'Book Have Been Added';
        $this -> type = 'alet-success';
        $this -> alert($this -> type,$this -> message);
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
        $this -> message = 'Book Have Been Updated';
        $this -> type = 'alet-success';
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

    public function rentBooks(): View 
    {
        $users = User::where('role_id',2)->where('status','active')->get();
        $books = Book::all();
        return view('book_rent',compact('users','books'));
    }

    public function rentStore(Request $request): RedirectResponse
    {   
        $now = Carbon::now();
        $request['date'] = $now ->toDateString();
        // 3 hari waktu pengembalian
        $request['return_date'] = $now -> addDay(3) -> toDateString();
        // dd($request->all());
        $book = Book::findOrFail($request->book_id)->only('status');
        if($book['status'] != 'in stock'){
            $this -> message = 'Cannot rent, the book is not available';
        }else {
            $count = History::where('user_id',$request->user_id) -> where('actual_date',null)->count();
            if($count >= 3){
                $this -> message = 'Cannot rent, user has reach limit of book';
            }else{
                $this -> pushRentHistory($request->all());
            }
        }
        $this -> alert($this -> type,$this -> message);
        return back();
    }

    private function pushRentHistory($data): void
    {
        try{
            DB::beginTransaction();
            History::create($data);
            $book = Book::findOrFail($data['book_id']);
            $book -> status = 'not available';
            $book -> save();
            DB::commit();
            $this -> message = 'Rent book success !';
            $this -> type = 'alert-success';
        }catch(\Throwable $th){
            DB::rollBack();
            $this -> message = "error !";
        }
    }

    private function pushReturnHistory($data): void
    {
        try{
            $rent =  History::where('user_id',$data['user_id'])->where('book_id',$data['book_id'])
        -> where('actual_date',null);
            $rentCount = $rent -> count();
            if(!$rentCount){
                $this -> message = "error !";
            }else{
                DB::beginTransaction();
                $rentCurrent = $rent -> first();
                $rentCurrent -> actual_date = Carbon::now()->toDateString();
                $book = Book::findOrFail($data['book_id']);
                $book -> status = 'in stock';
                $book -> save();
                $rentCurrent -> save();
                DB::commit();
                $this -> message = 'Return book success !';
                $this -> type = 'alert-success';
            }
        }catch(\Throwable $th){
            DB::rollBack();
            $this -> message = "error !";
        } 
    }


    public function returnBook(): View 
    {
        $users = User::where('role_id','!=',1)->where('status','active')->get();
        $books = Book::all();
        return view('return_book',compact('users','books'));
    }

    public function returnStore(Request $request): RedirectResponse
    {
        $this -> pushReturnHistory($request->all());    
        $this -> alert($this -> type,$this -> message);
        return back();
    }



}
