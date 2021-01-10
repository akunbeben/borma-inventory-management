<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('administrator.dashboard') }}">{{ $title ?? config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('administrator.dashboard') }}">B&mdash;T</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">{{ __('Home') }}</li>
      <li class="{{ request()->routeIs('administrator.dashboard') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.dashboard') }}" data-toggle="tooltip" data-placement="right"
            data-original-title="{{ __('Dashboard') }}">
            <i class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span>
        </a>
      </li>
      <li class="menu-header">{{ __('Users Management') }}</li>
      <li class="{{ request()->routeIs('administrator.sign-in') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.sign-in') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Users') }}">
          <i class="fab fa-ethereum"></i><span>{{ __('Users') }}</span>
        </a>
      </li>
    </ul>
  </aside>
</div>