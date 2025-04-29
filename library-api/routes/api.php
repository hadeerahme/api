<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;

Route::prefix('v1')->group(function () {
    // Book Routes
    Route::get('books', [BookController::class, 'index']);           // Get all books
    Route::get('books/highest-rated', [BookController::class, 'highestRated']); 
    Route::get('books/lowest-rated', [BookController::class, 'lowestRated']);
    Route::get('books/{id}', [BookController::class, 'show']);       // Get book details
    Route::post('books', [BookController::class, 'store']);          
    Route::put('books/{id}', [BookController::class, 'update']);     
    Route::delete('books/{id}', [BookController::class, 'destroy']); 
    

    // Author Routes
    Route::get('authors', [AuthorController::class, 'index']);       // Get all authors

    // Category Routes
    Route::get('categories', [CategoryController::class, 'index']);  // Get all categories
});
