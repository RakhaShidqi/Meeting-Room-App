<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogHelper
{
    public static function add($activity, $details = null)
    {
        ActivityLog::create([
            'user_id'    => Auth::id(),
            'activity'     => $activity,
            'details'=> $details,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
