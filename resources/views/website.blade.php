@extends('layouts.dashboard')

@section('header')
    <div class="flex-grow">
        <h1>{{$website->name}}</h1>
        <x-breadcrumbs :path="\App\BreadcrumbsHelper::getWebsitePath($website)"></x-breadcrumbs>
    </div>
    <x-modal-dialog variable="open"
                    btnClass="w-12 h-12 inline-block text-center text-white transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
        <x-slot name="button">
            <span class="fab fa-js fa-lg" aria-label="Get JS Link"></span>
        </x-slot>

        <header class="flex flex-row items-center border-b border-gray-200 pb-2">
            <h2>Interactions Tracker</h2>
            <button @click="open=!open"
                    class="ml-auto w-10 h-10 inline-block text-center transition rounded-full ripple hover:shadow-lg hover:bg-blue-200 focus:outline-none">
                <span class="fas fa-times fa-lg" aria-label="Get JS Link" aria-hidden="true"></span>
            </button>
        </header>
        <div class="pt-6 prose max-w-none">
            <p>This is the link to the JS library you need to import in your website. Be sure to import it in all the
                pages you want to analyze.</p>
            <div class="relative" x-data="{ showDone: false }">
                <pre x-ref="link"><code class="plaintext">{!! route('get-js', $website->id) !!}</code></pre>
                <button title="Copy to clipboard" class="absolute top-0 w-8 h-8 right-0.5 text-white" @click.stop
                        @click="$clipboard($refs.link.innerText);showDone=true;setTimeout(()=>showDone=false, 1800)">
                    <span class="fas fa-clipboard fa-sm" aria-hidden="true"></span>
                    <span class="sr-only">Copy</span>
                </button>
                <div class="absolute top-8 right-0.5 text-white bg-green-900 px-2 py-1 rounded" x-show="showDone"
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-1000"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-90">
                    Done!
                </div>
            </div>
            <p>Depending on the way your website is built, there may be multiple ways of importing the library in your
                code. The simplest method is to import the library by pasting the following code right before the <code>&lt;/body&gt;</code>
                closing tag.</p>
            <div class="relative" x-data="{ showDone: false }">
                <pre><code x-ref="script" class="language-html">&lt;script type="text/javascript"
        src="{!! route('get-js', $website->id) !!}"&gt;&lt;/script&gt;</code></pre>
                <button title="Copy to clipboard" class="absolute top-0 w-8 h-8 right-0.5 text-white" @click.stop
                        @click="$clipboard($refs.script.innerText);showDone=true;setTimeout(()=>showDone=false, 1800)">
                    <span class="fas fa-clipboard fa-sm" aria-hidden="true"></span>
                    <span class="sr-only">Copy</span>
                </button>
                <div class="absolute top-8 right-0.5 text-white bg-green-900 px-2 py-1 rounded" x-show="showDone"
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 transform scale-90"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-1000"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-90">
                    Done!
                </div>
            </div>
        </div>
    </x-modal-dialog>
@endsection

@push('body.scripts')
    <script>
        $(document).ready(function () {
            $('#pages-table').DataTable({
                responsive: true,
                paging: false,
                info: false
            });
        });
    </script>
@endpush

@section('content')
    <div class="overflow-x-auto">
        <table class="table-fixed border-collapse w-full" id="pages-table">
            <thead>
            <tr>
                <th class="w-10/12 py-3 px-3 text-left" scope="col">Page</th>
                <th class="w-1/12 py-3 px-3 text-center" scope="col">Emotion</th>
                <th class="w-1/12 py-3 px-3 text-center" scope="col"></th>
            </tr>
            </thead>
            <tbody class="text-gray-600 'text-sm font-light">
            @foreach($website->pages as $page)
                <tr class="cursor-pointer" x-data="{ link: '{{route('pages.show', ['page'=>$page->id])}}' }"
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
