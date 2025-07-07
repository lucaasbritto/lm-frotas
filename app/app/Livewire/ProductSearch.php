<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSearch extends Component
{
    use WithPagination;

    #[Url(keep: true)]
    public string $search = '';

    #[Url(keep: true)]
    public array $selectedCategories = [];

    #[Url(keep: true)]
    public array $selectedBrands = [];

     public function applyFilters()
    {
        $this->filtersApplied = true;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'selectedCategories', 'selectedBrands']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()->with(['category', 'brand']);

        if ($this->search !== '') {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand_id', $this->selectedBrands);
        }

        $products = $query->paginate(10);

        return view('livewire.product-search', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }
}
