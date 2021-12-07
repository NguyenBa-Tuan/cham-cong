<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'data',
        'note_id',
        'month_id',
    ];

    protected $hidden = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo("App\Models\User", 'user_id');
    }

    public function note()
    {
        return $this->belongsTo('App\Models\Note', 'note_id');
    }
}
