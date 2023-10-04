<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tip extends Model
{
    use HasFactory;

    protected $fillable = [
        'word_id', 'tip'
    ];

    /**
     * Get the word that owns the Tip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }
}
