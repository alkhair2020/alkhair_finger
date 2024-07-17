<?php

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
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function () {
    return view('index');
});
Route::get('/readfin', function () {
    return view('readfin');
});
Route::get('/scanfinger', function (Request $request) {

    // dd($request->all());
    $featureSet = $request->input('finger');
    $base64=base64_encode($featureSet);
    $sha256 = hash('sha256', json_encode($featureSet));
    echo "base64 -> <br>"; 
    echo $base64;
    echo "<br><br><br>";
    echo "sha256 -> <br>";
    echo $sha256;
    echo "<br>";
    echo "<br>";
    return $featureSet;
});





