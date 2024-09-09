@use('\App\Helper\CustomHelper', 'Helper')
@use('\App\Models\IspConnection', 'IspConnection')

@php
    $pendingConnections = IspConnection::where('status', 'Pending')->count();
@endphp

<div class="space-y-2 -my-px flex flex-col min-w-80 min-h-full bg-white p-3 pb-6 relative">
    <div class="shrink-0 flex items-center justify-center my-1 mb-3">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/bcc_full_logo.png') }}" alt="" class="block h-16 w-auto fill-current text-gray-80">
        </a>
    </div>

    @if (Helper::canView('', 'Super Admin'))
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    @endif


    {{-- Group - BCC Connect --}}
    <x-nav-group title="BCC Connect">

        @if (Helper::canView('List Of ISP Connection', 'Super Admin'))
            <x-nav-link :href="route('isp_connection.index')" :active="request()->routeIs('isp_connection.*')">
                {{ __('Connections') }} @if ($pendingConnections > 0)
                    <span class="flex text-xs text-white bg-[#2A977A] [text-shadow:1px_1px_1px_#0a362a] h-6 justify-center items-center rounded-full aspect-square ml-1">{{ $pendingConnections }}</span>
                @endif
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ISP', 'Super Admin'))
            <x-nav-link :href="route('isp.index')" :active="request()->routeIs('isp.*')">
                {{ __('ISP') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of BCC Staff', 'Super Admin'))
            <x-nav-link :href="route('bcc_staff.index')" :active="request()->routeIs('bcc_staff.*')">
                {{ __('BCC Staffs') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of NTTN Datas', 'Super Admin'))
            <x-nav-link :href="route('nttn.index')" :active="request()->routeIs('nttn.*')">
                {{ __('NTTN Data') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of NTTN Staff', 'Super Admin'))
            <x-nav-link :href="route('nttn_staff.index')" :active="request()->routeIs('nttn_staff.*')">
                {{ __('NTTN Staffs') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('Search ISP Connection', 'Super Admin'))
            <x-nav-link :href="route('ispconnection.search')" :active="request()->routeIs('ispconnection.*')">
                {{ __('ISP Connection Search') }}
            </x-nav-link>
        @endif
    </x-nav-group>
    {{-- /Group - BCC Connect  --}}

    {{-- Group - NDC --}}
    <x-nav-group title="NDC">
        @if (Helper::canView('List Of NDC Appointment', 'Super Admin'))
            <x-nav-link :href="route('ndc.appointment.index')" :active="request()->routeIs('ndc.appointment.*')">
                {{ __('Appointment') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of NDC User', 'Super Admin'))
            <x-nav-link :href="route('ndc.user.index')" :active="request()->routeIs('ndc.user.*')">
                {{ __('User') }}
            </x-nav-link>
        @endif
    </x-nav-group>
    {{-- /Group - NDC --}}

    {{-- Group - ITEE  --}}
    <x-nav-group title="ITEE Exam">
        @if (Helper::canView('List Of ITEE Exam Application', 'Super Admin'))
            <x-nav-link :href="route('itee.exam.application.index')" :active="request()->routeIs('itee.exam.application.*')">
                {{ __('Exam Application List') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Students', 'Super Admin'))
            <x-nav-link :href="route('itee.students.index')" :active="request()->routeIs('itee.students.*')">
                {{ __('Students') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Notice', 'Super Admin'))
            <x-nav-link :href="route('itee.notice.index')" :active="request()->routeIs('itee.notice.*')">
                {{ __('Notice') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Venue', 'Super Admin'))
            <x-nav-link :href="route('itee.venue.index')" :active="request()->routeIs('itee.venue.*')">
                {{ __('Venue') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Exam Category', 'Super Admin'))
            <x-nav-link :href="route('itee.exam.category.index')" :active="request()->routeIs('itee.exam.category.*')">
                {{ __('Exam Category') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Exam Type', 'Super Admin'))
            <x-nav-link :href="route('itee.exam.type.index')" :active="request()->routeIs('itee.exam.type.*')">
                {{ __('Exam Type') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE ExamFee', 'Super Admin'))
            <x-nav-link :href="route('itee.exam-fee.index')" :active="request()->routeIs('itee.exam-fee.*')">
                {{ __('Exam Fee') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Syllabus', 'Super Admin'))
            <x-nav-link :href="route('itee.syllabus.index')" :active="request()->routeIs('itee.syllabus.*')">
                {{ __('Syllabus') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Course Outline', 'Super Admin'))
            <x-nav-link :href="route('itee.course.outline.index')" :active="request()->routeIs('itee.course.outline.*')">
                {{ __('Course Outline') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Books', 'Super Admin'))
            <x-nav-link :href="route('itee.books.index')" :active="request()->routeIs('itee.books.*')">
                {{ __('Books') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Admit Card', 'Super Admin'))
            <x-nav-link :href="route('itee.admit-card.index')" :active="request()->routeIs('itee.admit-card.*')">
                {{ __('Admit Card Data') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of ITEE Results', 'Super Admin'))
            <x-nav-link :href="route('itee.results.index')" :active="request()->routeIs('itee.results.*')">
                {{ __('Results') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of Bjet Events', 'Super Admin'))
            <x-nav-link :href="route('itee.bjet.index')" :active="request()->routeIs('itee.bjet.*')">
                {{ __('BJET Events') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of ITEE Programs', 'Super Admin'))
            <x-nav-link :href="route('itee.programs.index')" :active="request()->routeIs('itee.programs.*')">
                {{ __('ITEE Programs') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of Recent Events', 'Super Admin'))
            <x-nav-link :href="route('itee.recent-events.index')" :active="request()->routeIs('itee.recent-events.*')">
                {{ __('Recent Events') }}
            </x-nav-link>
        @endif
    </x-nav-group>
    {{-- /Group - ITEE --}}

    {{-- Group - VLM --}}
    <x-nav-group title="Vehicle Management">
        @if (Helper::canView('List Of VM Trip', 'Super Admin'))
            <x-nav-link :href="route('vm.cars.trip.index')" :active="request()->is('vm/cars/trip/*')">
                {{ __('Trip Information') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of VM Car Information', 'Super Admin'))
            <x-nav-link :href="route('vm.cars.index')" :active="request()->is('vm/cars/info/*')">
                {{ __('Car Information') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of Vehicle Management User', 'Super Admin'))
            <x-nav-link :href="route('vm.user.index')" :active="request()->routeIs('vm.user.*')">
                {{ __('User') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('View Staff Hierarchy', 'Super Admin'))
            <x-nav-link :href="route('vm.staff-hierarchy.index')" :active="request()->routeIs('vm.staff-hierarchy.*')">
                {{ __('Staff Hierarchy') }}
            </x-nav-link>
        @endif

        @if (Helper::canView('List Of VM User Car Assign', 'Super Admin'))
            <x-nav-link :href="route('vm.cars.assign.index')" :active="request()->is('vm/cars/assign/*')">
                {{ __('Car Assign') }}
            </x-nav-link>
        @endif
    </x-nav-group>
    {{-- /Group - VLM --}}


    {{-- Group - BKIICT --}}
    <x-nav-group title="BKIICT">
        @if (Helper::canView('List Of BKIICT Course', 'Super Admin'))
            <x-nav-link :href="route('bkiict.course.index')" :active="request()->routeIs('bkiict.course.*')">
                {{ __('Course') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of BKIICT Center', 'Super Admin'))
            <x-nav-link :href="route('bkiict.center.index')" :active="request()->routeIs('bkiict.center.*')">
                {{ __('Center') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of BKIICT Teacher', 'Super Admin'))
            <x-nav-link :href="route('bkiict.teacher.index')" :active="request()->routeIs('bkiict.teacher.*')">
                {{ __('Teacher') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of BKIICT Batch', 'Super Admin'))
            <x-nav-link :href="route('bkiict.batch.index')" :active="request()->routeIs('bkiict.batch.*')">
                {{ __('Batch') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of BKIICT Course PDF', 'Super Admin'))
            <x-nav-link :href="route('bkiict.course_pdf.index')" :active="request()->routeIs('bkiict.course_pdf.*')">
                {{ __('Course PDF') }}
            </x-nav-link>
        @endif
        @if (Helper::canView('List Of BKIICT User', 'Super Admin'))
            <x-nav-link :href="route('bkiict.user.index')" :active="request()->routeIs('bkiict.user.*')">
                {{ __('User') }}
            </x-nav-link>
        @endif
    </x-nav-group>
    {{-- /Group - BKIICT --}}








    {{-- ------------------- Bottom ------------------- --}}

    {{-- Group - Global --}}
    <x-nav-group title="Global">
        @if (Helper::canView('Manage Regions', 'Super Admin'))
            <div class="nav-dropdown-container flex flex-col gap-1 w-full">
                <div data-active="{{ request()->routeIs('regions.*') ? 'true' : 'false' }}" class="nav-dropdown transition-colors flex justify-between items-center p-2 px-3 rounded text-sm cursor-pointer">
                    <div>Regions</div>

                    <div class="transition-transform duration-500">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-1">
                    <div class="h-[calc(100%-20px)] bg-slate-300 w-1 rounded-xl"></div>
                    <ul class="ml-2 hidden grow">
                        <li class="my-1">
                            <x-nav-link :href="route('regions.division.index')" :active="request()->routeIs('regions.division.*')">
                                {{ __('Division') }}
                            </x-nav-link>
                        </li>
                        <li class="my-1">
                            <x-nav-link :href="route('regions.district.index')" :active="request()->routeIs('regions.district.*')">
                                {{ __('District') }}
                            </x-nav-link>
                        </li>
                        <li class="my-1">
                            <x-nav-link :href="route('regions.upazila.index')" :active="request()->routeIs('regions.upazila.*')">
                                {{ __('Upazila') }}
                            </x-nav-link>
                        </li>
                        <li class="my-1">
                            <x-nav-link :href="route('regions.union.index')" :active="request()->routeIs('regions.union.*')">
                                {{ __('Union') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </div>
            </div>
        @endif


        @if (Helper::canView('List Of Role|Manage Permission', 'Super Admin'))
            <div class="nav-dropdown-container flex flex-col gap-1 w-full">
                <div data-active="{{ request()->routeIs('role.*') || request()->routeIs('permission.*') ? 'true' : 'false' }}" class="nav-dropdown transition-colors flex justify-between items-center p-2 px-3 rounded text-sm cursor-pointer">
                    <div>Role &amp; Permissions</div>

                    <div class="transition-transform duration-500">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="flex justify-center items-center gap-1">
                    <div class="h-[calc(100%-20px)] bg-slate-300 w-1 rounded-xl"></div>
                    <ul class="ml-2 hidden grow">
                        <li class="my-1">
                            <x-nav-link :href="route('role.index')" :active="request()->routeIs('role.*')">
                                {{ __('Role') }}
                            </x-nav-link>
                        </li>
                        <li class="my-1">
                            <x-nav-link :href="route('permission.manage')" :active="request()->routeIs('permission.*')">
                                {{ __('Permission') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </div>
            </div>
        @endif


        @if (Helper::canView('List Of User', 'Super Admin'))
            <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                {{ __('Users') }}
            </x-nav-link>
        @endif
    </x-nav-group>
    {{-- /Group - Global --}}
</div>
