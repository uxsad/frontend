<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center border-b border-gray-200 pb-8">
            <div class="flex-grow">
                <h1>Websites</h1>
                <nav class="text-black mt-2 text-xs" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <a href="#">Home</a>
                            <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 320 512">
                                <path
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <a href="#">Second Level</a>
                            <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 320 512">
                                <path
                                    d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                            </svg>
                        </li>
                        <li>
                            <a href="#" class="text-gray-500" aria-current="page">Third Level</a>
                        </li>
                    </ol>
                </nav>
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
                        <tr class="cursor-pointer">
                            <td class="py-3 px-3 text-left whitespace-nowrap font-medium">{{$website->name}}</td>
                            <td class="py-3 px-3 text-center whitespace-nowrap">{{$website->pages()->count()}}</td>
                            <td class="py-3 px-3 text-center whitespace-nowrap">
                                <svg class="h-6 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </td>
                            <td @click.away="open = false" x-data="{ open: false }"
                                class="py-3 px-3 text-center whitespace-nowrap">
                                <button @click="open = !open">
                                    <svg class="h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                    </svg>
                                </button>
                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="dropdown">
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
