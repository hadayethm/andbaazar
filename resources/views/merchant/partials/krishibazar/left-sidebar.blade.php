<ul class="nav nav-tabs" id="top-tab" role="tablist">
    <li class="nav-item {{$active == 'dashboard' ? 'active' : ''}}"><a  class="nav-link" href="{{ url('merchant/dashboard') }}">
    <img src="{{asset('frontend/assets/images/icons/grid.png')}}" alt="icon">
    dashboard</a></li>

    <li class="nav-item"><a class="nav-link" href="#orders"> <img src="{{asset('frontend/assets/images/icons/bag.png')}}" alt="icon"> Orders</a> </li>

    <li class="nav-item"><a class="nav-link"> <img src="{{asset('frontend/assets/images/icons/box.png')}}" alt="icon">Products</a> </li>

    <li class="nav-item"><a class="nav-link" href="#"> <img src="{{asset('frontend/assets/images/icons/wallet.png')}}" alt="icon">Wallet Service</a> </li>
    <li class="nav-item"><a class="nav-link" href="#"><img src="{{asset('frontend/assets/images/icons/sim.png')}}" alt="icon">Reports</a> </li>
    <li class="nav-item"><a class="nav-link" href="#"><img src="{{asset('frontend/assets/images/icons/box.png')}}" alt="icon"></i>Shipping</a> </li>
    <li class="nav-item"><a class="nav-link" href="#"><img src="{{asset('frontend/assets/images/icons/user.png')}}" alt="icon"></i>Customer</a> </li>
    <li class="nav-item"><a class="nav-link" href="#"> <img src="{{asset('frontend/assets/images/icons/rate.png')}}" alt="icon">Review & Rating</a> </li>
    <li class="nav-item"><a class="nav-link" href="#"> <img src="{{asset('frontend/assets/images/icons/pana.png')}}" alt="icon">Voucher & Coupon</a> </li>
    <li class="nav-item"><a class="nav-link" href="#"> <img src="{{asset('frontend/assets/images/icons/doller.png')}}" alt="icon">Refund request</a> </li>
    <li class="nav-item"><a  class="nav-link" href="#!"><img src="{{asset('frontend/assets/images/icons/list.png')}}" alt="icon"> News Feed</a></li>
    <li class="nav-item"><a  class="nav-link"> <img src="{{asset('frontend/assets/images/icons/box.png')}}" alt="icon">Profile</a></li>

    <li class="nav-item"><a  class="nav-link " 
    href="!#"> <img src="{{asset('frontend/assets/images/icons/box.png')}}" alt="icon">shop</a></li>

    

    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#settings"> <img src="{{asset('frontend/assets/images/icons/setting.png')}}" alt="icon">settings</a></li>
    <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#settings"> <img src="{{asset('frontend/assets/images/icons/what.png')}}" alt="icon">Technical support</a></li>

    <li class="nav-item"><a class="nav-link" href="{{ url('logout') }}"> <img src="{{asset('frontend/assets/images/icons/arrow.png')}}" alt="icon">logout</a> </li>
</ul>
