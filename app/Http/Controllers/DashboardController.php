<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $countUsers = User::count();
        $countWords = Word::count();
        $countCategories = Category::count();

        return view(
            'dashboard',
            compact(
                'countUsers',
                'countWords',
                'countCategories',
            )
        );
    }
}
