<div class="space-y-6">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        
        <div>
            <label class="flex items-center text-sm font-semibold text-[#595a5a] mb-1">
                <i class="bi bi-search mr-2 text-[#f68b21]"></i> Nome do Produto
            </label>
            <input 
                type="text" 
                wire:model.debounce.300ms="search" 
                placeholder="Ex: Notebook" 
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#f68b21]"
            >
        </div>
        
        <div>
            <label class="flex items-center text-sm font-semibold text-[#595a5a] mb-1">
                <i class="bi bi-tags mr-2 text-[#f68b21]"></i> Categorias
            </label>
            <select 
                wire:model="selectedCategories" 
                multiple 
                size="4"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#f68b21] resize-none"
            >
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label class="flex items-center text-sm font-semibold text-[#595a5a] mb-1">
                <i class="bi bi-bookmark-star mr-2 text-[#f68b21]"></i> Marcas
            </label>
            <select 
                wire:model="selectedBrands" 
                multiple 
                size="4"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#f68b21] resize-none"
            >
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-center items-center mt-4 gap-4">
    
    
    <button wire:click="applyFilters"
            class="bg-[#f68b21] hover:bg-[#e07b1c] text-white px-6 py-2 rounded flex items-center shadow">
        <i class="bi bi-search me-2"></i> Pesquisar
    </button>
    
    <button wire:click="clearFilters"
            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded flex items-center">
        <i class="bi bi-x-circle me-2"></i> Limpar Filtros
    </button>
</div>

    <hr class="my-6 border-gray-300">

    <div>
        @if ($products->isEmpty())
            <p class="text-gray-500">Nenhum produto encontrado com os filtros aplicados.</p>
        @else
            <ul class="space-y-3">
                @foreach ($products as $product)
                    <li class="p-4 bg-white rounded shadow-sm flex justify-between items-center border border-[#f68b21]">
                        <div>
                            <h3 class="font-semibold text-lg text-[#f68b21]">{{ $product->name }}</h3>
                            <p class="text-sm text-[#595a5a]">
                                <i class="bi bi-tag-fill text-[#595a5a] mr-1"></i> {{ $product->category->name }}
                                &middot;
                                <i class="bi bi-bookmark-fill text-[#595a5a] mr-1"></i> {{ $product->brand->name }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
