<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $guarded = [];

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }
}
