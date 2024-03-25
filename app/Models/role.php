<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\user;
use Illuminate\Database\Eloquent\Relations\HasMany;


class role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users():HasMany
    {
        return $this->hasMany(users::class);
    }
}
