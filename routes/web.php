<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{RupaRupiahController, IngatRupiahController, StartController, DashboardController, PemainController, AdminController};


Route::get('/admin/settings', [AdminController::class, 'index'])->name('admin.settings');
Route::post('/admin/settings', [AdminController::class, 'update'])->name('admin.settings.update');

Route::get('/', [StartController::class, 'index'])->name('start');
Route::get('/inputBio', [StartController::class, 'inputBio'])->name('inputBio');
Route::post('/input', [StartController::class, 'input'])->name('input');
Route::get('/tutorial/{user_id}', [StartController::class, 'tutorial'])->name('tutorial');
Route::get('/choose/{user_id}', [StartController::class, 'choose'])->name('choose');

Route::get('/RupaRupiah/{user_id}', [RupaRupiahController::class, 'index'])->name('rupa_rupiah');
Route::get('/RupaRupiah/{user_id}/question', [RupaRupiahController::class, 'question'])->name('rupa_rupiah.question');
Route::get('/RupaRupiah/{user_id}/result/{points}', [RupaRupiahController::class, 'result'])->name('rupa_rupiah.result');

Route::get('/IngatRupiah/{user_id}', [IngatRupiahController::class, 'index'])->name('ingat_rupiah');
Route::get('/IngatRupiah/{user_id}/question', [IngatRupiahController::class, 'question'])->name('ingat_rupiah.question');
Route::get('/IngatRupiah/{user_id}/result/{points}', [IngatRupiahController::class, 'result'])->name('ingat_rupiah.result');


Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('pemain')->group(function () {
        Route::get('/', [PemainController::class, 'index'])->name('pemain.index');
        Route::get('/show/{pemain}', [PemainController::class, 'show'])->name('pemain.show');
        Route::get('/edit/{pemain}', [PemainController::class, 'edit'])->name('pemain.edit');
        Route::put('/update/{pemain}', [PemainController::class, 'update'])->name('pemain.update');
        Route::delete('/destroy/{pemain}', [PemainController::class, 'destroy'])->name('pemain.destroy');
    });
});
