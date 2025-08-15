<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    public $timestamps = false; // karena kita cuma pakai created_at manual
    protected $fillable = ['user_id', 'activity', 'details'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
