<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Book::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'min:3|max:10',
            'body' => 'min:3|max:50',
            
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->body = $request->body;
        $book->save();

        return response()->json(['message' => 'author create '], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Book::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'min:3|max:10',
            'body' => 'min:3|max:50',
            
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->body = $request->body;
        $book->save();

        return response()->json(['message' => 'book create '], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDelete = Book::destroy($id);
        if($isDelete ==1 )
        return response()->json(['message' => 'book deleted successfully'], 200);
        return response()->json(['message' => 'ID NOT EXIST'], 404);
    }
}
