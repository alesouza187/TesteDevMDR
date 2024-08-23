
@if (session('error'))
    <div class="container mx-auto">
        <div class="bg-red-500 py-2 px-4 rounded-md mt-2 mb-2 text-white text-center">
            {{ session('error') }}
        </div>
    </div>
@endif


<div class="container mx-auto">
    <form action="{{ $action }}" method="POST">
        @csrf

        @isset($material->id)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">*Código:</label>
            <input type="text" id="codigo" name="codigo"
                {{-- @isset($material->codigo)value="{{ $material->codigo }}"@endisset --}}
                value="{{ old('codigo', session('material')['codigo'] ?? '') }}"
                class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Código" required>
        </div>
        <div class="mb-4">
            <label for="descricao"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">*Descrição:</label>
            <textarea id="descricao" name="descricao"
                class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Informe a descrição do material" required>{{ old('descricao', session('material')['descricao'] ?? '') }}</textarea>
                {{-- @isset($material->descricao){{ $material->descricao }}@endisset --}}
        </div>
        <div class="mb-4">
            <label for="estoque" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantidade
                em estoque:</label>
            <input type="number" id="estoque" name="estoque"
                {{-- @isset($material->estoque)value="{{ $material->estoque == null ? 0 : $material->estoque }}"@endisset --}}
                value="{{ old('estoque', session('material')['estoque'] ?? '') }}"
                class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                min="0">
        </div>
        <div class="mb-4">
            <label for="valor" class="block text-sm font-medium leading-6 text-gray-900">Valor</label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="text-gray-500 sm:text-sm">R$</span>
                </div>
                <input type="text" name="valor" id="valor"  data-max-digits="15" maxlength="20"
                    {{-- @isset($material->valor)value="{{ $material->valor }}"@endisset --}}
                    value="{{ old('valor', session('material')['valor'] ?? '') }}"
                    class="block w-full rounded-md border-0 py-1.5 pl-8 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="0.00">
            </div>
        </div>
        <div class="mb-4 flex">
            <input type="checkbox" 
                @isset($material->status){{ $material->status == true ? 'checked' : '' }}@endisset
                value="true" class="peer sr-only opacity-0" id="status" name="status" />
            <label for="status"
                class="relative flex h-6 w-11 cursor-pointer items-center rounded-full bg-gray-400 px-0.5 outline-gray-400 transition-colors before:h-5 before:w-5 before:rounded-full before:bg-white before:shadow before:transition-transform before:duration-300 peer-checked:bg-green-500 peer-checked:before:translate-x-full peer-focus-visible:outline peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gray-400 peer-checked:peer-focus-visible:outline-green-500"
                for="toggle ">
                <span class="sr-only">Enable</span>
            </label>
            <p class="pl-2">Disponível em estoque</p>
        </div>

        <div class="mb-4 flex">
            <span class="text-xs">Campos com (*) são obrigatórios</span>
        </div>


        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <button type="submit"
                    class="w-40 flex justify-center px-6 py-2 min-w-[120px] text-center text-white bg-indigo-500 border border-indigo-500 rounded active:text-indigo-500 hover:bg-transparent hover:text-indigo-500 focus:outline-none focus:ring">{{ $material->id == null ? 'Adicionar' : 'Alterar' }}</button>
                @isset($material->id)
                    @if ($material->status == false)
                        <button type="button" onclick="openModal('modelConfirm')"
                            class="w-40 ml-2 flex justify-center px-6 py-2 min-w-[120px] text-center text-white bg-red-500 border border-red-500 rounded active:text-red-500 hover:bg-transparent hover:text-red-500 focus:outline-none focus:ring">Excluir</button>
                    @endif
                @endisset
            </div>
            <a href="{{ route('material.index') }}"
                class="w-40 flex justify-center px-6 py-2 min-w-[120px] text-center text-white bg-indigo-500 border border-indigo-500 rounded active:text-indigo-500 hover:bg-transparent hover:text-indigo-500 focus:outline-none focus:ring">Voltar</a>
        </div>
    </form>
</div>

@isset($material->id)
    <div id="modelConfirm" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4 ">
        <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
    
            <div class="flex justify-end p-2">
                <button onclick="closeModal('modelConfirm')" type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
    
            <div class="p-6 pt-0 text-center">
                <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">Deseja excluir material?</h3>
                <form action="{{ route('material.destroy', $material->id) }}" method="POST" class="inline-flex items-center">
                    @method('POST')
                    @csrf
                    <input type="hidden" value="@isset($material->status){{ $material->status == true ? 'true' : 'false' }}@endisset" name="status" id="deleteStatus" />
                    <button type="submit" onclick="closeModal('modelConfirm')"
                        class="text-white bg-red-500 border border-red-500 active:text-red-500 hover:bg-transparent hover:text-red-500 focus:outline-none focus:ring font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                        Excluir
                    </button>
                </form>
                <a href="#" onclick="closeModal('modelConfirm')"
                    class=" text-white bg-indigo-500 border border-indigo-500 active:text-indigo-500 hover:bg-transparent hover:text-indigo-500 focus:outline-none focus:ring font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center"
                    data-modal-toggle="delete-user-modal">
                    voltar
                </a>
            </div>
    
        </div>
    </div>
 @endisset