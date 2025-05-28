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
        // $user = Auth::user();
        // $perPage = $request->get('per_page', 10); // default 10

        // $query = Order::orderBy("id", "desc");

        // // If the user is not an admin, only show their orders
        // if ($user->role !== 'admin') {
        //     $query->where('user_id', $user->id);
        // }

        // $orders = $query->paginate($perPage);
        // dd(  $orders);

        // $orders = Order::orderBy("id","desc")->paginate(10);
        return  Inertia::render('Order/Index');
    }
    public function getOrder(Request $request)
    {

        // $user = Auth::user();
        // $perPage = $request->get('per_page', 10); // default 10

        // $query = Order::orderBy("id", "desc");

        // // If the user is not an admin, only show their orders
        // if ($user->role !== 'admin') {
        //     $query->where('user_id', $user->id);
        // }

        // $orders = $query->paginate($perPage);

          $user = Auth::user();
        $perPage = $request->get('per_page', 10); // default 10

        $query = Order::orderBy("id", "desc");

        // If the user is not an admin, only show their orders
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $orders = $query->paginate($perPage);
        dd(  $orders);

       
        return response()->json([
            'orders' => $orders,
        ]);
    }
}
