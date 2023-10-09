<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ScoreAuth extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $points = DB::table('user_word')
            ->selectRaw('SUM(user_word.score) as total_score, COUNT(DISTINCT user_word.word_id) as word_count')
            ->where('user_word.finalized', true)
            ->where('user_word.user_id', Auth::user()->id)
            ->join('users', 'users.id', '=', 'user_word.user_id')
            ->groupBy('user_word.user_id' )
            ->first();

        return view('components.score-auth', compact('points'));
    }
}
