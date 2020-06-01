<?php

namespace Fng\Logger;

use Fng\Logger\Models\Log;


class Discord
{

    public function send($webhookurl, Log $log, $level = '3366ff')
    {
        //=======================================================================================================
        // Compose message. You can use Markdown
        // Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
        //========================================================================================================

        $timestamp = date("c", strtotime("now"));

        $json_data = json_encode([
            // Message
            "content" => "",

            // Username
            "username" => "",

            // Avatar URL.
            // Uncoment to replace image set in webhook
            //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

            // Text-to-speech
            "tts" => false,

            // File upload
            // "file" => "",

            // Embeds Array
            "embeds" => [
                [
                    // Embed Title
                    "title" => "Logger · " . $log->level,

                    // Embed Type
                    "type" => "rich",

                    // Embed Description
                    "description" => $log->level . ' · ' . $log->description,

                    // URL of title link
                    // "url" => "https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c",

                    // Timestamp of embed must be formatted as ISO8601
                    "timestamp" => $timestamp,

                    // Embed left border color in HEX
                    "color" => hexdec($level),

                    // Footer
                    // "footer" => [
                    //     "text" => "GitHub.com/Mo45",
                    //     "icon_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=375"
                    // ],

                    // Image to send
                    // "image" => [
                    //     "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=600"
                    // ],

                    // Thumbnail
                    //"thumbnail" => [
                    //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
                    //],

                    // Author
                    "author" => [
                        "name" => "Franco Nascimento",
                        "url" => "https://github.com/fng-dev"
                    ],

                    // Additional Fields array
                    // "fields" => [
                    //     // Field 1
                    //     [
                    //         "name" => "Field #1 Name",
                    //         "value" => "Field #1 Value",
                    //         "inline" => false
                    //     ],
                    //     // Field 2
                    //     [
                    //         "name" => "Field #2 Name",
                    //         "value" => "Field #2 Value",
                    //         "inline" => true
                    //     ]
                    //     // Etc..
                    // ]
                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


        $ch = curl_init($webhookurl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
        // echo $response;
        curl_close($ch);

        return $response;
    }

    public function sendMessage($webhookurl, $message, $level = '3366ff')
    {
        //=======================================================================================================
        // Compose message. You can use Markdown
        // Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
        //========================================================================================================

        $timestamp = date("c", strtotime("now"));

        $json_data = json_encode([
            // Message
            "content" => "",

            // Username
            "username" => "",

            // Avatar URL.
            // Uncoment to replace image set in webhook
            //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

            // Text-to-speech
            "tts" => false,

            // File upload
            // "file" => "",

            // Embeds Array
            "embeds" => [
                [
                    // Embed Title
                    "title" => "Logger",

                    // Embed Type
                    "type" => "rich",

                    // Embed Description
                    "description" => $message,

                    // URL of title link
                    // "url" => "https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c",

                    // Timestamp of embed must be formatted as ISO8601
                    "timestamp" => $timestamp,

                    // Embed left border color in HEX
                    "color" => hexdec($level),

                    // Footer
                    // "footer" => [
                    //     "text" => "GitHub.com/Mo45",
                    //     "icon_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=375"
                    // ],

                    // Image to send
                    // "image" => [
                    //     "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=600"
                    // ],

                    // Thumbnail
                    //"thumbnail" => [
                    //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
                    //],

                    // Author
                    "author" => [
                        "name" => "Franco Nascimento",
                        "url" => "https://github.com/fng-dev"
                    ],

                    // Additional Fields array
                    // "fields" => [
                    //     // Field 1
                    //     [
                    //         "name" => "Field #1 Name",
                    //         "value" => "Field #1 Value",
                    //         "inline" => false
                    //     ],
                    //     // Field 2
                    //     [
                    //         "name" => "Field #2 Name",
                    //         "value" => "Field #2 Value",
                    //         "inline" => true
                    //     ]
                    //     // Etc..
                    // ]
                ]
            ]

        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);


        $ch = curl_init($webhookurl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        // If you need to debug, or find out why you can't send message uncomment line below, and execute script.
        // echo $response;
        curl_close($ch);

        return $response;
    }
}
