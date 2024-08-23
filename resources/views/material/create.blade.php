<x-layout title="Cadastrar Material">

    <x-header></x-header>

    <x-material.form :action="route('material.store')" :material="$material"></x-material.form>

</x-layout>
