{{--<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">--}}
{{--    <!-- Primary Navigation Menu -->--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between h-16">--}}
{{--            <div class="flex">--}}
{{--                <!-- Logo -->--}}
{{--                <div class="flex-shrink-0 flex items-center">--}}
{{--                    <a href="{{ route('dashboard') }}">--}}
{{--                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <!-- Navigation Links -->--}}
{{--                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
{{--                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">--}}
{{--                        {{ __('Dashboard') }}--}}
{{--                    </x-nav-link>--}}
{{--                </div>--}} {{--            </div>--}}

{{--            <!-- Settings Dropdown -->--}}
{{--            <div class="hidden sm:flex sm:items-center sm:ml-6">--}}
{{--                <x-dropdown align="right" width="48">--}}
{{--                    <x-slot name="trigger">--}}
{{--                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">--}}
{{--                            <div>{{ Auth::user()->name }}</div>--}}

{{--                            <div class="ml-1">--}}
{{--                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                    </x-slot>--}}

{{--                    <x-slot name="content">--}}
{{--                        <!-- Authentication -->--}}
{{--                        <form method="POST" action="{{ route('logout') }}">--}}
{{--                            @csrf--}}

{{--                            <x-dropdown-link :href="route('logout')"--}}
{{--                                    onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">--}}
{{--                                {{ __('Log out') }}--}}
{{--                            </x-dropdown-link>--}}
{{--                        </form>--}}
{{--                    </x-slot>--}}
{{--                </x-dropdown>--}}
{{--            </div>--}}

{{--            <!-- Hamburger -->--}}
{{--            <div class="-mr-2 flex items-center sm:hidden">--}}
{{--                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">--}}
{{--                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
{{--                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />--}}
{{--                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Responsive Navigation Menu -->--}}
{{--    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}
{{--        <div class="pt-2 pb-3 space-y-1">--}}
{{--            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">--}}
{{--                {{ __('Dashboard') }}--}}
{{--            </x-responsive-nav-link>--}}
{{--        </div>--}}

{{--        <!-- Responsive Settings Options -->--}}
{{--        <div class="pt-4 pb-1 border-t border-gray-200">--}}
{{--            <div class="flex items-center px-4">--}}
{{--                <div class="flex-shrink-0">--}}
{{--                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />--}}
{{--                    </svg>--}}
{{--                </div>--}}

{{--                <div class="ml-3">--}}
{{--                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>--}}
{{--                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="mt-3 space-y-1">--}}
{{--                <!-- Authentication -->--}}
{{--                <form method="POST" action="{{ route('logout') }}">--}}
{{--                    @csrf--}}

{{--                    <x-responsive-nav-link :href="route('logout')"--}}
{{--                            onclick="event.preventDefault();--}}
{{--                                        this.closest('form').submit();">--}}
{{--                        {{ __('Log out') }}--}}
{{--                    </x-responsive-nav-link>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
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
                <span>Dropdown</span>
                <button @click="open = !open" class="inline-block ml-auto">
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                     class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
            </a>
            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="dropdown-menu w-full" style="position: relative!important;">
                <a href="#">Link #1</a>
                <a href="#">Link #2</a>
                <a href="#">Link #3</a>
            </div>
        </div>
        <a class="nav-item"
           href="#">Blog</a>
        <a class="nav-item"
           href="#">Portfolio</a>
        <a class="nav-item"
           href="#">About</a>
        <a class="nav-item"
           href="#">Contact</a>
    </nav>
</div>
