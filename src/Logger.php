<?php

namespace Fng\Logger;

use Fng\Logger\Discord;
use Fng\Logger\Models\Log;
use Illuminate\Support\Facades\Auth;

class Logger
{

    protected $discordWebHook = null;

    public function __construct($discord = null)
    {
        $this->discordWebHook = $discord;
    }

    public function getLogs()
    {
        return Log::all();
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

            if (is_array($this->discordWebHook)) {
                foreach($this->discordWebHook as $url) {
                    $log->discord = $discord->send($url, $log, $color);
                }
            } else {
                $log->discord = $discord->send($this->discordWebHook, $log, $color);
            }
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
