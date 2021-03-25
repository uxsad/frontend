@extends('layouts.dashboard')

@section('header')
    <div class="flex-grow">
        <h1>{{$website->name}}</h1>
        <x-breadcrumbs :path="\App\BreadcrumbsHelper::getWebsitePath($website)"></x-breadcrumbs>
    </div>
    <button
        class="w-12 h-12 inline-block text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
        <span class="fas fa-pen fa-lg" aria-label="Add new website"></span>
    </button>
@endsection

@section('content')
    <div class="overflow-x-auto">
        <table class="table-fixed border-collapse w-full">
            <thead>
            <tr>
                <th class="w-10/12 py-3 px-3 text-left" scope="col">Page</th>
                <th class="w-1/12 py-3 px-3 text-center" scope="col">Emotion</th>
                <th class="w-1/12 py-3 px-3 text-center" scope="col"></th>
            </tr>
            </thead>
            <tbody class="text-gray-600 'text-sm font-light">
            @foreach($website->pages as $page)
                <tr class="cursor-pointer" x-data="{ link: '{{route('page', ['id'=>$page->id])}}' }"
                    @click="window.location.href = link">
                    <td class="py-3 px-3 text-left whitespace-nowrap font-medium">{{$page->title}}</td>
                    <td class="py-3 px-3 text-center whitespace-nowrap">
                        <span class="h-5 mx-auto fas fa-smile fa-lg" aria-label="Happy"></span>
                    </td>
                    <td @click.away="open = false" x-data="{ open: false }"
                        class="py-3 px-3 text-center whitespace-nowrap">
                        <button @click="open = !open" @click.stop class="px-1 py-1">
                            <span class="h-5 mx-auto fas fa-ellipsis-v fa-lg" aria-label="More"></span>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="dropdown-menu" style="display:none;">
                            <a href="#">Delete</a>
                            <a href="#">Share</a>
                            <a href="#">Edit</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
