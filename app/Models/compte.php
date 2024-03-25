<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\wallet;
Use App\Models\user;
use Illuminate\Database\Eloquent\Relations\HasOne;


class compte extends Model
{
    use HasFactory;


    protected $fillable = [
        'date',
        'solde',
    ];


    public function wallet(): HasOne
    {
        return $this->hasOne(wallet::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(user::class);
    }
}
