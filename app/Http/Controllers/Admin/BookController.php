<?php

namespace App\Http\Controllers\admin;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::latest()->get();

        if ($request->ajax()) {
            return DataTables::of($books)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = 'Edit';

                    $btn = $btn . ' Delete';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.books.index', compact('books'));
    }

    /**
     *
     * Store/update resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Book::updateOrCreate([
            'id' => $request->book_id
        ],[
            'name' => $request->name,
            'author' => $request->author
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'Book saved successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Book $books
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        // return response
        $response = [
            'success' => true,
            'message' => 'Book deleted successfully.',
        ];
        return response()->json($response, 200);
    }
}
