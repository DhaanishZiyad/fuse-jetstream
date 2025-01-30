

<div>
    <button wire:click="toggleWishlist"
        class="wishlist-button h-10 w-10 bg-white hover:bg-gray-100 rounded-full shadow-md flex justify-center items-center transition-colors duration-200 cursor-pointer"
        onclick="event.stopPropagation(); return false;">
        <img src="{{ $isWishlisted ? asset('images/RedHeart.svg') : asset('images/Heart.svg') }}" 
            alt="Wishlist Icon" 
            class="w-6 h-6 pointer-events-none">
    </button>
</div>


