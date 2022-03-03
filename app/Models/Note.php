<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'note',
        'full_job',
        'half_job',
        'ncl',
        'np',
        'kp',
        'total',
    ];

    public function noteTimesheet()
    {
        return $this->hasMany('App\Models\Timesheet');
    }
}
