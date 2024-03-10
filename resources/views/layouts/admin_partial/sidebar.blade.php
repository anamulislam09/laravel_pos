<aside class="main-sidebar sidebar-dark-primary elevation-4 p-0">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('admin//dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        @if (Auth::guard('admin')->user()->role == 0)
            <span class="brand-text font-weight-light">Super Admin</span>
        @else
            <span class="brand-text font-weight-light">Admin dashboard</span>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-3">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin//dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <!-- Category start here -->
        <nav class=" mb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::guard('admin')->user()->role == 0)
                    <li
                        class="nav-item {{ Request::routeIs('customers.all') || Request::routeIs('customers.create') || Request::routeIs('customers.edit') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('customers.all') }}"
                                    class="nav-link {{ Request::routeIs('customers.all') || Request::routeIs('customers.create') || Request::routeIs('customers.edit') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Customers</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- expense category start here --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('category.index') }}"
                            class="nav-link {{ Request::routeIs('category.index') || Request::routeIs('category.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Expense Category</p>
                        </a>
                    </li> --}}
                    {{-- expense category ends here --}}
                @endif

                @if (Auth::guard('admin')->user()->role == 1)

                   {{-- supplier Management Start here --}}
                   <li
                   class="nav-item {{ Request::routeIs('supplier.index') || Request::routeIs('supplier.create') || Request::routeIs('supplier.store') || Request::routeIs('supplier.edit') || Request::routeIs('supplier.update') ? 'menu-open' : '' }}">
                   <a href="#" class="nav-link">
                       <i class="nav-icon fas fa-circle"></i>
                       <p>
                           Suppliers
                           <i class="right fas fa-angle-left"></i>
                       </p>
                   </a>
                   <ul class="nav nav-treeview ml-3">
                       <li class="nav-item">
                           <a href="{{ route('supplier.create') }}"
                               class="nav-link {{ Request::routeIs('supplier.create') ? 'active' : '' }}">
                               <i class="far fa-dot-circle nav-icon"></i>
                               <p>Add New Supplier</p>
                           </a>
                       </li>
                       <li class="nav-item">
                           <a href="{{ route('supplier.index') }}"
                               class="nav-link {{ Request::routeIs('supplier.index') ? 'active' : '' }}">
                               <i class="far fa-dot-circle nav-icon"></i>
                               <p>All Suppliers</p>
                           </a>
                       </li>
                   </ul>
               </li>
               {{-- supplier Management ends here --}}

                    {{-- CAtegory Management ends here --}}
                    <li
                        class="nav-item {{ Request::routeIs('category.index') || Request::routeIs('category.create') || Request::routeIs('category.store') || Request::routeIs('category.edit') || Request::routeIs('category.update') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Product Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('category.create') }}"
                                    class="nav-link {{ Request::routeIs('category.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add New Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}"
                                    class="nav-link {{ Request::routeIs('category.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Categories</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Category Management ends here --}}

                    {{-- Purchase Management Start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('purchase.index') || Request::routeIs('purchase.create') || Request::routeIs('purchase.store') || Request::routeIs('purchase.edit') || Request::routeIs('purchase.update') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Purchases
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('purchase.create') }}"
                                    class="nav-link {{ Request::routeIs('purchase.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add New purchase</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('purchase.index') }}"
                                    class="nav-link {{ Request::routeIs('purchase.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Purchas Products</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Purchase Management ends here --}}


                    {{-- Product Management Start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('product.index') || Request::routeIs('product.create') || Request::routeIs('product.store') || Request::routeIs('product.edit') || Request::routeIs('product.update') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Products
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('product.create') }}"
                                    class="nav-link {{ Request::routeIs('product.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add New Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}"
                                    class="nav-link {{ Request::routeIs('product.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Products</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Product Management ends here --}}

                    {{-- Product Management Start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('product.index') || Request::routeIs('product.create') || Request::routeIs('product.store') || Request::routeIs('product.edit') || Request::routeIs('product.update') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Payments
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('product.create') }}"
                                    class="nav-link {{ Request::routeIs('product.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add New Payment</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}"
                                    class="nav-link {{ Request::routeIs('product.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Payment</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Product Management ends here --}}

                  

                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
