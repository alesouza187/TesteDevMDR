<header class="lg:px-16 px-4 flex flex-wrap items-center py-4 shadow-lg mb-10">
    <div class="flex-1 flex justify-between items-center">
        MDR Dev Teste
    </div>
    <label for="menu-toggle" class="pointer-cursor md:hidden block">
        <svg class="fill-current text-gray-200" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 20 20">
            <title>menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
        </svg>
    </label>
    <input class="hidden" type="checkbox" id="menu-toggle" />

    <div class="hidden md:flex md:items-center md:w-auto w-full" id="menu">
        <nav>
            <ul class="md:flex items-center justify-between text-base text-gray-100 dark:text-gray-600 pt-4 md:pt-0">
                <li><a class="md:p-4 py-3 px-0 block text-black" href="{{ route('material.index') }}">Listagem de materiais</a></li>
                <li><a class="md:p-4 py-3 px-0 block md:mb-0 mb-2 text-black" href="/">Deslogar</a></li>
            </ul>
        </nav>
    </div>
</header>

@if ($errors->any())
    <div class="container mx-auto">
        <div class="bg-red-500 py-2 px-4 rounded-md mt-2 mb-2 text-white text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
