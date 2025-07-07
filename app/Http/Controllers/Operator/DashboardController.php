<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index()
    {
        $operatorId = Auth::id();

        $total = Article::where('operator_id', $operatorId)->count();
        $draft = Article::where('operator_id', $operatorId)->where('status', 'draft')->count();
        $published = Article::where('operator_id', $operatorId)->where('status', 'published')->count();
        $latestArticles = Article::where('operator_id', $operatorId)
        ->latest()
        ->take(5)
        ->get();


        return view('operator.dashboard', compact('total', 'draft', 'published', 'latestArticles'));
    }
}
