<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserWord extends Pivot
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'word_id'];
    protected $table = 'user_word';
    protected $fillable = [
        'user_id',
        'word_id',
        'score',
        'finalized',
    ];
    
}
