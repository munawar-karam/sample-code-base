<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'user_info';

    public static function save_user_info($ip, $os, $agent, $browser, $desktop, $mobile, $tablet){
        $user_info = new UserInfo();
        $user_info->ip = $ip;
        $user_info->is_desktop = $desktop;
        $user_info->os = $os;
        $user_info->user_agent = $agent;
        $user_info->browser = $browser;
        $user_info->is_mobile = $mobile;
        $user_info->is_tablet = $tablet;
        $user_info->user_id = Auth::user() ? Auth::user()->id : null;
        $user_info->save();
        return $user_info;
    }
}
