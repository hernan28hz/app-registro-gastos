<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        return view('dashboard', [
            'totalSpent' => $user->purchases()->sum('amount'),
            'purchaseCount' => $user->purchases()->count(),
            'latestPurchases' => $user->purchases()
                ->with('category')
                ->latest('purchase_date')
                ->limit(5)
                ->get(),
        ]);
    }
}
