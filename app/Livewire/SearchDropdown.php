<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $query = ''; // The search input value
    public $products = []; // The search results

    public function updatedQuery()
    {
        // Fetch products matching the query (case-insensitive)
        if (strlen($this->query) > 1) {
            $this->products = Product::where('name', 'like', '%' . $this->query . '%')
                ->get(['id', 'name', 'current_price', 'image_path']);
        } else {
            $this->products = [];
        }
    }

    public function redirectToProduct($id)
    {
        // Redirect to the product page (assuming a route exists for this)
        return redirect()->route('customer.product-detail', $id);
    }

    public function render()
    {
        return view('livewire.search-dropdown');
    }
}