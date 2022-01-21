<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'overtime_id',
        'user_id',
        'date',
        'checkin',
        'checkout',
        'totalTime',
        'note',
        'projectName',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
