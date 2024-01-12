<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->


        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title" >HR Management</li>


                @can('employee.view')
                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i class="fas fa-user-tie	"></i>
                        <span> Manage Employee </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('view.employee') }}">All Employees</a>
                            </li>
                        @can('employee.add')
                            <li>
                                <a href="{{ route('employee.add') }}">Add Employee</a>
                            </li>
                        @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                
                {{-- @if(auth()->user()->can('pos.view')) --}}
                @can('customer.view')

                <li>
                    <a href="#sidebarEcommerce2" data-bs-toggle="collapse">
                        <i class="bi bi-people "></i>
                        <span> Manage Customers </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce2">
                        <ul class="nav-second-level">
                            @can('customer.view')
                            <li>
                                <a href="{{ route('view.customer') }}">All Customers</a>
                            </li>
                            @endcan
                            @can('customer.add')
                            <li>
                                <a href="{{ route('customer_add_form') }}">Add Customers</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>

                @endcan

                {{-- @endif --}}
                @can('supplier.view')
                <li>
                    <a href="#sidebarEcommerce3" data-bs-toggle="collapse">
                        <i class="fas fa-dolly-flatbed"></i>
                        <span> Manage Suppliers </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce3">
                        <ul class="nav-second-level">
                            @can('supplier.view')
                            <li>
                                <a href="{{ route('view.suppliers') }}">All Suppliers</a>
                            </li>
                            @endcan

                            @can('supplier.add')
                            <li>
                                <a href="{{ route('supplier_add_form') }}">Add Suppliers</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan


                @can('salary.view')
                <li>
                    <a href="#sidebarEcommerce4" data-bs-toggle="collapse">
                        <i class="fa fa-money	
                        "></i>
                        <span> Employee Salary </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce4">
                        <ul class="nav-second-level">
                            @can('salary.view')
                            <li>
                                <a href="{{ route('all.advance.salary') }}">All Advances</a>
                            </li>
                            @endcan
                            @can('salary.add')
                            <li>
                                <a href="{{ route('add.advance.salary') }}">Add Advance Salary</a>
                            </li>
                            @endcan

                            @can('salary.add')
                            
                            <li>
                                <a href="{{route('PaySalary')}}">Pay Salary</a>
                            </li>
                            @endcan

                            @can('salary.view')
                            <li>
                                <a href="{{ route('PaidSalaries') }}">Piad Salaries</a>
                            </li>
                            @endcan

                        </ul>
                    </div>
                </li>
                @endcan


                @can('attendance.view')
                    <li>
                    <a href="#sidebarEcommerce5" data-bs-toggle="collapse">
                        <i class="fa fa-calendar"></i>
                        <span> Employee Attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce5">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employee.attendance.list') }}">Attendance List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                
                @can('category.view')
                
                <li class="menu-title" >Product Management</li>

                <li>
                    <a href="#sidebarEcommerce7" data-bs-toggle="collapse">
                        <i class="fa fa-tag"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce7">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('category.list')}}">Category List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                @endcan

                @can('product.view')

                <li>
                    <a href="#sidebarEcommerce8" data-bs-toggle="collapse">
                        <i class="fas fa-box-open"></i>
                        <span> Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce8">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('product.list')}}">Product List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan


                @can('stock.view')

                <li class="menu-title" >Product Purchases</li>

                <li>
                    <a href="#sidebarEcommerce9" data-bs-toggle="collapse">
                        <i class="fa fa-shopping-cart"></i>
                        <span> Purchase </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce9">
                        <ul class="nav-second-level">
                    @can('stock.add')

                            <li>
                                <a href="{{route('pruchase.form')}}">Add Purchase</a>
                            </li>
                    @endcan
                            
                            <li>
                                <a href="{{route('view.purchase')}}">Purchase List</a>
                            </li>
                        </ul>
                    </div>
                </li>

                @endcan


                @can('expences.view')

                <li class="menu-title" >Expenses</li>

                <li>
                    <a href="#sidebarEcommerce10" data-bs-toggle="collapse">
                        <i class="fa fa-dollar"></i>
                        <span> Expenses </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce10">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('expense.list')}}">View Expense</a>
                            </li>
                        </ul>
                    </div>
                </li>

                @endcan

                @can('stock.view')
                <li>
                    <a href="{{route('sale.view')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> POS </span>
                    </a>
                </li>
                @endcan


                @can('roles.view')


                <li class="menu-title" > Accounts Managemnt</li>


                <li>
                    <a href="#sidebarEcommerce11" data-bs-toggle="collapse">
                        <i class="fas fa-key"></i>
                        <span> Roles and Permission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce11">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('all.permissions')}}">Permissions</a>
                            </li>

                            <li>
                                <a href="{{route('all.roles')}}">All Roles</a>
                            </li>

                            <li>
                                <a href="{{route('assing.permission')}}">Assing permissions</a>
                            </li>

                        </ul>
                    </div>
                </li>


                
                <li>
                    <a href="#sidebarEcommerce12" data-bs-toggle="collapse">
                        <i class="fas fa-user-alt"></i>
                        <span> Users Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce12">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('users.list')}}">Users</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->



    
</div>
