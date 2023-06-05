<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/count', function () {
    $users_count = DB::table('users')->count();
    return response()->json(['count' => $users_count]);
});

Route::get('/chats/count', function () {
    $chats_count = DB::table('ch_messages')->count();
    return response()->json(['count' => $chats_count]);
});

Route::get('/posts/count', function () {
    $posts_count = DB::table('posts')->count();
    return response()->json(['count' => $posts_count]);
});
