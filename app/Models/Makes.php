<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makes extends Model
{
    protected $guarded=false;

    public function models()
    {
        return $this->hasMany(Models::class, 'Make_ID');
    }

    use HasFactory;
}
