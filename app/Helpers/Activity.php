<?php

use App\Models\ActivityLog;

if (!function_exists('log_activity')) {

    function log_activity($type, $description, $data = [])
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'activity_type' => $type,
            'description' => $description,
            'data' => $data
        ]);
    }
}
