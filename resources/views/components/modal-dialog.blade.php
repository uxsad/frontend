<div x-data="{ {{ $variable }}: {{ $startVisible ? "true" : "false" }} }">
    <button @click="open = !open" class="{{  $btnClass }}">
        {{ $button }}
    </button>
    <div x-show="{{$variable}}" @click="{{$variable}}=!{{$variable}}"
         class="h-screen w-screen fixed top-0 left-0 right-0 bottom-0 bg-black bg-opacity-50 z-50"
         style="display: none;"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div @click.stop x-show="{{$variable}}"
             class="absolute min-w-3/4 md:min-w-2/4 transform top-2/4 left-2/4 rounded-lg bg-white -translate-x-2/4 -translate-y-2/4 p-6 max-w-full"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 transform scale-50"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-50">
            {{ $slot }}
        </div>
    </div>
</div>
