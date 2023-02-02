<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
    ];

    public function monthTimesheet()
    {
        return $this->hasMany('App\Models\Timesheet', 'month_id');
    }

    public function monthUser()
    {
        return $this->hasOne('App\Models\User', 'user_id');
    }

    public function monthNote()
    {
        return $this->hasOne('App\Models\Note');
    }
}
