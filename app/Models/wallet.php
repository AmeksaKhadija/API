<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\compte;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'motif',
    ];

    public function compte(): BelongsTo
    {
        return $this->BelongsTo(compte::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
