<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $guarded = [];

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
