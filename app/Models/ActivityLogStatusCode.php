<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogStatusCode extends Model
{
    use HasFactory;

    protected $table = 'activity_log_status_codes';

    public static function get_activity_log_code($status_code)
    {
        $activity_log_status_code = ActivityLogStatusCode::where('status_code', $status_code)->first();

        if (!empty($activity_log_status_code)) {

            return $activity_log_status_code->id;

        }
        return null;
    }
}
