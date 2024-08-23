<x-layout title="Alterar Material">

    <x-header></x-header>

    <x-material.form :action="route('material.update', $material->id)" :material="$material"></x-material.form>

</x-layout>