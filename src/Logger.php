<?php

namespace Fng\Logger;

use Fng\Logger\Discord;
use Fng\Logger\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logger
{

    protected $discordWebHook = null;

    public function __construct($discord = null)
    {
        $this->discordWebHook = $discord;
    }

    public function getLogs(Request $request)
    {
        $fields = Log::getFields();
        $logs = null;
        foreach ($request->all() as $key => $filters) {
            if ($logs !== null) {
                if ($fields->contains($key)) {
                    $logs->where($key, 'LIKE', "%{$filters}%");
                }
            } else {
                if ($fields->contains($key)) {
                    $logs = Log::where($key, 'LIKE', "%{$filters}%");
                }
            }
        }

        $paginate = isset($request->paginate) ? intval($request->paginate) : 10;

        if ($logs) {
            $logs = $logs->paginate($paginate);
        } else {
            $logs = Log::paginate($paginate);
        }
        $logs->appends($request->all())->links();
        return response()->json($logs)->original;
    }

    public function create(Log $log)
    {

        $log = Log::create([
            "level" => isset($log->level) ? $log->level : "LVL_WARNING",
            "plataform" => isset($log->plataform) ? $log->plataform : $_SERVER['HTTP_USER_AGENT'],
            "domain" => isset($log->domain)  ? $log->domain : $_SERVER['SERVER_NAME'],
            "description" => $log->description,
            "user_id" => Auth::check() ? Auth::id() : null
        ]);

        if ($this->discordWebHook) {
            $discord = new Discord();

            $color = '3366ff';

            switch ($log->level) {
                case "DEBUG LEVEL":
                    $color = '699e00';
                    break;
                case "WARNING LEVEL":
                    $color = 'ffc73d';
                    break;
                case "ERROR LEVEL":
                    $color = 'ff533d';
                    break;
                case "EMERGENCY LEVEL":
                    $color = 'ff0000';
                    break;
            }
            $log->discord = $discord->send($this->discordWebHook, $log, $color);
        }

        return $log;
    }

    public function sendDiscordMessage($message)
    {
        $discord = new Discord();
        return $discord->sendMessage($this->discordWebHook, $message);
    }

    public function update(Log $log)
    {
        $log->update();
    }
}
