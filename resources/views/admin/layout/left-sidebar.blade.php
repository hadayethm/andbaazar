<div class="page-sidebar">
            <div class="main-header-left d-none d-lg-block">
                <div class="logo-wrapper"><a href="index.html"><img class="blur-up lazyloaded" src="{{asset('frontend')}}/assets/images/icon/logo.png" alt=""></a></div>
            </div>
            <div class="sidebar custom-scrollbar">
                <div class="sidebar-user text-center">
                    <div><img class="img-60 rounded-circle lazyloaded blur-up" src="{{asset('frontend')}}/assets/images/dashboard/user1.jpg" alt="#">
                    </div>
                    <h6 class="mt-3 f-14">JOHN</h6>
                    <p>general manager.</p>
                </div>




                <ul class="sidebar-menu">
                    <li><a class="sidebar-header" href="{{ url('andbaazaradmin/dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>

                    <li class="{{ request()->is('andbaazaradmin/products/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="briefcase"></i> <span>Products</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/products/category*') ? 'active' : '' }}">
                                <a href="#" ><i class="fa fa-cubes"></i> <span>Categories</span> <i class="fa fa-angle-right pull-right"></i></a>
                                <ul class="sidebar-submenu">
                                    <li class="{{ request()->is('andbaazaradmin/products/category') ? 'class:active' : '' }}"><a href="{{ url('andbaazaradmin/products/category') }}" class="{{ request()->is('andbaazaradmin/products/category') ? 'active' : '' }}" ><i class="fa fa-server"></i> Category</a></li>
                                    <li class="{{ request()->is('andbaazaradmin/products/category/*') ? 'class:active' : '' }}"><a href="{{ url('andbaazaradmin/products/category-tree-view') }}" class="{{ request()->is('andbaazaradmin/products/category-tree-view') ? 'active' : '' }}"><i class="fa fa-sliders"></i> Sub Category</a></li>
                                </ul>
                            </li>

                            <li class="{{ request()->is('andbaazaradmin/products/tag/*') ? 'class:active' : '' }}"><a href="{{url('andbaazaradmin/products/tag')}}" class="{{ request()->is('andbaazaradmin/products/tag') ? 'active' : '' }}"><i class="fa fa-tags"></i> Tags</a></li>

                            <li class="{{ request()->is('andbaazaradmin/products/color/*') ? 'class:active' : '' }}"><a href="{{url('andbaazaradmin/products/color')}}" class="{{ request()->is('andbaazaradmin/products/color') ? 'active' : '' }}"><i class="fa fa-puzzle-piece"></i> Color</a></li>

                            <li class="{{ request()->is('andbaazaradmin/products/size/*') ? 'class:active' : '' }}"><a href="{{url('andbaazaradmin/products/size')}}" class="{{ request()->is('andbaazaradmin/products/size') ? 'active' : '' }}"><i class="fa fa-pencil-square-o"></i> Size</a></li>

                            <li class="{{ request()->is('andbaazaradmin/products/brand/*') ? 'class:active' : '' }}"><a href="{{url('andbaazaradmin/products/brand')}}" class="{{ request()->is('andbaazaradmin/products/brand') ? 'active' : '' }}"><i class="fa fa-pencil-square-o"></i> Brand</a></li>

                            <li class="{{ request()->is('andbaazaradmin/product_list*') ? 'active' : '' }}">
                                <a  href="#"><i data-feather="menu" ></i><span>Product Request</span><i class="fa fa-angle-right pull-right"></i></a>
                                <ul class="sidebar-submenu">
                                    <li class="{{ request()->is('andbaazaradmin/product_list') ? 'class:active' : '' }}"><a href="{{ url('andbaazaradmin/product_list')}}" class="{{ request()->is('andbaazaradmin/product_list') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Products list</a></li>
                                    <li class="{{ request()->is('andbaazaradmin/Productlist') ? 'class:active' : '' }}"><a href="{{ url('andbaazaradmin/Productlist')}}" class="{{ request()->is('andbaazaradmin/Productlist') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Products list</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    {{-- <li class="{{ request()->is('andbaazaradmin/products/shop/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="shopping-bag"></i><span>Shops</span><i class="fa fa-angle-right pull-right"></i></a>

                        <ul class="sidebar-submenu">
                            <li><a href="<a href="{{ 'andbaazaradmin/shop' }}"><i class="fa fa-pencil-square-o"></i> All Shop</a></li>
                            <li><a href="<a href="{{ 'andbaazaradmin/shop/create' }}"><i class="fa fa-pencil-square-o"></i> Create Shop</a></li>
                        </ul>

                   </li> --}}

                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/paymentmethod') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/paymentmethod') }}" class="{{ request()->is('andbaazaradmin/paymentmethod') ? 'class:active' : '' }}"><i data-feather="credit-card"></i><span>Payment Method</span></a> </li>

                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/shippingmethod') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/shippingmethod') }}" class="{{ request()->is('andbaazaradmin/shippingmethod') ? 'class:active' : '' }}"><i data-feather="truck"></i><span>Shipping Method</span></a> </li>

                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/promotion') ? 'active' : '' }}"  href="{{ url('andbaazaradmin/promotion') }}"><i data-feather="align-left"></i><span>Promotion</span></a> </li>

                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/promotionplan') ? 'active' : '' }}" href="{{ url('andbaazaradmin/promotionplan') }}" ><i data-feather="archive"></i><span>Promotion Plan</span></a> </li>

                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/promotionhead') ? 'active' : '' }}" href="{{ url('andbaazaradmin/promotionhead') }}" ><i data-feather="droplet"></i><span>Promotion Head</span></a> </li>

                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/currency') ? 'active' : '' }}" href="{{ url('andbaazaradmin/currency') }}" ><i data-feather="dollar-sign"></i><span>Currency</span></a> </li>

                   <li><a class="sidebar-header {{ request()->is('andbaazaradmin/courier') ? 'active' : '' }}" href="{{ url('andbaazaradmin/courier') }}" ><i data-feather="send"></i><span>Courier</span></a> </li>


                   <li class="{{ request()->is('andbaazaradmin/merchant/*') ? 'active' : '' }}"><a href="#" class="sidebar-header" ><i class="fa fa-facebook"></i> <span>Vendor Profile</span> <i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/merchant') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/merchant/') }}" class="{{ request()->is('andbaazaradmin/seller') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Profile list</a></li>

                        </ul>
                    </li>


{{--                    <li class="{{ request()->is('andbaazaradmin/product_list/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="menu" ></i><span>Product Request</span><i class="fa fa-angle-right pull-right"></i></a>--}}
{{--                        <ul class="sidebar-submenu">--}}
{{--                            <li class="{{ request()->is('andbaazaradmin/product_list') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/product_list')}}" class="{{ request()->is('andbaazaradmin/product_list') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Products list</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}

                    <li class="{{ request()->is('andbaazaradmin/shop/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="menu" ></i><span>Shop</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/shop') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/shop')}}" class="{{ request()->is('andbaazaradmin/shop') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Shop list</a></li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('andbaazaradmin/contact-us/*') ? 'active' : '' }}"><a class="sidebar-header" href="#"><i data-feather="menu" ></i><span>Contact us Message</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li class="{{ request()->is('andbaazaradmin/contact-us') ? 'active' : '' }}"><a href="{{ url('andbaazaradmin/contact-us')}}" class="{{ request()->is('andbaazaradmin/contact-us') ? 'active' : '' }}" ><i class="fa fa-pencil-square-o"></i> Message List</a></li>
                        </ul>
                    </li>


                     {{-- <li><a class="sidebar-header" href="invoice.html"><i data-feather="archive"></i><span>Invoice</span></a>
                    </li>
                    <li><a class="sidebar-header" href="login.html"><i data-feather="log-in"></i><span>Login</span></a>
                    </li> --}}

                </ul>
            </div>
        </div>
