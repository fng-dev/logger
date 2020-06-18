<?php

namespace Fng\Logger\Models;

use Illuminate\Database\Eloquent\Model;


class Log extends Model
{

    public const DEBUG = "DEBUG LEVEL";
    public const INFO = "INFO LEVEL";
    public const NOTICE = "NOTICE LEVEL";
    public const WARNING = "WARNING LEVEL";
    public const ERROR = "ERROR LEVEL";
    public const CRITICAL = "CRITICAL LEVEL";
    public const ALERT = "ALERT LEVEL";
    public const EMERGENCY = "EMERGENCY LEVEL";

    protected $table = 'fng_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        "level",
        "domain",
        "plataform",
        "description",
        "line",
        "code",
        "user_id"
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    protected $hidden = [];

    /**
     *
     * Array with validation rules
     *
     * @var array
     *
     */

    protected static $rules = [
        "level" => "string",
        "domain" => "string",
        "plataform" => "string",
        "description" => "string",
        "user_id" => "integer"
    ];


    /**
     * Validation Rules
     *
     * @var array
     */

    static public function getRules(): array
    {
        return self::$rules;
    }


    /**
     * Filter fields
     *
     * @var array
     */

    protected static $fields = [
        "id",
        "level",
        "domain",
        "plataform",
        "description",
        "line",
        "code",
        "user_id"
    ];

    static public function getFields()
    {
        return collect(self::$fields);
    }
}
