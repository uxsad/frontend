<div x-data="{ {{ $variable}}: false}">
    <button @click="open = !open" class="{{  $btnClass }}">
        {{ $button }}
    </button>
    <div x-show="{{$variable}}" @click="{{$variable}}=!{{$variable}}"
         class="h-screen w-screen fixed top-0 left-0 right-0 bottom-0 bg-black bg-opacity-50"
         style="display: none;">
        <div @click.stop
             class="absolute transform top-2/4 left-2/4 rounded-lg bg-white -translate-x-2/4 -translate-y-2/4 p-6">
            {{ $slot  }}
        </div>
    </div>
</div>
