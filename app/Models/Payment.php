<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-Y g:i A');
    }
}
