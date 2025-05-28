<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;


class OrderController extends Controller
{
    public function index()
    {
        // $orders = Order::orderBy("id","desc")->paginate(10);
        return  Inertia::render('Order/Index');
    }

    public function getOrder(Request $request)
    {
        $perPage = $request->get('per_page', 10); // default 10
$orders = Order::orderBy("id", "desc")->paginate($perPage);
        return response()->json([
            'orders' => $orders,
            // 'requires_password_setup' => $user->wasRecentlyCreated = true ,
        ]);
       
    }
}
