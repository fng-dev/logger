<?php

use Fng\Logger\Logger;

Route::get('/logger/get-logs', function () {
    return response()->json((new Logger())->getLogs());
});
