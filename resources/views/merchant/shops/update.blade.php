@extends('merchant.master')

@section('content')
@push('css')
<style>
    .imagestyle{
        width: 300px;
        height: 120px;
        border-width: 1px;
        border-style: solid;
        border-radius:100%;
        border-color: #ccc;
        /* border-bottom: 0px; */
        padding: 0px;
    }
    #file-upload{
        display: block;
    }
    .uploadbtn{
        width: 200px;background: #ddd;float: right;text-align: center;
    }
    .custom-file-upload {
        /* border: 1px solid #ccc; */
        display: inline-block;
        padding: 9px 40px;
        cursor: pointer;
        border-top: 0px;
    }
    #map {
  height: 100%;
}
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
 .btns {
  /* position: absolute; */
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: white;
  color:  #555 ;
  font-size: 16px;
  padding: 5px 8px;
  border: none;
  cursor: pointer;
  border-radius: 15px;
  text-align: center;
}

</style>
@endpush
@include('elements.alert')
{{-- @component('layouts.inc.breadcrumb')
  @slot('pageTitle')
      Vendor Dashboard
  @endslot
  @slot('page')
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
      <li class="breadcrumb-item active" aria-current="page">Shop</li>
  @endslot
@endcomponent --}}


<!--  dashboard section start -->
<section class="dashboard-section section-b-space">
    <div class="container">

        <div class="row">

            @include('layouts.inc.sidebar.vendor-sidebar',[$active='shop'])

            <div class="col-sm-9 register-page contact-page">


            <!-- vendor cover start -->
            <div class="vendor-cover">
                <div>

                    <div class="mt-0">                                           
                        <img  id="outputs" src="{{asset('frontend')}}/assets/images/vendor/profile.jpg" alt="" class="bg-img lazyload blur-up">
                        {{-- <div class="btns">  --}}
                            <label for="file-upload" class="custom-file-upload bg-warning"><i class="fa fa-camera" aria-hidden="true"> Edit Button</i></label>
                            {{-- <button type="button" class="btn btn-warning custom-file-upload"><i class="fa fa-camera " aria-hidden="true"></i> Edit Photo</i> </button>   --}}
                            {{-- <input id="file-upload"  class = "d-none" type="file" name="logo" onchange="loadImage(event)"/>
                            <input type="hidden" value="{{$shopProfile->logo}}" name="old_image">  --}}
                        {{-- </div> --}}                                      
                    </div>  

                    {{-- <button type="button" class="btn btn-warning"><i class="fa fa-camera " aria-hidden="true"></i> Edit Photo</i> </button>  
                    {{-- <label for="file-upload" class="custom-file-upload btns"><i class="fa fa-camera" aria-hidden="true"></i></label> --}}
                    {{-- <input id="file-upload"  class = "d-none" type="file" name="logo" onchange="loadFile(event)"/>                            --}}
                    {{-- <img src="{{asset('frontend')}}/assets/images/vendor/profile.jpg" alt="" class="bg-img lazyload blur-up"> --}}
                </div>
               
            </div>
            <!-- vendor cover end -->


            <!-- section start -->
            <section class="vendor-profile pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="profile-left">
                                <div class="profile-image">
                                    <div>
                                        <div class="mt-0">                                           
                                            @if(!empty($shopProfile->logo))                 
                                             <img id="output"  class="imagestyle" src="{{ asset($shopProfile->logo) }}"/>
                                            @else
                                             <img id="output"  class="imagestyle" src="{{ asset('/uploads/shop_logo/shop-1.png') }}" />
                                            @endif
                                            {{-- <div class="btns">  --}}
                                                <label for="file-upload" class="custom-file-upload btns"><i class="fa fa-camera" aria-hidden="true"></i></label>
                                                <input id="file-upload"  class = "d-none" type="file" name="logo" onchange="loadFile(event)"/>
                                                <input type="hidden" value="{{$shopProfile->logo}}" name="old_image"> 
                                            {{-- </div> --}}                                      
                                        </div>                                                                          
                                        {{-- <h6>750 followers | 10 review</h6> --}}
                                    </div>
                                </div>
                                <div class="profile-detail">
                                    <div contenteditable="true">
                                        {{-- <textarea class="form-control  mb-0 @error('description') border-danger @enderror" placeholder="Write Your Message"  name="description"  id="" rows="6" >{{ $shopProfile->description }}</textarea> --}}
                                        {{ $shopProfile->description }}
                                        {{-- <textarea class="form-control summernote mb-0 @error('description') border-danger @enderror" placeholder="Write Your Message"  name="description"  id="" rows="6" >{{ $shopProfile->description }}</textarea> --}}
                                    </div>
                                </div>
                                <div class="vendor-contact">
                                    <div>
                                        <h6>follow us:</h6>
                                        <div class="footer-social">
                                            <ul>                                                                                              
                                                <li><a href="#" data-toggle="modal" data-target="#facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li> 
                                            </ul>
                                        </div>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moreinfo">
                                            More Information
                                          </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
            </div>
<!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="facebook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Your Facebook Id</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input type="email" class="form-control @error('email') border-danger @enderror" required  name="email" value="{{ old('email',$shopProfile->email) }}" id=""  placeholder="Shop Email">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                    </div>
                </div>
                </div>
            </div>

            <div class="modal fade" id="youtube" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Enter Your You Tube Link </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input type="email" class="form-control @error('email') border-danger @enderror" required  name="email" value="{{ old('email',$shopProfile->email) }}" id=""  placeholder="Shop Email">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                    </div>
                </div>
                </div>
            </div>

            <div class="modal fade" id="twitter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Your Twitter Id</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input type="email" class="form-control @error('email') border-danger @enderror" required  name="email" value="{{ old('email',$shopProfile->email) }}" id=""  placeholder="Shop Email">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                    </div>
                </div>
                </div>
            </div>

            <div class="modal fade" id="instagram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Your instagram Id</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input type="email" class="form-control @error('email') border-danger @enderror" required  name="email" value="{{ old('email',$shopProfile->email) }}" id=""  placeholder="Shop Email">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                    </div>
                </div>
                </div>
            </div>

            <div class="modal fade" id="moreinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter More Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="name">Shop Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('name') }}</span>
                            <input type="text" class="form-control @error('name') border-danger @enderror" required name="name" value="{{ old('name',$shopProfile->name) }}" id="" placeholder="Shop Name">
                        </div>
                        <div>
                            <label for="phone" class="mt-2">Shop Phone<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('phone') }}</span>
                            <input type="text" class="form-control @error('phone') border-danger @enderror" required name="phone" value="{{ old('phone',$shopProfile->phone) }}" id="" placeholder="Shop Phone">
                        </div>
                        <div>
                            <label for="email" class="mt-2">Shop Email<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('email') }}</span>
                           <input type="email" class="form-control @error('email') border-danger @enderror" required  name="email" value="{{ old('email',$shopProfile->email) }}" id=""  placeholder="Shop Email">
                        </div> 
                        <div>
                            <label for="web" class="mt-2">Web<span class="text-danger"> </span></label> <span class="text-danger">{{ $errors->first('web') }}</span>
                            <input type="url" class="form-control @error('web') border-danger @enderror"  name="web" value="{{ old('Web',$shopProfile->web) }}" id="" placeholder="Shop website">
                        </div>
                    </div>
                    <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-danger">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
            <div class= "mt-2 text-right">
                <a href="{{url('merchant/shop')}}" class="btn btn-solid btn-sm">Update Your Shop</a>     
            </div>           
   </section>
            <!-- Section ends -->

    <!-- collection section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 collection-filter">
                    <!-- side-bar colleps block stat -->
                    {{-- <div class="collection-filter-block">
                        <!-- brand filter start -->
                        <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left"
                                    aria-hidden="true"></i> back</span></div>
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">vendor category</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="zara">
                                        <label class="custom-control-label" for="zara">bags</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="vera-moda">
                                        <label class="custom-control-label" for="vera-moda">clothes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="forever-21">
                                        <label class="custom-control-label" for="forever-21">shoes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="roadster">
                                        <label class="custom-control-label" for="roadster">accessories</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="only">
                                        <label class="custom-control-label" for="only">beauty products</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- color filter start here -->
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">colors</h3>
                            <div class="collection-collapse-block-content">
                                <div class="color-selector">
                                    <ul>
                                        <li class="color-1 active"></li>
                                        <li class="color-2"></li>
                                        <li class="color-3"></li>
                                        <li class="color-4"></li>
                                        <li class="color-5"></li>
                                        <li class="color-6"></li>
                                        <li class="color-7"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- price filter start here -->
                        <div class="collection-collapse-block border-0 open">
                            <h3 class="collapse-block-title">price</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="hundred">
                                        <label class="custom-control-label" for="hundred">$10 - $100</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="twohundred">
                                        <label class="custom-control-label" for="twohundred">$100 - $200</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="threehundred">
                                        <label class="custom-control-label" for="threehundred">$200 - $300</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="fourhundred">
                                        <label class="custom-control-label" for="fourhundred">$300 - $400</label>
                                    </div>
                                    <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="fourhundredabove">
                                        <label class="custom-control-label" for="fourhundredabove">$400 above</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="collection-sidebar-banner">
                        <a href="#"><img src="{{asset('frontend')}}/assets/images/side-banner.png" class="img-fluid blur-up lazyload"
                                alt=""></a>
                    </div> --}}
                    <!-- silde-bar colleps block end here -->
                </div>
                <div class="col">
                    <div class="collection-wrapper">
                        <div class="collection-content ratio_asos">
                            <div class="page-main-content">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i
                                                    class="fa fa-filter" aria-hidden="true"></i> Filter</span></div>
                                    </div>
                                </div>
                                <div class="collection-product-wrapper">
                                    <div class="product-top-filter">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="product-filter-content">
                                                    <div class="search-count">
                                                        <h5>Showing Products 1-24 of 10 Result</h5>
                                                    </div>
                                                    <div class="collection-view">
                                                        <ul>
                                                            <li><i class="fa fa-th grid-layout-view"></i></li>
                                                            <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="collection-grid-view">
                                                        <ul>
                                                            <li><img src="{{asset('frontend')}}/assets/images/icon/2.png" alt=""
                                                                    class="product-2-layout-view"></li>
                                                            <li><img src="{{asset('frontend')}}/assets/images/icon/3.png" alt=""
                                                                    class="product-3-layout-view"></li>
                                                            <li><img src="{{asset('frontend')}}/assets/images/icon/4.png" alt=""
                                                                    class="product-4-layout-view"></li>
                                                            <li><img src="{{asset('frontend')}}/assets/images/icon/6.png" alt=""
                                                                    class="product-6-layout-view"></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-page-per-view">
                                                        <select>
                                                            <option value="High to low">24 Products Par Page</option>
                                                            <option value="Low to High">50 Products Par Page</option>
                                                            <option value="Low to High">100 Products Par Page</option>
                                                        </select>
                                                    </div>
                                                    <div class="product-page-filter">
                                                        <select>
                                                            <option value="High to low">Sorting items</option>
                                                            <option value="Low to High">50 Products</option>
                                                            <option value="Low to High">100 Products</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-wrapper-grid">
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="{{asset('frontend')}}/assets/images/fashion/product/1.jpg"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"
                                                                title="Add to cart"><i
                                                                    class="ti-shopping-cart"></i></button> <a
                                                                href="javascript:void(0)" title="Add to Wishlist"><i
                                                                    class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                                data-toggle="modal" data-target="#quick-view"
                                                                title="Quick View"><i class="ti-search"
                                                                    aria-hidden="true"></i></a> <a href="compare.html"
                                                                title="Compare"><i class="ti-reload"
                                                                    aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div>
                                                            <div class="rating"><i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                    class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                                            <a href="product-page(no-sidebar).html">
                                                                <h6>Slim Fit Cotton Shirt</h6>
                                                            </a>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry. Lorem Ipsum has been the industry's
                                                                standard dummy text ever since the 1500s, when an unknown
                                                                printer took a galley of type and scrambled it to make a
                                                                type specimen book</p>
                                                            <h4>$500.00</h4>
                                                            <ul class="color-variant">
                                                                <li class="bg-light0"></li>
                                                                <li class="bg-light1"></li>
                                                                <li class="bg-light2"></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="{{asset('frontend')}}/assets/images/pro/1-.jpg"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"
                                                                title="Add to cart"><i
                                                                    class="ti-shopping-cart"></i></button> <a
                                                                href="javascript:void(0)" title="Add to Wishlist"><i
                                                                    class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                                data-toggle="modal" data-target="#quick-view"
                                                                title="Quick View"><i class="ti-search"
                                                                    aria-hidden="true"></i></a> <a href="compare.html"
                                                                title="Compare"><i class="ti-reload"
                                                                    aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="rating"><i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i></div><a
                                                            href="product-page(no-sidebar).html">
                                                            <h6>Slim Fit Cotton Shirt</h6>
                                                        </a>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s, when an unknown printer took a galley
                                                            of type and scrambled it to make a type specimen book</p>
                                                        <h4>$500.00</h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="{{asset('frontend')}}/assets/images/fashion/pro/04.jpg"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"
                                                                title="Add to cart"><i
                                                                    class="ti-shopping-cart"></i></button> <a
                                                                href="javascript:void(0)" title="Add to Wishlist"><i
                                                                    class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                                data-toggle="modal" data-target="#quick-view"
                                                                title="Quick View"><i class="ti-search"
                                                                    aria-hidden="true"></i></a> <a href="compare.html"
                                                                title="Compare"><i class="ti-reload"
                                                                    aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="rating"><i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i></div><a
                                                            href="product-page(no-sidebar).html">
                                                            <h6>Slim Fit Cotton Shirt</h6>
                                                        </a>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s, when an unknown printer took a galley
                                                            of type and scrambled it to make a type specimen book</p>
                                                        <h4>$500.00</h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="{{asset('frontend')}}/assets/images/fashion/product/4.jpg"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"
                                                                title="Add to cart"><i
                                                                    class="ti-shopping-cart"></i></button> <a
                                                                href="javascript:void(0)" title="Add to Wishlist"><i
                                                                    class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                                data-toggle="modal" data-target="#quick-view"
                                                                title="Quick View"><i class="ti-search"
                                                                    aria-hidden="true"></i></a> <a href="compare.html"
                                                                title="Compare"><i class="ti-reload"
                                                                    aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="rating"><i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i></div><a
                                                            href="product-page(no-sidebar).html">
                                                            <h6>Slim Fit Cotton Shirt</h6>
                                                        </a>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s, when an unknown printer took a galley
                                                            of type and scrambled it to make a type specimen book</p>
                                                        <h4>$500.00</h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="{{asset('frontend')}}/assets/images/fashion/product/25.jpg"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"
                                                                title="Add to cart"><i
                                                                    class="ti-shopping-cart"></i></button> <a
                                                                href="javascript:void(0)" title="Add to Wishlist"><i
                                                                    class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                                data-toggle="modal" data-target="#quick-view"
                                                                title="Quick View"><i class="ti-search"
                                                                    aria-hidden="true"></i></a> <a href="compare.html"
                                                                title="Compare"><i class="ti-reload"
                                                                    aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="rating"><i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i></div><a
                                                            href="product-page(no-sidebar).html">
                                                            <h6>Slim Fit Cotton Shirt</h6>
                                                        </a>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s, when an unknown printer took a galley
                                                            of type and scrambled it to make a type specimen book</p>
                                                        <h4>$500.00</h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="{{asset('frontend')}}/assets/images/beauty/pro/3.jpg"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"
                                                                title="Add to cart"><i
                                                                    class="ti-shopping-cart"></i></button> <a
                                                                href="javascript:void(0)" title="Add to Wishlist"><i
                                                                    class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                                data-toggle="modal" data-target="#quick-view"
                                                                title="Quick View"><i class="ti-search"
                                                                    aria-hidden="true"></i></a> <a href="compare.html"
                                                                title="Compare"><i class="ti-reload"
                                                                    aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="rating"><i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i></div><a
                                                            href="product-page(no-sidebar).html">
                                                            <h6>Slim Fit Cotton Shirt</h6>
                                                        </a>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s, when an unknown printer took a galley
                                                            of type and scrambled it to make a type specimen book</p>
                                                        <h4>$500.00</h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="{{asset('frontend')}}/assets/images/fashion/product/44.jpg"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"
                                                                title="Add to cart"><i
                                                                    class="ti-shopping-cart"></i></button> <a
                                                                href="javascript:void(0)" title="Add to Wishlist"><i
                                                                    class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                                                data-toggle="modal" data-target="#quick-view"
                                                                title="Quick View"><i class="ti-search"
                                                                    aria-hidden="true"></i></a> <a href="compare.html"
                                                                title="Compare"><i class="ti-reload"
                                                                    aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="rating"><i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i></div><a
                                                            href="product-page(no-sidebar).html">
                                                            <h6>Slim Fit Cotton Shirt</h6>
                                                        </a>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s, when an unknown printer took a galley
                                                            of type and scrambled it to make a type specimen book</p>
                                                        <h4>$500.00</h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="{{asset('frontend')}}/assets/images/beauty/pro/1.jpg"
                                                                    class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"
                                                                title="Add to cart"><i class="ti-shopping-cart"></i>
                                                            </button> <a href="javascript:void(0)"
                                                                title="Add to Wishlist"><i class="ti-heart"
                                                                    aria-hidden="true"></i></a> <a href="#"
                                                                data-toggle="modal" data-target="#quick-view"
                                                                title="Quick View"><i class="ti-search"
                                                                    aria-hidden="true"></i></a> <a href="compare.html"
                                                                title="Compare"><i class="ti-reload"
                                                                    aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="rating"><i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                                class="fa fa-star"></i> <i class="fa fa-star"></i></div><a
                                                            href="product-page(no-sidebar).html">
                                                            <h6>Slim Fit Cotton Shirt</h6>
                                                        </a>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                            industry. Lorem Ipsum has been the industry's standard dummy
                                                            text ever since the 1500s, when an unknown printer took a galley
                                                            of type and scrambled it to make a type specimen book</p>
                                                        <h4>$500.00</h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-pagination mb-0">
                                        <div class="theme-paggination-block">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6 col-sm-12">
                                                    <nav aria-label="Page navigation">
                                                        <ul class="pagination">
                                                            <li class="page-item"><a class="page-link" href="#"
                                                                    aria-label="Previous"><span aria-hidden="true"><i
                                                                            class="fa fa-chevron-left"
                                                                            aria-hidden="true"></i></span> <span
                                                                        class="sr-only">Previous</span></a></li>
                                                            <li class="page-item active"><a class="page-link" href="#">1</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item"><a class="page-link" href="#"
                                                                    aria-label="Next"><span aria-hidden="true"><i
                                                                            class="fa fa-chevron-right"
                                                                            aria-hidden="true"></i></span> <span
                                                                        class="sr-only">Next</span></a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="col-xl-6 col-md-6 col-sm-12">
                                                    <div class="product-search-count-bottom">
                                                        <h5>Showing Products 1-24 of 10 Result</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- collection section end -->

              {{-- <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset('frontend')}}." alt="Card image cap">
                <div class="card-body">
                    <div id="map"></div>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCE9-x9OVyUottiBHi_L6UZKB2rvj7eo&callback=initMap"
                     type="text/javascript"></script>
                </div>
              </div> --}}


              <!-- Replace the value of the key parameter with your own API key. -->

            </div>
        </div>
</section>
    <!--  dashboard section end -->
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
     $('.summernote').summernote({
           height: 200,
      });
   });
 </script>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<script>
    var loadImage = function(event) {
        var outputs = document.getElementById('outputs');
        outputs.src = URL.createObjectURL(event.target.files[0]);
    };
</script>


@endpush
