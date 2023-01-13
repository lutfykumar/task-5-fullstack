<?php

namespace App\Models;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    protected $guarded = ['id'];

    public function articles()
    {
        return $this->hasMany(Articles::class);
    }
}
