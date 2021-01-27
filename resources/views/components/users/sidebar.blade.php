<div class="main-sidebar sidebar-style-1">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a class="text-light" href="{{ route('users.dashboard') }}">{{ $title ?? config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a class="text-light" href="{{ route('users.dashboard') }}">B&mdash;T</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">{{ __('Home') }}</li>
      <li class="{{ request()->routeIs('users.dashboard') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('users.dashboard') }}" data-toggle="tooltip" data-placement="right"
            data-original-title="{{ __('Dashboard') }}">
            <i class="fas fa-fire"></i><span>{{ __('Dashboard') }}</span>
        </a>
      </li>
      <li class="menu-header">{{ __('Master Data') }}</li>
      <li class="dropdown {{ request()->is('users/products*') == true ? 'active' : null }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-boxes"></i> <span>{{ __('Barang') }}</span></a>
        <ul class="dropdown-menu">
          <li class="{{ request()->is('users/products/food*') == true ? 'active' : null }}"><a class="nav-link" href="{{ route('users.products.food.list') }}">Food</a></li>
          <li class="{{ request()->is('users/products/non-food*') == true ? 'active' : null }}"><a class="nav-link" href="{{ route('users.products.non-food.list') }}">Non-Food</a></li>
        </ul>
      </li>
      <li class="{{ request()->is('users/suppliers*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('users.suppliers.list') }}" data-toggle="tooltip" data-placement="right"
            data-original-title="{{ __('Supplier') }}">
            <i class="fas fa-truck"></i><span>{{ __('Supplier') }}</span>
        </a>
      </li>
      <li class="menu-header">{{ __('Management Barang') }}</li>
      <li class="{{ request()->routeIs('users.inventories.actual-stock') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('users.inventories.actual-stock') }}" data-toggle="tooltip" data-placement="right"
            data-original-title="{{ __('Inventories') }}">
            <i class="fas fa-box"></i><span>{{ __('Stok Barang') }}</span>
        </a>
      </li>
      <li class="{{ request()->is('users/inventories/stock-in*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('users.inventories.stock-in') }}" data-toggle="tooltip" data-placement="right"
            data-original-title="{{ __('Barang Masuk') }}">
            <i class="fas fa-pallet"></i><span>{{ __('Barang Masuk') }}</span>
        </a>
      </li>
      <li class="{{ request()->is('users/inventories/stock-out*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('users.inventories.stock-out') }}" data-toggle="tooltip" data-placement="right"
            data-original-title="{{ __('Barang Keluar') }}">
            <i class="fas fa-truck-loading"></i><span>{{ __('Barang Keluar') }}</span>
        </a>
      </li>
      <li class="menu-header">{{ __('Lainnya') }}</li>
      <li class="{{ request()->is('users/up-product*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('users.up-product') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Up Produk') }}">
          <i class="fas fa-caret-square-up"></i><span>{{ __('Up Produk') }}</span>
        </a>
      </li>
      <li class="{{ request()->is('users/new-product*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('users.new-product') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Produk Baru') }}">
          <i class="fas fa-box-open"></i><span>{{ __('Produk Baru') }}</span>
        </a>
      </li>
      <li class="{{ request()->is('users/prepare-product*') == true ? 'active' : 'nav-item' }}">
        <a class="nav-link" href="{{ route('users.prepare-product') }}" data-toggle="tooltip" data-placement="right" data-original-title="{{ __('Prepare') }}">
          <i class="fas fa-archive"></i><span>{{ __('Prepare') }}</span>
        </a>
      </li>
    </ul>
  </aside>
</div>