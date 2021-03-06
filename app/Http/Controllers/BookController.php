<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book as Book;
use App\Http\Requests\StoreBook;

class BookController extends Controller
{

    public function admin()
    {
        return view('books.admin', ['books' => Book::all(),]);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('books.index', ['books' => Book::all(),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $authors = Author::all();
        return view('books.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBook $request
     */
    public function store(StoreBook $request)
    {
        $validData = $request->validated();
        $book = Book::create($validData);

        return redirect()->route('book.show', ['book' => $book->id]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Book $book)
    {
        return view('books.show', ['book' => $book,]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();

        return view(
            'books.edit',
            [
                'book' => $book,
                'authors' => $authors
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBook $request
     */
    public function update(StoreBook $request, Book $book)
    {
        $validData = $request->validated();
        $book->fill($validData);
        $book->save();

        return redirect()->route('book.show', ['book' => $book->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books');
    }
}
