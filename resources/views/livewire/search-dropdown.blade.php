<div class="relative font-normal w-full">
    <!-- Search Input -->
    <input 
        type="text" 
        input wire:model.live="query" 
        class="w-full h-10 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-black"
        placeholder="Search for products..."
    />

    <!-- Dropdown -->
    @if (!empty($products))
        <div class="absolute w-full bg-white border font-ruda border-gray-300 rounded-lg shadow-lg mt-1 z-10">
            <ul class="divide-y divide-gray-200">
                @foreach ($products as $product)
                    <li 
                        class="flex items-center px-4 py-4 hover:bg-gray-100 cursor-pointer"
                        wire:click="redirectToProduct({{ $product['id'] }})"
                    >
                        <!-- Product Image -->
                        <img 
                            src="{{ asset('storage/' . $product->image_path) }}" 
                            alt="{{ $product['name'] }}" 
                            class="w-20 h-20 object-cover rounded"
                        />
                        <!-- Product Info -->
                        <div class="ml-3">
                            <p class="font-bold text-gray-800">{{ $product['name'] }}</p>
                            <p class="text-sm text-gray-600">LKR {{ number_format($product['current_price'], 2) }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
