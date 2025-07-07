@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
            <i class="bi bi-box-seam text-[#f68b21] text-xl"></i>
            Busca de Produtos
        </h1>

        @livewire('product-search')
    </div>
@endsection
