<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $monthlyExpenses = Auth::user()->expenses()
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->whereRaw('DATE_FORMAT(date, "%Y-%m") = ?', [$currentMonth])
            ->with('category')
            ->groupBy('category_id')
            ->get();
        $monthlyTotal = $monthlyExpenses->sum('total');
        $categories = Category::all();
        $chartData = $categories->map(function ($category) use ($monthlyExpenses) {
            $expense = $monthlyExpenses->firstWhere('category_id', $category->id);
            return [
                'name' => $category->name,
                'amount' => $expense ? $expense->total : 0,
                'color' => $category->color
            ];
        })->filter(function ($item) {
            return $item['amount'] > 0;
        });
        $recentExpenses = Auth::user()->expenses()
            ->with('category')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'monthlyExpenses',
            'monthlyTotal',
            'chartData',
            'recentExpenses'
        ));
    }
}
