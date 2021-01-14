<div class="main-sidebar sidebar-style-2">
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
      <li class="{{ request()->is('administrator/users*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.users.list') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Users') }}">
          <i class="fas fa-users"></i><span>{{ __('Users') }}</span>
        </a>
      </li>
      <li class="menu-header">{{ __('Master Data') }}</li>
      <li class="{{ request()->is('administrator/suppliers*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.suppliers.list') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Suppliers') }}">
          <i class="fas fa-truck"></i><span>{{ __('Suppliers') }}</span>
        </a>
      </li>
      <li class="dropdown {{ request()->is('administrator/products*') == true ? 'active' : null }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-boxes"></i> <span>{{ __('Products') }}</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->is('administrator/products/food*') == true ? 'active' : null }}"><a class="nav-link" href="{{ route('administrator.products.food.list') }}">Food</a></li>
          <li class="{{ request()->is('administrator/products/non-food*') == true ? 'active' : null }}"><a class="nav-link" href="{{ route('administrator.products.non-food.list') }}">Non-Food</a></li>
        </ul>
      </li>
    </ul>
  </aside>
</div>