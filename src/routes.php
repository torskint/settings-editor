<?php

use Illuminate\Support\Facades\Route;
use SettingsEditor\Controllers\SettingsController;

Route::middleware(['web'])->group(function () {
    Route::get('/settings-editor', [SettingsController::class, 'login'])->name('torskint.settings_editor.login');
    Route::post('/settings-editor', [SettingsController::class, 'loginPost'])->name('torskint.settings_editor.login.post');

    Route::middleware('torskint.settings.editor.auth')->group(function () {
        Route::get('/settings-editor/dash', [SettingsController::class, 'edit'])->name('torskint.settings_editor');
        Route::post('/settings-editor/dash', [SettingsController::class, 'update'])->name('torskint.settings_editor.post');
    });
});
