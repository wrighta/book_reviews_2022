<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          // Fetch All Books, owned by the Logged in User, in order of when they were last updated - latest updated returned first, And you want the $books paginated.
          // $books = Book::where('user_id', Auth::id())->latest('updated_at')->paginate(10);

          // Fetch All Books(not just belonging to the logged in user) and add pagination.
          $books = Book::paginate(10);

          // Fetch All Books, no pagination.
          //$books = Book::all();

          // Something not working - unccoment the line below to dump all the books onto the screen to help you troubleshoot.
          //   dd($notes);
          return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required|max:500',
            'author' =>'required',
            //'book_image' => 'file|image|dimensions:width=300,height=400'
            'book_image' => 'file|image'
        ]);

        $book_image = $request->file('book_image');
        $extension = $book_image->getClientOriginalExtension();
        // the filename needs to be unique, I use title and add the date to guarantee a unique filename, ISBN would be better here.
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;

        // store the file $book_image in /public/images, and name it $filename
        $path = $book_image->storeAs('public/images', $filename);

        Book::create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'book_image' => $filename,
            'author' => $request->author
        ]);

        return to_route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        // Use the code below if you want the user to only be able to view books that they own.
        //  if($book->user_id != Auth::id()) {
        //     return abort(403);
        // }

        if(!Auth::id()) {
           return abort(403);
         }

        //this function is used to get a book by the ID.
        return view('books.show')->with('book', $book);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
