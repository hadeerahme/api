<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)
            ->with(['book.author', 'book.category'])
            ->get()
            ->pluck('book');

        return BookResource::collection($favorites);
    }

    public function store(Request $request, $book_id)
    {
        $user = Auth::user();
        $book = Book::findOrFail($book_id);

        $favorite = Favorite::firstOrCreate([
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);

        return response()->json(['message' => 'Book added to favorites.', 'book' => new BookResource($book)]);
    }

    public function destroy($book_id)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)
            ->where('book_id', $book_id)
            ->firstOrFail();

        $favorite->delete();

        return response()->json(['message' => 'Book removed from favorites.']);
    }
}