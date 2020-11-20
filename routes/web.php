<?php

use App\Events\SendMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::group(['prefix' => 'message'], function () {
        Route::get('/', function () {

            return view('message');
        });

        Route::post('/', function (Request $request) {

            $message = new Message();

            $message->title = $request->title;
            $message->body = $request->body;
            $message->user_id = $request->user_id;

            $message->save();

            $user = User::findOrFail($request->user_id);

            broadcast(new SendMessage($message, $user));

            return redirect('/message');
        });
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
