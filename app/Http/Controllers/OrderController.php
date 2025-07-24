<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
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

        $orders = $query->with('user')->paginate($perPage);
       
        return response()->json([
            'orders' => $orders,
        ]);
    }

     public function show(Order $order)
    {      
           $order->with('user');
        return  Inertia::render('Order/Show',[
            'order' => $order,
        ]);
    }
}
