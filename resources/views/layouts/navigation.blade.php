@use('\App\Helper\CustomHelper', 'Helper')
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="{{-- max-w-7xl --}} mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">


            <div class="-me-2 flex items-center lg:hidden">
                <button id="navbar-open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div id="clock" class="hidden sm:block text-sm text-slate-700"><strong>Time: </strong>01-01-1970 00:00:00 PM</div>


            <div class="flex items-center gap-2">
                <div class="relative group">
                    <div id="toggleNotificationPanel" class="bg-slate-50 flex justify-center items-center gap-[1px] h-10 w-10 rounded-full cursor-pointer hover:bg-slate-200">

                        {{-- for empty notification > --}}

                        {{-- for new notification > --}}
                        @if (count(auth()->user()->unreadNotifications) > 0)
                            <i class="fa fa-bell animate-wiggle-fast text-blue-800"></i>
                        @else
                            <i class="fa fa-bell animate-wiggle text-blue-800"></i>
                        @endif

                    </div>
                    <div id="notificationPanel" data-visible="false" class="w-[96%] sm:w-[330px] max-h-[300px] fixed sm:absolute top-16 sm:top-[calc(100%+10px)] left-[2%] sm:left-auto sm:-translate-x-0 sm:right-[50%] z-50 rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white transition-all sm:-translate-y-3 opacity-0 invisible shadow-lg overflow-y-auto divide-y-[1px]">
                        @forelse (auth()->user()->unreadNotifications as $notification)
                            <a href="#" class="flex items-center justify-between px-4 py-3 gap-1 hover:bg-slate-200 border-l-[3px] bg-slate-100 border-l-blue-500">
                                <div class="flex items-center gap-3">
                                    <i class="fa fa-bell animate-wiggle text-blue-800"></i>
                                    <div>
                                        <p class="text-sm font-bold"> {{ $notification->data['message'] }} </p>
                                        </div>
                                </div>
                                <div>
                                    {{-- <p class="text-xs text-slate-600">2 min ago</p> --}}
                                </div>
                            </a>
                        @empty
                            <a href="#" class="flex items-center justify-between px-4 py-3 gap-1 hover:bg-slate-200 border-l-[3px] bg-slate-100 border-l-blue-500">
                                <div class="flex items-center gap-3">
                                    <i class="fa fa-bell animate-wiggle text-blue-800"></i>
                                    <div>
                                        <p class="text-sm font-bold">No Notification</p>
                                    </div>
                                </div>
                            </a>
                        @endforelse

                    </div>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <img src="{{ file_exists(substr(auth()->user()->photo, 1)) ? auth()->user()->photo : asset('assets/images/profile.png') }}" class="h-10 aspect-square bg-slate-200 rounded-full mr-3 p-[2px]" alt="">
                            <div>{{ auth()->user()->name }}</div>
                            {{-- profile.png --}}

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
        </div>
    </div>
</nav>

<script>
    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';

        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'

        // Add leading zeros if needed
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        // Get current date
        var date = now.getDate();
        var month = now.getMonth() + 1; // January is 0!
        var year = now.getFullYear();

        // Add leading zeros to date and month if needed
        date = date < 10 ? '0' + date : date;
        month = month < 10 ? '0' + month : month;

        // Update the clock display
        document.getElementById('clock').innerHTML = "<strong>Time:</strong> " + date + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Update the clock immediately
        updateClock();

        // Update the clock every second
        setInterval(updateClock, 1000);

        $("#toggleNotificationPanel").click(function(e) {
            $.ajax({
                type: "GET",
                url: "{{ route('notification.read') }}",
                success: function(response) {

                }
            });
        });

    });
</script>
