<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center border-b border-gray-200 pb-8">
            @yield('header')
        </div>
    </x-slot>

    <div>
        <div class="p-6 bg-white overflow-hidden sm:rounded-b-lg">
            @yield('content')
        </div>
    </div>
</x-app-layout>
