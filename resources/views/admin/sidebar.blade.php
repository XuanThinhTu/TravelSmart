<div class="sidebar-wrapper">
    <div id="sidebarEffect"></div>
    <div>
        <div class="logo-wrapper logo-wrapper-center">
            <a href="{{ url('/') }}" title="">
                <img class="img-fluid for-white" src="{{ asset('Admin_template/images/logo/full-white.png') }}" alt="logo">
            </a>
            <div class="back-btn">
                <i class="fa fa-angle-left"></i>
            </div>
            <div class="toggle-sidebar">
                <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ url('/') }}">
                <img class="img-fluid main-logo main-white" src="{{ asset('Admin_template/images/logo/logo.png') }}" alt="logo">
                <img class="img-fluid main-logo main-dark" src="{{ asset('Admin_template/images/logo/logo-white.png') }}" alt="logo">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>

            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"></li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('/') }}">
                            <i class="ri-home-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-user-3-line"></i>
                            <span>Users</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('/view_user') }}">All Users</a>
                            </li>
                            <li>
                                <a href="{{ url('/add_user') }}">Add New User</a>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-store-3-line"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('admin/customer') }}">Products</a>
                            </li>
                            <li>
                                <a href="{{ url('add-new-product.html') }}">Add New Products</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-check-2"></i>
                            <span>Category</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('category.html') }}">Category List</a>
                            </li>
                            <li>
                                <a href="{{ url('add-new-category.html') }}">Add New Category</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-list-settings-line"></i>
                            <span>Attributes</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('attributes.html') }}">Attributes</a>
                            </li>
                            <li>
                                <a href="{{ url('add-new-attributes.html') }}">Add Attributes</a>
                            </li>
                        </ul>
                    </li>

                

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-user-3-line"></i>
                            <span>Roles</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('role.html') }}">All Roles</a>
                            </li>
                            <li>
                                <a href="{{ url('create-role.html') }}">Create Role</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('media.html') }}">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Media</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-archive-line"></i>
                            <span>Orders</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('order-list.html') }}">Order List</a>
                            </li>
                            <li>
                                <a href="{{ url('order-detail.html') }}">Order Detail</a>
                            </li>
                            <li>
                                <a href="{{ url('order-tracking.html') }}">Order Tracking</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-focus-3-line"></i>
                            <span>Localization</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('translation.html') }}">Translation</a>
                            </li>
                            <li>
                                <a href="{{ url('currency-rates.html') }}">Currency Rates</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Coupons</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('coupon-list.html') }}">Coupon List</a>
                            </li>
                            <li>
                                <a href="{{ url('create-coupon.html') }}">Create Coupon</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('taxes.html') }}">
                            <i class="ri-price-tag-3-line"></i>
                            <span>Tax</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('product-review.html') }}">
                            <i class="ri-star-line"></i>
                            <span>Product Review</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('support-ticket.html') }}">
                            <i class="ri-phone-line"></i>
                            <span>Support Ticket</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="linear-icon-link sidebar-link sidebar-title" href="javascript:void(0)">
                            <i class="ri-settings-line"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('profile-setting.html') }}">Profile Setting</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('reports.html') }}">
                            <i class="ri-file-chart-line"></i>
                            <span>Reports</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{ url('list-page.html') }}">
                            <i class="ri-list-check"></i>
                            <span>List Page</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
            </div>
        </nav>
    </div>
</div>
