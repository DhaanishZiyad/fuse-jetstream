<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel; // Alias the model
use App\Models\Product;
use Illuminate\Support\Collection;

class ShoppingCart extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 0;
    public $total = 0;

    protected $listeners = ['cartUpdated' => 'updateCart'];

public function mount()
{
    if (auth()->check()) {
        $this->cartItems = CartModel::with('product')
            ->where('customer_id', auth()->id())
            ->get()
            ->toArray(); // Convert to array
    }

    $this->calculateTotals();
}

public function updateQuantity($itemId, $quantity)
{
    // Find the item in the array by matching the ID
    $itemIndex = array_search($itemId, array_column($this->cartItems, 'id'));

    if ($itemIndex !== false) {
        // Ensure the quantity is at least 1
        $this->cartItems[$itemIndex]['quantity'] = max(1, $quantity);

        // Persist changes to the database
        CartModel::where('id', $itemId)->update([
            'quantity' => max(1, $quantity)
        ]);
    }

    // Recalculate totals after updating quantities
    $this->calculateTotals();
}

public function removeItem($itemId)
{
    CartModel::where('id', $itemId)->delete();

    // Remove the item from the array
    $this->cartItems = array_filter($this->cartItems, function($item) use ($itemId) {
        return $item['id'] !== $itemId;
    });

    // Recalculate totals
    $this->calculateTotals();

    session()->flash('success', 'Item removed successfully!');
}

public function calculateTotals()
{
    // Use array_reduce() for subtotal calculation
    $this->subtotal = array_reduce($this->cartItems, function ($carry, $item) {
        return $carry + ($item['quantity'] * $item['product']['current_price']);
    }, 0);

    // Assuming shipping is a fixed value
    $this->shipping = 500;

    $this->total = $this->subtotal + $this->shipping;
}

public function checkout()
{
    if (empty($this->cartItems)) {
        session()->flash('error', 'Your cart is empty.');
        return;
    }

    $order = \App\Models\Order::create([
        'user_id' => auth()->id(),
        'order_number' => 'ORD' . now()->timestamp, // Unique order number
        'total' => $this->total,
        'status' => 'pending',
        'address' => auth()->user()->address ?? 'No address provided',
        'city' => auth()->user()->city ?? 'No city provided',
        'phone' => auth()->user()->phone ?? 'No phone provided',
    ]);

    // Save each cart item to the order_items table
    foreach ($this->cartItems as $item) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['product']['current_price'],
            'size' => $item['size'], // Add this line to store the size
        ]);
    }

    // Clear the cart after checkout
    CartModel::where('customer_id', auth()->id())->delete();
    $this->cartItems = [];
    $this->calculateTotals();

    session()->flash('success', 'Order placed successfully!');

    return redirect()->route('customer.profile'); // Redirect to profile page
}

public function render()
{
    return view('livewire.cart-component', [
        'cartItems' => $this->cartItems,
        'subtotal' => $this->subtotal,
        'shipping' => $this->shipping,
        'total' => $this->total,
    ]);
}
}