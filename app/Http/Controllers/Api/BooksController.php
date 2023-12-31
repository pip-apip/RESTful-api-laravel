<?php

namespace App\Http\Controllers\Api;

use App\Models\Books;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Resources\BooksResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        if (Auth::check()) {

            $books = Books::latest()->paginate(5);

            // return new BooksResource(true, 'List Data Books', $books);
            return response()->json(['data' => $books], 200);

        } else {

            return response()->json(['error' => 'Unauthorized'], 401);
        
        }
        
    }

    public function store(Request $request)
    {
        if (Auth::check()) {

            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'isbn'          => 'required',
                'title'         => 'required',
                'subtitle'      => 'required',
                'author'        => 'required',
                'published'     => 'required',
                'publisher'     => 'required',
                'pages'         => 'required',
                'description'   => 'required',
                'website'       => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $books = Books::create([
                'user_id'       => $user->id,
                'isbn'          => $request->isbn,
                'title'         => $request->title,
                'subtitle'      => $request->subtitle,
                'author'        => $request->author,
                'published'     => $request->published,
                'publisher'     => $request->publisher,
                'pages'         => $request->pages,
                'description'   => $request->description,
                'website'       => $request->website,
            ]);
    
            // return new BooksResource(true, 'Data Books Berhasil Ditambahkan!', $books);
            return response()->json(['data' => $books], 200);

        } else {

            return response()->json(['error' => 'Unauthorized'], 401);
        
        }
    }

    /**
     * show
     *
     * @param  mixed $books
     * @return void
     */
    public function show($id)
    {
        if (Auth::check()) {

            $books = Books::find($id);

            if (!$books) {
                return response()->json(['error' => 'Book ID not found'], 404);
            }
    
            return response()->json(['data' => $books], 200);

        } else {

            return response()->json(['error' => 'Unauthorized'], 401);
        
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {

            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'isbn'          => 'required',
                'title'         => 'required',
                'subtitle'      => 'required',
                'author'        => 'required',
                'published'     => 'required',
                'publisher'     => 'required',
                'pages'         => 'required',
                'description'   => 'required',
                'website'       => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $books = Books::find($id);
    
            if (!$books) {
                return response()->json(['error' => 'Book ID not found'], 404);
            }
    
            $books->update([
                'user_id'       => $user->id,
                'isbn'          => $request->isbn,
                'title'         => $request->title,
                'subtitle'      => $request->subtitle,
                'author'        => $request->author,
                'published'     => $request->published,
                'publisher'     => $request->publisher,
                'pages'         => $request->pages,
                'description'   => $request->description,
                'website'       => $request->website,
            ]);
    
            // return new BooksResource(true, 'Data Books Berhasil Diubah!', $books);
            return response()->json(['data' => $books], 200);

        } else {

            return response()->json(['error' => 'Unauthorized'], 401);
        
        }
    }

    /**
     * destroy
     *
     * @param  mixed $books
     * @return void
     */
    public function destroy($id)
    {
        if (Auth::check()) {

            $books = Books::find($id);

            if (!$books) {
                return response()->json(['error' => 'Book ID not found'], 404);
            }

            $books->delete();

            // return new PostResource(true, 'Data Books Berhasil Dihapus!', null);
            return response()->json(['message' => 'Delete Book success'], 200);

        } else {

            return response()->json(['error' => 'Unauthorized'], 401);
        
        }
    }

}
