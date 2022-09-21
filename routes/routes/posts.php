<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::prefix('post')->group(function () {

    Route::get('/', [PostController::class, 'index']);

    Route::get('/create', [PostController::class, 'create']);

    Route::post('/store', [PostController::class, 'store']);

    Route::get('/edit/{post}', [PostController::class, 'edit']);

    Route::post('/destroy', [PostController::class, 'destroy']);

    Route::get('/show/{post}',[PostController::class, 'show']);

    Route::get('pesquisar',[PostController::class, 'pesquisar']);

    Route::post('pesquisar',[PostController::class, 'pesquisar']);

    Route::get('exportar',[PostController::class, 'exportar']);

    Route::get('/adicionar-gostei/{post}',[PostController::class, 'adicionarGostei']);

    Route::get('/adicionar-naogostei/{post}',[PostController::class, 'adicionarNaoGostei']);
});
