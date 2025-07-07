<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Catálogo de Produtos' }}</title>
        
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800 font-sans"
      style="background: url('{{ asset('images/bg-moot.jpg') }}') no-repeat center center fixed;
             background-size: cover;">

    <header class="shadow" style="background:#595a5a">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-moot.png') }}" alt="Logo" class="h-10 w-auto">                
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    @livewireScripts
</body>
</html>
