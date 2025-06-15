<?php

use Illuminate\Support\Facades\Route;
use SettingsEditor\Controllers\SettingsController;

Route::middleware(['web'])->group(function () {
    Route::get('/settings-editor', [SettingsController::class, 'edit'])->name('admin.settings');
    Route::post('/settings-editor', [SettingsController::class, 'update'])->name('admin.settings.post');
});
