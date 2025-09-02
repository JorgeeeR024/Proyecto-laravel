<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 w-full">
    <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8 w-full">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
            <a href="{{ 
                Auth::user()->role === 'admin' ? route('admin.dashboard') : 
                (Auth::user()->role === 'teacher' ? route('teacher.dashboard') : 
                (Auth::user()->role === 'student' ? route('student.dashboard') : route('dashboard'))) 
            }}">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-24 w-auto">
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden sm:flex sm:space-x-8">
            <x-nav-link :href="Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'teacher' ? route('teacher.dashboard') : route('student.dashboard'))" 
                        :active="request()->routeIs('*dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>

          @if(Auth::user()->role === 'admin')
    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
        {{ __('Gestión de usuarios') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('admin.grades.index')" :active="request()->routeIs('admin.grades.*')">
        {{ __('Gestión de estudiantes') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('admin.student_grades.index')" :active="request()->routeIs('admin.student_grades.*')">
        {{ __('Gestión de notas') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('admin.graficas.index')" :active="request()->routeIs('admin.graficas.*')">
        {{ __('Graficas de InsSchool') }}
    </x-responsive-nav-link>

@elseif(Auth::user()->role === 'teacher')
    <x-responsive-nav-link :href="route('teacher.gestion_grades.index')" :active="request()->routeIs('teacher.gestion_grades.*')">
        {{ __('Gestión de grados') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('teacher.evaluations.index')" :active="request()->routeIs('teacher.evaluations.*')">
        {{ __('Evaluaciones') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('teacher.evaluation_results.index')" :active="request()->routeIs('teacher.evaluation_results.*')">
        {{ __('Resultados de Evaluaciones') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('teacher.student_grades.index')" :active="request()->routeIs('teacher.student_grades.*')">
        {{ __('Gestión de notas') }}
    </x-responsive-nav-link>

@elseif(Auth::user()->role === 'student')
    <x-responsive-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
        {{ __('Mis tareas (provisional)') }}
    </x-responsive-nav-link>
@endif
        </div>

        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden w-full">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::user()->role === 'teacher' ? route('teacher.dashboard') : route('student.dashboard'))" :active="request()->routeIs('*dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
@if(Auth::user()->role === 'admin')
    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
        {{ __('Gestión de usuarios') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('admin.grades.index')" :active="request()->routeIs('admin.grades.*')">
        {{ __('Gestión de estudiantes') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('admin.student_grades.index')" :active="request()->routeIs('admin.student_grades.*')">
        {{ __('Gestión de notas') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('admin.graficas.index')" :active="request()->routeIs('admin.graficas.*')">
        {{ __('Graficas de InsSchool') }}
    </x-responsive-nav-link>

@elseif(Auth::user()->role === 'teacher')
    <x-responsive-nav-link :href="route('teacher.gestion_grades.index')" :active="request()->routeIs('teacher.gestion_grades.*')">
        {{ __('Gestión de grados') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('teacher.evaluations.index')" :active="request()->routeIs('teacher.evaluations.*')">
        {{ __('Evaluaciones') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('teacher.evaluation_results.index')" :active="request()->routeIs('teacher.evaluation_results.*')">
        {{ __('Resultados de Evaluaciones') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('teacher.student_grades.index')" :active="request()->routeIs('teacher.student_grades.*')">
        {{ __('Gestión de notas') }}
    </x-responsive-nav-link>

@elseif(Auth::user()->role === 'student')
    <x-responsive-nav-link :href="route('student.dashboard')" :active="request()->routeIs('student.dashboard')">
        {{ __('Mis tareas (provisional)') }}
    </x-responsive-nav-link>
@endif


        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
