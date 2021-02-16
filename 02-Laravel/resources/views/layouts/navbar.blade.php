<nav class="bg-gray-800">
  <div class="container mx-auto px-2 sm:px-6 lg:px-8">
    <div class="relative flex items-center justify-between h-16" data-controller='navbar'>
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false" data-action='click->navbar#toggle'>
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" data-navbar-target='open'>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" data-navbar-target='close'>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex-1 flex items-center sm:items-stretch sm:justify-start">
        <div class="hidden sm:block w-full" data-navbar-target='mainMenu'>
          <div class="flex justify-between space-x-4">
            <div class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              <a
                href="{{ url('/') }}"
              >
                {{ config('app.name', 'Instaclone') }}
              </a>
            </div>
            <div>
              @auth
              <div class='relative inline-block'>
                <button
                  class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                  data-action="click->navbar#toggleLoginMenu"
                >
                  {{ Auth::user()->nickname }}
                </button>
                <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-40 hidden" data-navbar-target="loginMenu">
                  <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                      {{ __('View my profile') }}
                    </a>
                    <a href="{{ route('editMyProfile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                      {{ __('Edit my profile')}}
                    </a>
                    <form method='POST' action={{ route('logout') }}>
                      @csrf
                      <button type="submit" class="block text-left px-4 py-2 w-full text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">{{ __('Logout') }}</button>
                    </form>
                  </div>
                </div>
              </div>
              @endauth
              
              @guest
              <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="{{ route('login') }}">{{ __('Login') }}</a>
              <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="{{ route('register') }}">{{ __('Register') }}</a>
              @endguest
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>