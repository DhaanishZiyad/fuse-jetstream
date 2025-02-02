<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count(); // Adjust if you use different roles
        $totalRevenue = Order::where('status', 'pending')->sum('total'); // Sum only completed orders
        $totalItemsSold = OrderItem::sum('quantity'); // Sum of all items sold

        return view('admin.dashboard', compact('totalOrders', 'totalCustomers', 'totalRevenue', 'totalItemsSold'));
    }
}

