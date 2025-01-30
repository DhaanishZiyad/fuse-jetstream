<div class="font-ruda items-center py-10 flex justify-center">
    <div class="w-9/12">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Cart Items Column -->
            <div class="w-full md:w-2/3">
                <h2 class="text-2xl font-raleway font-bold text-fuse-green-500 mb-4">YOUR CART</h2>
                <hr class="mb-2 border-fuse-green-500 border-[1px]">
                @if (count($cartItems) > 0)
                    <div class="space-y-6">
                        @foreach ($cartItems as $item)
                            <div class="flex justify-between items-center border-b pb-4">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $item['product']['image_path']) }}" 
                                         alt="{{ $item['product']['name'] }}" 
                                         class="w-20 h-20 object-cover">
                                    <div>
                                        <h3 class="font-bold">{{ $item['product']['name'] }}</h3>
                                        <p class="text-sm text-gray-500">Size: {{ $item['size'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <!-- Normal Quantity Input -->
                                    <input 
                                        type="number" 
                                        id="quantity-{{ $item['id'] }}" 
                                        name="quantity" 
                                        value="{{ $item['quantity'] }}" 
                                        min="1" 
                                        class="w-24 text-center border-2 border-fuse-green-500 rounded-md"
                                        wire:model="cartItems.{{ $loop->index }}.quantity" 
                                        wire:change="updateQuantity({{ $item['id'] }}, $event.target.value)">
                                    <!-- Remove Button -->
                                    <button wire:click="removeItem({{ $item['id'] }})" 
                                            class="text-red-500 font-bold">Remove</button>
                                    <p class="font-bold">LKR {{ number_format($item['product']['current_price'], 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Your cart is empty.</p>
                @endif
            </div>

            <!-- Cart Summary Column -->
            <div class="w-full md:w-1/3 p-6">
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="font-bold">SUBTOTAL</span>
                        <span class="text-lg font-semibold">LKR {{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-bold">SHIPPING</span>
                        <span class="text-lg font-semibold">LKR {{ number_format($shipping, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-bold">ESTIMATED TOTAL</span>
                        <span class="text-lg font-semibold">LKR {{ number_format($total, 2) }}</span>
                    </div>
                    <div class="mt-6">
                        <button class="w-full bg-[#21A179] text-white px-5 py-3 rounded-md font-bold">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
