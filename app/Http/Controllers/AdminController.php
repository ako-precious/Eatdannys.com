<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Meal;
use Illuminate\Http\Request;
use Inertia\Inertia;


class AdminController extends Controller
{

public function getOrderStats(Request $request)
{
    $totalOrders = Order::count();
    $currentMonth = now()->month;
    $lastMonth = now()->subMonth()->month;

    $ordersThisMonth = Order::whereMonth('created_at', $currentMonth)->count();
    $ordersLastMonth = Order::whereMonth('created_at', $lastMonth)->count();

    $percentGrowth = $ordersLastMonth > 0
        ? (($ordersThisMonth - $ordersLastMonth) / $ordersLastMonth) * 100
        : 100;

    // 🎯 SALES
    $totalSales = Order::where('status', 'paid')->sum('total_price');
    $salesThisMonth = Order::where('status', 'paid')->whereMonth('created_at', $currentMonth)->sum('total_price');
    $salesLastMonth = Order::where('status', 'paid')->whereMonth('created_at', $lastMonth)->sum('total_price');
    $salesGrowth = $salesLastMonth > 0
        ? (($salesThisMonth - $salesLastMonth) / $salesLastMonth) * 100
        : 100;

    // 🧑 USERS
    $totalUsers = User::count();
    $usersThisMonth = User::whereMonth('created_at', $currentMonth)->count();
    $usersLastMonth = User::whereMonth('created_at', $lastMonth)->count();
    $usersGrowth = $usersLastMonth > 0
        ? (($usersThisMonth - $usersLastMonth) / $usersLastMonth) * 100
        : 100;

    // 🍽 MEALS
    $totalMeals = Meal::count();
    $mealsThisMonth = Meal::whereMonth('created_at', $currentMonth)->count();
    $mealsLastMonth = Meal::whereMonth('created_at', $lastMonth)->count();
    $mealsGrowth = $mealsLastMonth > 0
        ? (($mealsThisMonth - $mealsLastMonth) / $mealsLastMonth) * 100
        : 100;

    return response()->json([
        // Orders
        'totalOrders' => $totalOrders,
        'ordersThisMonth' => $ordersThisMonth,
        'ordersLastMonth' => $ordersLastMonth,
        'percentGrowth' => round($percentGrowth, 2),

        // Sales
        'totalSales' => round($totalSales, 2),
        'salesThisMonth' => round($salesThisMonth, 2),
        'salesLastMonth' => round($salesLastMonth, 2),
        'salesGrowth' => round($salesGrowth, 2),

        // Users
        'totalUsers' => $totalUsers,
        'usersGrowth' => round($usersGrowth, 2),

        // Meals
        'totalMeals' => $totalMeals,
        'mealsGrowth' => round($mealsGrowth, 2),
    ]);
}

}
