<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;

class ActivityLogHelper
{
    public static function add($action, $description = null)
    {
        ActivityLog::create([
            'user_id'    => Auth::id(),
            'activity'     => $action,
            'description'=> $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
