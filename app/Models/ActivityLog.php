<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    public static function save_activity_logs($activity_log_status_code_id, $user_info_id){

        $activity_logs = new ActivityLog();
        $activity_logs->activity_log_status_code_id = $activity_log_status_code_id;
        $activity_logs->user_info_id = $user_info_id;
        $activity_logs->save();

    }
}
