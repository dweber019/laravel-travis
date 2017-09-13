<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/s3', function(Request $request) {

    $file = $request->file('photo')->store('avatars', 's3');

    return $file;

});

Route::get('/mail', function(Request $request) {

    Auth::login(\App\User::find(1));

    $order = \App\Order::findOrFail(1);

    \Illuminate\Support\Facades\Mail::to($request->user())->send(new \App\Mail\OrderShipped($order));

    return 'mail OK';

});


Route::get('/test', function(Request $request) {
    return;
});

Route::post('/test/post', function(Request $request) {

    $request->validate([
      'name' => 'required|min:3'
    ]);

    return [ 'created' => true ];
});

Route::post('/test/db', function(Request $request) {

    $attributes = $request->validate([
      'name' => 'required|min:3',
      'price' => 'required|numeric',
    ]);

    $order = tap(new \App\Order($attributes))->save();

    return $order;
});