<?php

use Illuminate\Support\Facades\Route;
use SettingsEditor\Controllers\SettingsController;

Route::middleware(['web'])->group(function () {
    Route::get('/robots.txt', [SettingsController::class, 'robots_txt']);
    
    Route::get('/settings-editor', [SettingsController::class, 'edit'])->name('torskint.settings_editor');
    Route::post('/settings-editor', [SettingsController::class, 'update'])->name('torskint.settings_editor.post');
});
