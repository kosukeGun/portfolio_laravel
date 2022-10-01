<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany("App\Models\Review");
    }

    public function memos()
    {
        return $this->belongsTo("App/Models/Memo");
    }

    public function users()
    {
        return $this->hasMany("App/Models/User");
    }
}
