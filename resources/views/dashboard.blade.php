<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Materiais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="container mx-auto">

                        <div class="flex gap-4">
                            <a class="px-6 py-2 min-w-[120px] text-center text-white bg-indigo-500 border border-indigo-500 rounded active:text-indigo-500 hover:bg-transparent hover:text-indigo-500 focus:outline-none focus:ring"
                                href="{{ route('material.create') }}">
                                Adicionar Material
                            </a>
                        </div>

                        @isset($mensagemSucesso)
                            <div class="bg-green-500 py-2 px-4 rounded-md mt-2 mb-2 text-white text-center">
                                {{ $mensagemSucesso }}
                            </div>
                        @endisset

                        <div class="flex gap-4 mt-5">
                            <form id="formPesq" action="{{ route('dashboard') }}" method="GET">
                                <div class="flex gap-4">
                                    <input type="text" name="codigo" id="codigo" value="{{ $codigo }}"
                                        class="block w-full rounded-md border-0 py-1.5 pl-8 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        placeholder="Código">
                                    <input type="descricao" name="descricao" id="descricao" value="{{ $descricao }}"
                                        class="block w-full rounded-md border-0 py-1.5 pl-8 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        placeholder="Descrição">
                                    <button type="submit"
                                        class="w-40 flex justify-center px-6 py-2 min-w-[120px] text-center text-white bg-gray-500 border border-gray-500 rounded active:text-gray-500 hover:bg-transparent hover:text-gray-500 focus:outline-none focus:ring">Pesquisar</button>
                                </div>
                            </form>
                        </div>

                        @if (count($materiais->all()) > 0 && is_array($materiais->all()))
                            <div class="flex flex-col mt-5">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                            <table class="min-w-full">
                                                <thead class="border-b">
                                                    <tr>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Código</th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Descrição</th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Data</th>
                                                        <th scope="col"
                                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                            Status de disponibilidade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($materiais as $material)
                                                        <tr class="bg-white border-b hover:border-black"
                                                            onclick="location.href='{{ route('material.edit', $material->id) }}'">
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                {{ $material->codigo }}</td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $material->descricao }}</td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $material->updated_at == null ? date('d/m/Y H:i:s', strtotime($material->created_at)) : date('d/m/Y H:i:s', strtotime($material->updated_at)) }}
                                                            </td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $material->status == true ? 'Disponível' : 'Indisponível' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-black-500 py-2 px-4 rounded-md mt-2 mb-2 text-black text-center">
                                Nenhum material encontrado
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
