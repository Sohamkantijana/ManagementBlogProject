<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'showDataInHome'])->name('home');
Route::get('/fullpost/{id}',[UserController::class,'showFullPost'])->name('fullpost');
Route::get('/dashboard', [UserController::class,'home'])->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('admin/dashboard', [UserController::class,'index'])
//->middleware(['auth', 'admin'])->name('admin.dashboard');

//Route::get('admin/dashboard/post', [UserController::class,'post'])
//->middleware(['auth', 'admin'])->name('admin.dashboard');
Route::get('/download-posts', [UserController::class, 'downloadPostsCsv'])->name('download.posts');


Route::prefix('admin/dashboard')->middleware(['auth', 'admin'])->group(function(){
    Route::get('/', [UserController::class,'index'])->name('admin.dashboard');
    Route::get('/addpost',[AdminController::class,'addpost'])->name('admin.addpost');
    Route::post('/addpost',[AdminController::class,'createpost'])->name('admin.createpost');
    Route::get('/allpost',[AdminController::class,'allpost'])->name('admin.allpost');
    Route::get('/allpost/{id}',[AdminController::class,'updatePost'])->name('admin.update');
    Route::post('/allpost/',[AdminController::class,'postupdate'])->name('admin.postupdate');
    Route::delete('/allpost/{id}', [AdminController::class, 'deletePost'])->name('admin.deletepost');


    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
