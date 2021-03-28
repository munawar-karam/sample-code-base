<?php

if (!function_exists('generate_unique_encrypted_id')) {
    function generate_unique_encrypted_id()
    {
        return str_replace(' ','',\Illuminate\Support\Str::random(15).time().\Illuminate\Support\Str::random(15).microtime());
    }
}
function save_activity_logs($activity_log_status_code){
    $user_agent = new \App\Helpers\UserAgent();
    $ip = $user_agent->IP();
    $os = $user_agent->OS();
    $agent = $user_agent->user_agent();
    $browser = $user_agent->browser;
    $desktop = $user_agent->isDesktop();
    $mobile = $user_agent->isMobile();
    $tablet = $user_agent->isTablet();

    //save the user agent history in database
    $user_info = \App\Models\UserInfo::save_user_info($ip, $os, $agent, $browser, $desktop, $mobile, $tablet);

    //get the activity log status code id by status code
    $activity_log_status_code_id = \App\Models\ActivityLogStatusCode::get_activity_log_code($activity_log_status_code);

    //save activity_logs
    \App\Models\ActivityLog::save_activity_logs($activity_log_status_code_id, $user_info->id);

}
