<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center border-b border-gray-200 pb-8">
            <div class="flex-grow">
                <h1>Websites</h1>
                <x-breadcrumbs :path="['Websites']"></x-breadcrumbs>
            </div>
            <button
                class="w-12 h-12 inline-block text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
                <svg class="mx-auto fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </button>
        </div>
    </x-slot>

    <div>
        <div class="p-6 bg-white overflow-hidden sm:rounded-b-lg">
            <div class="overflow-x-auto">
                <table class="table-fixed border-collapse w-full">
                    <thead>
                    <tr>
                        <th class="w-9/12 py-3 px-3 text-left" scope="col">Website</th>
                        <th class="w-1/12 py-3 px-3 text-center" scope="col"># pages</th>
                        <th class="w-1/12 py-3 px-3 text-center" scope="col">Emotion</th>
                        <th class="w-1/12 py-3 px-3 text-center" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach(Auth::user()->websites()->get() as $website)
                        <tr class="cursor-pointer" x-data="{ link: '{{route('website', ['id'=>$website->id])}}' }"
                            @click="window.location.href = link">
                            <td class="py-3 px-3 text-left whitespace-nowrap font-medium">{{$website->name}}</td>
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
        </div>
    </div>
</x-app-layout>
