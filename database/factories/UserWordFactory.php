<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserWord;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserWord>
 */
class UserWordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $loop = false;

        while(!$loop){
            $user = User::get()->random();

            $word = Word::get()->random();

            
            if(!DB::table('user_word')->where('user_id', $user->id)->where('word_id', $word->id)->first()){
                $loop = true;
            }
        }

        return [
            'user_id' => $user->id,
            'word_id' => $word->id,
            'score' => rand(0, 10),
            'finalized' => true,
        ];
    }
}
