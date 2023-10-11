<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getTotalScoreAttribute()
    {
        $result = DB::table('user_word')
            ->selectRaw('SUM(user_word.score) as totalScore')
            ->where('user_word.finalized', true)
            ->where('user_word.user_id', $this->id)
            ->join('users', 'users.id', '=', 'user_word.user_id')
            ->groupBy('user_word.user_id')
            ->first();

        $this->attributes['total_score'] = $result->totalScore ?? 0;

        return $this->attributes['total_score'];
    }

    public function getWordsCountAttribute()
    {
        $result = DB::table('user_word')
            ->selectRaw('COUNT(DISTINCT user_word.word_id) as wordsCount')
            ->where('user_word.finalized', true)
            ->where('user_word.user_id', $this->id)
            ->join('users', 'users.id', '=', 'user_word.user_id')
            ->groupBy('user_word.user_id')
            ->first();

        $this->attributes['words_count'] = $result->wordsCount ?? 0;

        return $this->attributes['words_count'];
    }
    /**
     * The words that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function words(): BelongsToMany
    {
        return $this->belongsToMany(Word::class)->using(UserWord::class);
    }
}
