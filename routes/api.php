<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Setting;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('adopt', function(Request $request) {
    $attributes = $request->validate([
        'host' => ['url','required'],
        'key' => ['required']
    ]);

    Setting::upsert([
        ['name' => 'master:host','value' => $attributes['host']],
        ['name' => 'master:key','value' => $attributes['key']],
    ], ['key'],['name']);
});