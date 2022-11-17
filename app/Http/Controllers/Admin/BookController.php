<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

       // $books = Book::paginate(10);
       $books = Book::with('publisher')->get();

        return view('admin.books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $publishers = Publisher::all();
        return view('admin.books.create')->with('publishers',$publishers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

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

        return to_route('admin.books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {

        $user = Auth::user();
        $user->authorizeRoles('admin');

        if(!Auth::id()) {
           return abort(403);
         }

        //this function is used to get a book by the ID.
        return view('admin.books.show')->with('book', $book);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // This user id check below was implemented as part of LiteNote
        // I don't have a user id linked to books,so I don't need it here - in CA 2 we will allow only admin users to edit books.
        // if($book->user_id != Auth::id()) {
        //     return abort(403);
        // }

      //  dd($book);

        // Load the edit view which will display the edit form
        // Pass in the current book so that it appears in the form.
        return view('admin.books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

         //   //This function is quite like the store() function.
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
        // // the filename needs to be unique, I use title and add the date to guarantee a unique filename, ISBN would be better here.
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;

        // // store the file $book_image in /public/images, and name it $filename
        $path = $book_image->storeAs('public/images', $filename);

        $book->update([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'book_image' => $filename,
            'author' => $request->author
        ]);

        return to_route('admin.books.show', $book)->with('success','Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');
        $book->delete();

        return to_route('admin.books.index')->with('success', 'Book deleted successfully');
    }
}
