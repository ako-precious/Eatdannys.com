<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
    
        return  Inertia::render('Order/Index');
    }
    public function getOrder(Request $request)
    {
//get the user token to continue

        $user = Auth::user();
        $perPage = $request->get('per_page', 10); // default 10

        $query = Order::orderBy("id", "desc");

        // If the user is not an admin, only show their orders
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $orders = $query->paginate($perPage);
       
        return response()->json([
            'orders' => $orders,
        ]);
    }
}
