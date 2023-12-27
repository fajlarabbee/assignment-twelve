@include('layouts.backend.header')
<!-- sidebar menu overlay -->
<div x-cloak class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>

{{--<x-loader/>--}}

<x-scroll-to-top/>


<div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">
    <div class="main-content flex min-h-screen flex-col" style="margin-left:0">
        <x-header.horizontal/>
        <div class="animate__animated p-6" :class="[$store.app.animation]">
            <!-- start main content section -->
            <div>
                <div class="pt-5">
                    @yield('content')
                </div>
            </div>
            <!-- end main content section -->
        </div>

@include('layouts.backend.footer')
