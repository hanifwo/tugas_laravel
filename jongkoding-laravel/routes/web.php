<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserController2;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/coba-routing', function () {
//     return "ini adalah hasil percobaan routing";
// });

Route::get('/coba-routing/{nama}', function ($nama) {
    return "ini adalah hasil percobaan routing " . $nama;
});

Route::get('/coba-routing/{nama?}', function ($nama = "namanya mana?") {
    return "ini adalah hasil percobaan routing " . $nama;
});

Route::get('/user', [UserController::class, 'index'])->name('list-user'); //sekaligus pemberian nama pada route

Route::middleware(['auth'])->group(function(){
    //route di dalam ini menggunakan middleware auth
    Route::get('/users', [UserController::class, 'index'])->name('list-user');
    Route::get('/users/profile', function(){

    });
});


Route::prefix('userss')->group(function(){ // tanpa titik malah berhasil, ntah apa bedanya
    Route::get('/', [UserController::class, 'index'])->name('list-user');
    Route::get('/profile', function(){
        return "a";
    });
});

Route::resource('usera', UserController2::class)->parameters([
    'user' => 'user_type' // ntah gimana caranya agar parameternya opsional
    // akan menghasilkan URI /user/{user_type}
])->names([
    'index' => 'user.list'
    // tentukan nma aaction kemudian beri nama  setelah prefix user
]);

// parameter
Route::get('/ca', function(){
    return view('coba', [
        "name" => "jongkoding"
    ]);
});
// alternatif
Route::get('/cab', function(){
    return view('coba')->with('name', 'Jonkoging');
});

Route::get('/siswa', [SiswaController::class, 'index']);

Route::get('/sm', [SiswaController::class, 'sm']);

Route::get('/lakek', [SiswaController::class, 'lakek']);

Route::get('/siswajrs', [SiswaController::class, 'siswajrs']);

Route::get('/siswafof', [SiswaController::class, 'siswafof']);

Route::get('/store', [SiswaController::class, 'store']);

Route::get('/update/{id}', [SiswaController::class, 'update']);

Route::get('/delete/{id}', [SiswaController::class, 'delete']);