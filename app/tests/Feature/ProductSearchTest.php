<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function filters_products_by_name()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        Product::factory()->create([
            'name' => 'Celular Pro Max',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        Product::factory()->create([
            'name' => 'Carregador',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        Livewire::test('product-search')
            ->set('search', 'Celular')
            ->assertSee('Celular Pro Max')
            ->assertDontSee('Carregador');
    }

    #[Test]
    public function filters_products_by_selected_categories()
    {
        $brand = Brand::factory()->create();
        $cat1 = Category::factory()->create(['name' => 'Informática']);
        $cat2 = Category::factory()->create(['name' => 'Eletrônicos']);

        Product::factory()->create([
            'name' => 'Computador',
            'category_id' => $cat1->id,
            'brand_id' => $brand->id,
        ]);

        Product::factory()->create([
            'name' => 'Televisão',
            'category_id' => $cat2->id,
            'brand_id' => $brand->id,
        ]);

        Livewire::test('product-search')
            ->set('selectedCategories', [$cat1->id])
            ->assertSee('Computador')
            ->assertDontSee('Televisão');
    }

    #[Test]
    public function filters_products_by_selected_brands()
    {
        $category = Category::factory()->create();
        $brand1 = Brand::factory()->create(['name' => 'Positivo']);
        $brand2 = Brand::factory()->create(['name' => 'Samsung']);

        Product::factory()->create([
            'name' => 'Notebook',
            'brand_id' => $brand1->id,
            'category_id' => $category->id,
        ]);

        Product::factory()->create([
            'name' => 'Televisão',
            'brand_id' => $brand2->id,
            'category_id' => $category->id,
        ]);

        Livewire::test('product-search')
            ->set('selectedBrands', [$brand1->id])
            ->assertSee('Notebook')
            ->assertDontSee('Televisão');
    }

    #[Test]
    public function filters_products_by_name_category_and_brand_combined()
    {
        $cat = Category::factory()->create();
        $brand = Brand::factory()->create();

        Product::factory()->create([
            'name' => 'Notebook',
            'category_id' => $cat->id,
            'brand_id' => $brand->id,
        ]);

        Product::factory()->create([
            'name' => 'Mouse',
            'category_id' => $cat->id,
            'brand_id' => $brand->id,
        ]);

        Livewire::test('product-search')
            ->set('search', 'Notebook')
            ->set('selectedCategories', [$cat->id])
            ->set('selectedBrands', [$brand->id])
            ->assertSee('Notebook')
            ->assertDontSee('Mouse');
    }

    #[Test]
    public function clears_all_search_filters_correctly()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        Product::factory()->create([
            'name' => 'Notebook',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        Livewire::test('product-search')
            ->set('search', 'Notebook')
            ->set('selectedCategories', [$category->id])
            ->set('selectedBrands', [$brand->id])
            ->call('clearFilters')
            ->assertSet('search', '')
            ->assertSet('selectedCategories', [])
            ->assertSet('selectedBrands', []);
    }
}
