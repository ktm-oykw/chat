<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [ChatController::class, 'index'])->name('test.index');

Route::get('/chat/{user}', [ChatController::class, 'openChat']);

// 認証が必要なルートをグループ化する
Route::middleware('auth')->group(function () {
    // ダッシュボードへのアクセス
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // プロフィールの編集、更新、削除
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 認証関連のルート（ログイン、登録など）
require __DIR__.'/auth.php';

Route::post('/chat', [ChatController::class, 'sendMessage']);