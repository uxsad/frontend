@extends('layouts.dashboard')

@section('header')
    <div class="flex-grow">
        <h1>
            @switch($type)
                @case(\App\BreadcrumbsHelper::DASHBOARD_MINE)
                My Websites
                @break
                @case(\App\BreadcrumbsHelper::DASHBOARD_SHARED)
                Websites Shared With Me
                @break
                @default
                Websites
                @break
            @endswitch
        </h1>
        <x-breadcrumbs :path="\App\BreadcrumbsHelper::getDashboardPath($type)"></x-breadcrumbs>
    </div>
    @unless($type == \App\BreadcrumbsHelper::DASHBOARD_SHARED)
        <x-modal-dialog variable="open"
                        startVisible="{{ $errors->any() ? 'true' : 'false' }}"
                        btnClass="w-12 h-12 inline-block text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
            <x-slot name="button">
                <span class="fas fa-plus fa-lg" aria-label="Add new website"></span>
            </x-slot>

            <header class="flex flex-row items-center border-b border-gray-200 pb-2">
                <h2>Add Website</h2>
            </header>
            <div class="pt-6">
                <form class="form" action="{{ route('websites.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="website-name-input">Name</label>
                        <input class="custom-input @error('name') error @enderror"
                               id="website-name-input" type="text" placeholder="e.g.: Google"
                               name="name" value="{{old('name')}}" required>
                        @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="website-url-input">Base URL</label>
                        <input class="custom-input @error('base_url') error @enderror"
                               id="website-url-input" type="url" placeholder="e.g.: https://google.com/"
                               name="base_url" value="{{old('base_url')}}" required>
                        @error('base_url')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-right mt-6">
                        <input type="reset" class="btn-secondary" @click="open=!open" value="Cancel"/>
                        <input type="submit" class="btn-primary" value="Add"/>
                    </div>
                </form>
            </div>
        </x-modal-dialog>
    @endunless
@endsection

@push('body.scripts')
    <script>
        $(document).ready(function(){
            $('#websites-table').DataTable({
                responsive: true,
                paging: false,
                info: false
            });
        });
    </script>
@endpush

@section('content')
    <div class="overflow-x-auto">
        <table class="table-fixed border-collapse w-full" id="websites-table">
            <thead>
            <tr>
                <th class="w-9/12 py-3 px-3 text-left" scope="col">Website</th>
                <th class="w-1/12 py-3 px-3 text-center" scope="col"># pages</th>
                <th class="w-1/12 py-3 px-3 text-center" scope="col">Emotion</th>
                <th class="w-1/12 py-3 px-3 text-center" scope="col"></th>
            </tr>
            </thead>
            <tbody class="text-gray-600 'text-sm font-light">
            @foreach($websites as $website)
                <tr class="cursor-pointer" x-data="{ link: '{{route('websites.show', $website->id)}}' }"
                    @click="window.location.href = link">
                    <td class="py-3 px-3 text-left whitespace-nowrap font-medium">
                        @if($website->owner->id != auth()->id())
                            <small class="mr-2 text-gray-400" aria-label="Shared with me">
                                <span class="fas fa-user-friends fa-xs"></span>
                            </small>
                        @endif
                        {{$website->name}}
                    </td>
                    <td class="py-3 px-3 text-center whitespace-nowrap">{{$website->pages()->count()}}</td>
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
