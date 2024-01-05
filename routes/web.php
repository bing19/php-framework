<?php

use Core\Framework\Http\Response;
use Core\Framework\Routing\Route;
use App\Controllers\HomeController;

return [
    Route::get("/",[HomeController::class, 'index']),
    Route::post("/post",[HomeController::class, 'store']),
    Route::get('/about/{name}', function (string $name){
        return new Response('About, '. $name .'');
    }),
];   