@extends('layouts.admin-app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="flex justify-center items-center bg-fuse-green-500">
    <div class="flex w-9/12 align-center items-center mt-14 py-7">
        <p class="font-extrabold font-raleway text-7xl text-white">ANALYTICS</p>
    </div>
</div>
<div class="container mx-auto py-8 w-9/12">
    <!-- Stats Grid -->
    <div class="grid grid-cols-2 gap-6">
        <!-- Total Orders -->
        <div class="bg-white p-3 px-4 rounded-lg border-fuse-green-500 border-2">
            <h2 class="text-lg font-bold font-raleway text-fuse-green-500">TOTAL ORDERS</h2>
            <p class="text-2xl font-extrabold font-ruda text-[#1E1E1E] flex justify-end">{{ $totalOrders }}</p>
        </div>

        <!-- Registered Customers -->
        <div class="bg-white p-3 px-4 rounded-lg border-fuse-green-500 border-2">
            <h2 class="text-lg font-bold font-raleway text-fuse-green-500">REGISTERED CUSTOMERS</h2>
            <p class="text-2xl font-extrabold font-ruda text-[#1E1E1E] flex justify-end">{{ $totalCustomers }}</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white p-3 px-4 rounded-lg border-fuse-green-500 border-2">
            <h2 class="text-lg font-bold font-raleway text-fuse-green-500">TOTAL REVENUE</h2>
            <p class="text-2xl font-extrabold font-ruda text-[#1E1E1E] flex justify-end">LKR {{ number_format($totalRevenue, 2) }}</p>
        </div>

        <!-- Total Items Sold -->
        <div class="bg-white p-3 px-4 rounded-lg border-fuse-green-500 border-2">
            <h2 class="text-lg font-bold font-raleway text-fuse-green-500">ITEMS SOLD</h2>
            <p class="text-2xl font-extrabold font-ruda text-[#1E1E1E] flex justify-end">{{ $totalItemsSold }}</p>
        </div>
    </div>
</div>
@endsection
