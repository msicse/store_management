<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src=" {{ asset('images/users/' . Auth::user()->image) }}" width="50" height="50" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('settings.profile') }}"><i class="material-icons">person</i>Profile</a></li>
                    <li>
                        <a href="{{ route('settings.password') }}">
                            <i class="material-icons">enhanced_encryption</i>
                            Change Pass
                        </a>
                    </li>


                    <li role="seperator" class="divider"></li>
                    <li><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                class="material-icons">input</i>Sign Out</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->

    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if (Auth::user()->role_id == 1)
                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- <li class="{{ Request::is('admin/roles*') ? 'active' : '' }}">
                <a href="{{ route('admin.roles.index') }}">
                    <i class="material-icons">groups</i>
                    <span>Roles</span>
                </a>
            </li> -->
                <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="material-icons">people</i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/product-types') ? 'active' : '' }}">
                    <a href="{{ route('admin.product-types.index') }}">
                        <i class="material-icons">view_sidebar</i>
                        <span>Product Type</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/products*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        <i class="material-icons">view_module</i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/suppliers*') ? 'active' : '' }}">
                    <a href="{{ route('admin.suppliers.index') }}">
                        <i class="material-icons">nordic_walking</i>
                        <span>Suppliers</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/purchases*') ? 'active' : '' }}">
                    <a href="{{ route('admin.purchases.index') }}">
                        <i class="material-icons">add_shopping_cart</i>
                        <span>Purchases</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/purchased-products*') ? 'active' : '' }}">
                    <a href="{{ route('admin.purchased.products') }}">
                        <i class="material-icons">add_shopping_cart</i>
                        <span>Purchased Products</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/departments*') ? 'active' : '' }}">
                    <a href="{{ route('admin.departments.index') }}">
                        <i class="material-icons">corporate_fare</i>
                        <span>Departments</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/employees*') ? 'active' : '' }}">
                    <a href="{{ route('admin.employees.index') }}">
                        <i class="material-icons">wc</i>
                        <span>Employees</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/inventories*') ? 'active' : '' }}">
                    <a href="{{ route('admin.inventories.index') }}">
                        <i class="material-icons">store_mall_directory</i>
                        <span>Inventories</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/transections*') ? 'active' : '' }}">
                    <a href="{{ route('admin.transections.index') }}">
                        <i class="material-icons">published_with_changes</i>
                        <span>Product Distribution</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/exchange-input*') ? 'active' : '' }}">
                    <a href="{{ route('admin.exchange.show') }}">
                        <i class="material-icons">published_with_changes</i>
                        <span>Exchange Form Print</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/management*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">widgets</i>
                        <span>Management</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('admin/management/employees*') ? 'active' : '' }}">
                            <a href="{{ route('admin.management.employees') }}" class=" waves-effect waves-block">
                                <span>Employees</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/management/products*') ? 'active' : '' }}">
                            <a href="{{ route('admin.management.products') }}" class=" waves-effect waves-block">
                                <span>Products</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="header">Imports</li>
                <li class="{{ Request::is('admin/imports/stocks*') ? 'active' : '' }}">
                    <a href="{{ route('admin.imports.stocks') }}">
                        <i class="material-icons">published_with_changes</i>
                        <span>Employees</span>
                    </a>
                </li>


                <li class="header">Reports</li>

                <li class="{{ Request::is('admin/reports/employees*') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports.index') }}">
                        <i class="material-icons">published_with_changes</i>
                        <span>Employees</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/reports/transections*') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports.transections') }}">
                        <i class="material-icons">published_with_changes</i>
                        <span>Transections</span>
                    </a>
                </li>
                <!-- <li class="menu-toggle waves-effect waves-block toggled">
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="material-icons">widgets</i>
                    <span>Employee</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ route('admin.employees.create') }}" class=" waves-effect waves-block">
                            <span>Add Employee</span>
                        </a>
                        <a href="{{ route('admin.employees.index') }}" class=" waves-effect waves-block">
                            <span>All Employees</span>
                        </a>
                    </li>

                </ul>
            </li> -->
            @endif

            @if (Auth::user()->role_id == 2)
                <li class="{{ request()->is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('author.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/departments*') ? 'active' : '' }}">
                    <a href="{{ route('author.departments.index') }}">
                        <i class="material-icons">corporate_fare</i>
                        <span>Departments</span>
                    </a>
                </li>
                <li class="{{ request()->is('author/employees*') ? 'active' : '' }}">
                    <a href="{{ route('author.employees.index') }}">
                        <i class="material-icons">wc</i>
                        <span>Employees</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/purchases*') ? 'active' : '' }}">
                    <a href="{{ route('author.purchases.index') }}">
                        <i class="material-icons">add_shopping_cart</i>
                        <span>Purchases</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/inventories*') ? 'active' : '' }}">
                    <a href="{{ route('author.inventories.index') }}">
                        <i class="material-icons">store_mall_directory</i>
                        <span>Inventories</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/transections*') ? 'active' : '' }}">
                    <a href="{{ route('author.transections.index') }}">
                        <i class="material-icons">published_with_changes</i>
                        <span>Transections</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/management*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">widgets</i>
                        <span>Management</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('author/management/employees*') ? 'active' : '' }}">
                            <a href="{{ route('author.management.employees') }}" class=" waves-effect waves-block">
                                <span>Employees</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('author/management/products*') ? 'active' : '' }}">
                            <a href="{{ route('author.management.products') }}" class=" waves-effect waves-block">
                                <span>Products</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="header">Reports</li>

                <li class="{{ Request::is('author/reports/employees*') ? 'active' : '' }}">
                    <a href="{{ route('author.reports.index') }}">
                        <i class="material-icons">published_with_changes</i>
                        <span>Employees</span>
                    </a>
                </li>

                <li class="{{ Request::is('author/reports/transections*') ? 'active' : '' }}">
                    <a href="{{ route('author.reports.transections') }}">
                        <i class="material-icons">published_with_changes</i>
                        <span>Transections</span>
                    </a>
                </li>
            @endif

            @auth
                <li class="header">Settings</li>
                <li class="{{ Request::is('settings/profile*') ? 'active' : '' }}">

                    <a href="{{ route('settings.profile') }}">
                        <i class="material-icons">manage_accounts</i>
                        <span>Update Profile</span>
                    </a>
                </li>
                <li class="{{ Request::is('settings/password*') ? 'active' : '' }}">

                    <a href="{{ route('settings.password') }}">
                        <i class="material-icons">enhanced_encryption</i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>
                </li>
            @endauth



        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear());
            </script>
            All rights reserved | by
            <a href="/">RSC</a>
        </div>
        <div class="version">

        </div>
    </div>
    <!-- #Footer -->
</aside>

Copyright ©
