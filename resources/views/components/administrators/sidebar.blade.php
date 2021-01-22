<div class="main-sidebar sidebar-style-1">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a class="text-light" href="{{ route('administrator.dashboard') }}">{{ $title ?? config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a class="text-light" href="{{ route('administrator.dashboard') }}">B&mdash;T</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">{{ __('Home') }}</li>
      <li class="{{ request()->routeIs('administrator.dashboard') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.dashboard') }}" data-toggle="tooltip" data-placement="right"
            data-original-title="{{ __('Dashboard') }}">
            <i class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span>
        </a>
      </li>
      <li class="menu-header">{{ __('Master Data') }}</li>
      <li class="{{ request()->is('administrator/users*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.users.list') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('User') }}">
          <i class="fas fa-users"></i><span>{{ __('User') }}</span>
        </a>
      </li>
      <li class="{{ request()->is('administrator/suppliers*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.suppliers.list') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Supplier') }}">
          <i class="fas fa-truck"></i><span>{{ __('Supplier') }}</span>
        </a>
      </li>
      <li class="dropdown {{ request()->is('administrator/products*') == true ? 'active' : null }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-boxes"></i> <span>{{ __('Barang') }}</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->is('administrator/products/food*') == true ? 'active' : null }}"><a class="nav-link" href="{{ route('administrator.products.food.list') }}">Food</a></li>
          <li class="{{ request()->is('administrator/products/non-food*') == true ? 'active' : null }}"><a class="nav-link" href="{{ route('administrator.products.non-food.list') }}">Non-Food</a></li>
        </ul>
      </li>
      <li class="menu-header">{{ __('Management Barang') }}</li>
      <li class="{{ request()->is('administrator/inventory/actual-stock*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.inventory.actual-stock') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Stock Barang') }}">
          <i class="fas fa-box"></i><span>{{ __('Stock Barang') }}</span>
        </a>
      </li>
      <li class="{{ request()->is('administrator/inventory/stock-in*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.inventory.stock-in') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Barang Masuk') }}">
          <i class="fas fa-pallet"></i><span>{{ __('Barang Masuk') }}</span>
        </a>
      </li>
      <li class="{{ request()->is('administrator/inventory/stock-out*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.inventory.stock-out') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Barang Keluar') }}">
          <i class="fas fa-truck-loading"></i><span>{{ __('Barang Keluar') }}</span>
        </a>
      </li>
      <li class="menu-header">{{ __('Lainnya') }}</li>
      <li class="{{ request()->is('administrator/promotions*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.promotions.list') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Promo') }}">
          <i class="fas fa-ad"></i><span>{{ __('Promo') }}</span>
        </a>
      </li>
      <li class="menu-header">{{ __('Laporan') }}</li>
      <li class="{{ request()->is('administrator/reports*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('administrator.suppliers.list') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Reports') }}">
          <i class="fas fa-atlas"></i><span>{{ __('Reports') }}</span>
        </a>
      </li>
    </ul>
  </aside>
</div>