<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
  <!-- Primary Navigation Menu -->
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 justify-between">
      <div class="flex">
        <!-- Logo -->
        <div class="flex shrink-0 items-center">
          <a href="{{ route('post.index') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
          </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
          <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
            {{ __('navigation.home') }}
          </x-nav-link>
          @auth()
            <x-nav-link :href="route('my-posts')" :active="request()->routeIs('my-posts')">
                  {{ __('navigation.my-posts') }}
            </x-nav-link>
            <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
              {{ __('navigation.create-post') }}
            </x-nav-link>
            @if (Auth::user()->is_admin == true)
              <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') ||
                  request()->routeIs('admin.category') ||
                  request()->routeIs('admin.gender') ||
                  request()->routeIs('admin.posts')">
                {{ __('navigation.dashboard') }}
              </x-nav-link>
            @endif
            <x-nav-link :href="route('chatify')" :active="request()->routeIs('chatify')">
              {{ __('navigation.chat') }}
            </x-nav-link>
          @endauth
        </div>
      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:ml-1 sm:items-center md:flex">
        <!-- Darkmode Toogler -->
        <label class="switch">
          <span class="sun"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g fill="#ffd43b">
                <circle r="5" cy="12" cx="12"></circle>
                <path
                  d="m21 13h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm-17 0h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm13.66-5.66a1 1 0 0 1 -.66-.29 1 1 0 0 1 0-1.41l.71-.71a1 1 0 1 1 1.41 1.41l-.71.71a1 1 0 0 1 -.75.29zm-12.02 12.02a1 1 0 0 1 -.71-.29 1 1 0 0 1 0-1.41l.71-.66a1 1 0 0 1 1.41 1.41l-.71.71a1 1 0 0 1 -.7.24zm6.36-14.36a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm0 17a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm-5.66-14.66a1 1 0 0 1 -.7-.29l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.29zm12.02 12.02a1 1 0 0 1 -.7-.29l-.66-.71a1 1 0 0 1 1.36-1.36l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.24z">
                </path>
              </g>
            </svg></span>
          <span class="moon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
              <path
                d="m223.5 32c-123.5 0-223.5 100.3-223.5 224s100 224 223.5 224c60.6 0 115.5-24.2 155.8-63.4 5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6-96.9 0-175.5-78.8-175.5-176 0-65.8 36-123.1 89.3-153.3 6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z">
              </path>
            </svg></span>
          <input aria-label="darkmodetoogler" type="checkbox" class="input">
          <span class="slider"></span>
        </label>

        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button
              class="inline-flex items-center rounded-md border border-transparent px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:text-gray-300">
              @auth
                <div class="flex flex-col items-center">
                  <img src="{{ asset('storage/users-avatar/' . Auth::user()->avatar) }}" alt="profile_photo"
                    class="h-6 w-6 rounded-full object-cover">
                  <div>
                    {{ strlen(Auth::user()->name) > 20 ? trim(substr(Auth::user()->name, 0, 20)) . '..' : Auth::user()->name }}
                  </div>
                </div>
              @else
                <div>
                  {{ __('Menu') }}
                </div>
              @endauth

              <div class="ml-1">
                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            @guest
              <x-dropdown-link :href="route('login')">
                {{ __('navigation.login') }}
              </x-dropdown-link>
              <x-dropdown-link :href="route('register')">
                {{ __('navigation.register') }}
              </x-dropdown-link>
            @endguest

            @auth
              <x-dropdown-link :href="route('profile.index', Auth::user()->id)">
                {{ __('navigation.profile') }}
              </x-dropdown-link>

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                  onclick="event.preventDefault();
                                                this.closest('form').submit();">
                  {{ __('navigation.logout') }}
                </x-dropdown-link>
              </form>
            @endauth

            <!-- Language Switcher -->
            <hr>
            <div class="w-full text-center text-gray-400 dark:text-gray-200 text-sm my-2">{{ __("navigation.language") }}</div>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <x-dropdown-link rel="alternate" hreflang="{{ $localeCode }}"
              href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
              {{ $properties['native'] }}
            </x-dropdown-link>
            @endforeach
          </x-slot>
        </x-dropdown>
      </div>

      <!-- Hamburger -->
      <div class="-mr-2 flex items-center md:hidden">
        <button @click="open = ! open"
          class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Responsive Navigation Menu -->
  <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
    <div class="space-y-1 pt-2 pb-3">
      <x-responsive-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
        {{ __('navigation.home') }}
      </x-responsive-nav-link>
      @auth()
        <x-responsive-nav-link :href="route('my-posts')" :active="request()->routeIs('my-posts')">
            {{ __('navigation.my-posts') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
          {{ __('navigation.create-post') }}
        </x-responsive-nav-link>
        @if (Auth::user()->is_admin == true)
          <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') || request()->routeIs('admin.category')">
            {{ __('navigation.dashboard') }}
          </x-responsive-nav-link>
        @endif
        <x-responsive-nav-link :href="route('chatify')" :active="request()->routeIs('chatify')">
          {{ __('navigation.chat') }}
        </x-responsive-nav-link>
      @else
        <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
          {{ __('navigation.login') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
          {{ __('navigation.register') }}
        </x-responsive-nav-link>
      @endauth
    </div>

    <!-- Responsive Settings Options -->
    <div class="border-t border-gray-200 pt-4 pb-1 dark:border-gray-600">
      @auth()
        <div class="px-4">
          <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
          <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
        </div>
      @endauth

      <div class="mt-3 space-y-1">
        @auth
          <x-responsive-nav-link :href="route('profile.index', Auth::user()->id)">
            {{ __('navigation.profile') }}
          </x-responsive-nav-link>

          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
              onclick="event.preventDefault();
                                        this.closest('form').submit();">
              {{ __('navigation.logout') }}
            </x-responsive-nav-link>
          </form>
        @endauth
      </div>
    </div>

    <!-- Switch Language -->
    <div class="border-t border-gray-200 py-4 pb-1 dark:border-gray-600">
      <div class="w-full text-center text-gray-400 dark:text-gray-200 text-sm my-4">{{ __("navigation.language") }}</div>
      <div class="flex justify-around items-center mb-4 dark:text-gray-300">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <a class="" rel="alternate" hreflang="{{ $localeCode }}"
          href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
          {{ $properties['native'] }}
        </a>
        @endforeach
      </div>
    </div>
  </div>
</nav>
