<?php

use Fng\Logger\Logger;
use Illuminate\Http\Request;

Route::get('/logger/get-logs', function (Request $request) {
    return response()->json((new Logger())->getLogs($request));
});
