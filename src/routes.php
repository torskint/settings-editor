<?php

use Illuminate\Support\Facades\Route;
use SettingsEditor\Controllers\SettingsController;

Route::prefix('/settings-editor')->middleware(['web'])->group(function () {
    Route::get('/', [SettingsController::class, 'login'])->name('torskint.settings_editor.login');
    Route::post('/', [SettingsController::class, 'loginPost'])->name('torskint.settings_editor.login.post');

    Route::middleware('torskint.settings.editor.auth')->group(function () {
        Route::get('/dashboard', [SettingsController::class, 'edit'])->name('torskint.settings_editor');
        Route::post('/dashboard', [SettingsController::class, 'update'])->name('torskint.settings_editor.post');
    });
});
