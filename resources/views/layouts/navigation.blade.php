<div @click.away="openSidebar = false"
     class="flex flex-col w-full md:w-1/5 text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0"
     x-data="{ openSidebar: false }">
    <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between md:block text-center">
        <a href="#"
           class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600"/>
        </a>
        <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline"
                @click="openSidebar = !openSidebar">
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path x-show="!openSidebar" fill-rule="evenodd"
                      d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                      clip-rule="evenodd"></path>
                <path x-show="openSidebar" fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    <nav :class="{'block': openSidebar, 'hidden': !openSidebar}" class="md:block sidebar">
        <div class="flex flex-col items-center mt-4 w-full py-6 px-4 border-b border-gray-200 mb-6">
            <div class="h-20 w-20 rounded-full border overflow-hidden">
                <img src="https://robohash.org/{{Auth::user()->email}}?set=set4" alt="Avatar" class="h-full w-full"/>
            </div>
            <div class="text-sm font-semibold mt-2">{{Auth::user()->name}}</div>
        </div>
        <div class="dropdown" x-data="{ open: true }">
            <a href="#" class="nav-item active">
                <span class="icon fas fa-home fa-lg"></span>
                <span>Dashboard</span>
                <button @click="open = !open" class="inline-block ml-auto">
                    <span class="fas " :class="{'fa-chevron-up': open, 'fa-chevron-down': !open}"></span>
                </button>
            </a>
            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="dropdown-menu w-full" style="position: relative; margin-top: 0; padding-top: 0;">
                <a class="nav-item" href="#">My Websites</a>
                <a class="nav-item" href="#">Shared with me</a>
            </div>
        </div>
        <a class="nav-item" href="#">
            <span class="icon fas fa-cog fa-lg"></span>
            Settings
        </a>
        <a class="nav-item" href="#">
            <span class="icon fas fa-ellipsis-h fa-lg"></span>
            More
        </a>
    </nav>
</div>
