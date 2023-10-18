<?php

namespace App\Services;

use Illuminate\Support\Str;

class GallowService
{

    protected static function compareLetterWithAccent($letter, $wordArr, &$correctLetters)
    {
        $return = false;
        foreach ($wordArr as $l) {
            if ($letter == Str::ascii($l)) {
                $correctLetters[] = $l;
                $return = true;
            }
        }
        return $return;
    }

    public static function checkLetterInWord($letter, $wordArr, &$correctLetters, &$errorLetters, &$lifes)
    {
        if (!self::compareLetterWithAccent($letter, $wordArr, $correctLetters)) {
            $errorLetters[] = $letter;
            $lifes--;
            return false;
        }
        return true;
    }

    public static function finishedWin($wordArr, $correctLetters)
    {
        return count($wordArr) == count($correctLetters);
    }

    public static function finishedLost($lifes)
    {
        return !($lifes >= 1);
    }

}
