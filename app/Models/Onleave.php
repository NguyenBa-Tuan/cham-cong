<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onleave extends Model
{
    use HasFactory;

    protected $fillable = [
        'timeStart',
        'timeEnd',
        'reason',
        'ongoing',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
