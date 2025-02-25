<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'precipitation_threshold',
        'uv_index_threshold',
        'notify_email',
        'notify_sms',
        'phone_number',
        'paused_until',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
