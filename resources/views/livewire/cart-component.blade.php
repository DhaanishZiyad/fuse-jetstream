<div>
    <!-- Cart Items Column -->
    <div class="w-full md:w-2/3 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Your Cart</h2>

        @if ($cartItems->count() > 0)
            <div class="space-y-6">
                @foreach ($cartItems as $item)
                    <div class="flex justify-between items-center border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-md">
                            <div>
                                <h3 class="text-xl font-bold">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">LKR {{ number_format($item->product->current_price, 2) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <input type="number" 
                                wire:model.lazy="cartItems.{{ $loop->index }}.quantity"
                                wire:change="updateQuantity({{ $item->id }}, $event.target.value)"
                                value="{{ $item->quantity }}" 
                                min="1" 
                                class="w-16 border border-gray-300 rounded-md text-center">
                            <button wire:click="removeItem({{ $item->id }})" class="text-red-500 font-bold">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

    <!-- Cart Calculations Column -->
    <div class="w-full md:w-1/3 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Cart Summary</h2>
        <div class="space-y-4">
            <div class="flex justify-between">
                <span class="font-bold">Subtotal</span>
                <span class="text-lg font-semibold">LKR {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-bold">Shipping</span>
                <span class="text-lg font-semibold">LKR {{ number_format($shipping, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-bold">Total</span>
                <span class="text-lg font-semibold">LKR {{ number_format($total, 2) }}</span>
            </div>
            <div class="mt-6">
                <button class="w-full bg-[#21A179] text-white px-5 py-3 rounded-md font-bold">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
</div>