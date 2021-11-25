@extends('merchant.master')

@section('content')
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/admin.css">
@endpush    
@include('elements.alert')

  <!--  dashboard section start -->
  <section class="dashboard-section page-wrapper   section-b-space">
    <div class="container">
        <div class="row">
            @include('layouts.inc.sidebar.vendor-sidebar',[$active='dasboard'])
            <div class="col-lg-9">
                @include('merchant.merchant-status',[$seller = Baazar::seller()])
                <div class="dashboard_top_area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="bashboard_heading">
                        <h2 style="font-size: 24px;font-weight: 600; margin: 0; text-transform: capitalize;">Dashboard</h2>
                    </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="choose_sellect w-100">
                        <p class="m-0 pr-2" style="font-size: 16px; font-weight: 500;">Choose business:</p>
                        <select class="form-control" id="exampleFormControlSelect1" style="width: 36%;">
                            <option>All</option>
                            <option>Krishibazzar</option>
                            <option>SME</option>
                            <option>Ecommerce</option>
                            <option>Action</option>
                        </select>
                    </div>
                    </div>
                    </div>
                </div>
                <div class=" tab-content" id="top-tabContent">
                    <div class="tab-pane fade show active" id="dashboard">
                        <div class="counter-section">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="dasgboard_items_card one_bg">
                                        <h1>152</h1>
                                        <p>Total Product</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="dasgboard_items_card two_bg">
                                        <h1>152</h1>
                                        <p>Total Product</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="dasgboard_items_card three_bg">
                                        <h1>152</h1>
                                        <p>Total Product</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="dasgboard_items_card four_bg">
                                        <h1>152</h1>
                                        <p>Total Product</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="dasgboard_items_card five_bg">
                                        <h1>152</h1>
                                        <p>Total Product</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="dasgboard_items_card six_bg">
                                        <h1>152</h1>
                                        <p>Total Product</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="chart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="chart-order"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order_outline">
                            <div class="row">
                                <div class="col-lg-12">
                                   <div class="order_outline_heading mb-3">
                                   <h4>Order outline</h4>
                                   </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="order_items_card one_bg">
                                        <h3>152</h3>
                                        <p>Received</p>
                                        <i class="fa fa-level-down"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="order_items_card two_bg">
                                        <h3>152</h3>
                                        <p>Processed</p>
                                        <i class="fa fa-spinner"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="order_items_card three_bg">
                                        <h3>152</h3>
                                        <p>Shipped</p>
                                        <i class="fa fa-truck"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="order_items_card four_bg">
                                        <h3>152</h3>
                                        <p>Delivered</p>
                                        <i class="fa fa-handshake-o"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="order_items_card five_bg">
                                        <h3>152</h3>
                                        <p>Cancelled</p>
                                        <i class="fa fa-times"></i>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="order_items_card six_bg">
                                        <h3>152</h3>
                                        <p>Returned</p>
                                        <i class="fa fa-level-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="card">
                                <div class="search_date_area">
                                    <form action="#!">
                                        <div class="row">
                                            <div class="col-lg-4">
                                            <div class="form-group m-0">
                                        <label> Choose marketplace</label>
                                        <select class="form-control">
                                            <option value="">--Select--</option>
                                            <option value="1">All</option>
                                            <option value="2">Sme</option>
                                            <option value="3">Krishibazzar</option>
                                            <option value="4">Andbazzar</option>
                                        </select>
                                    </div>
                                         
                                    
                                            </div>
                                            <div class="col-lg-4 ">
                                            <div class="form-group  m-0">
                                        <label>Filter by status</label>
                                        <select class="form-control">
                                            <option value="">--Select--</option>
                                            <option value="1">All</option>
                                            <option value="2">pending</option>
                                            <option value="3">Cancel</option>
                                        </select>
                                    </div>
                                            </div>
                                            <div class="col-lg-4">
                                            <div class="form-group  m-0">
                                        <label for="start">Filter by date:</label> <br/>
                                        <input  class="form-control" type="date" id="start" name="trip-start"
                                            value="2018-07-22"
                                        min="2018-01-01" max="2018-12-31">
                                         </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <div class="card-body ordr_Tables order-datatable">
                                <table class="display" id="basic-1">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Order Id</th>
                                        <th>Quantity</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>#1</td>
                                        <td>#51240</td>
                                        <td>4</td>
                                        <td>Abu Musa</td>
                                        <td>Alu Pottol</td>
                                        <td>4671</td>
                                        <td><span class="badge badge-danger">Cancelled</span></td>
                                        <td>May 8,18</td>
                                    </tr>
                                    <tr>
                                        <td>#1</td>
                                        <td>#51240</td>
                                        <td>4</td>
                                        <td>Abu Musa</td>
                                        <td>Alu Pottol</td>
                                        <td>4671</td>
                                        <td><span class="badge badge-danger">Cancelled</span></td>
                                        <td>May 8,18</td>
                                    </tr>
                                    <tr>
                                        <td>#1</td>
                                        <td>#51240</td>
                                        <td>4</td>
                                        <td>Abu Musa</td>
                                        <td>Alu Pottol</td>
                                        <td>4671</td>
                                        <td><span class="badge badge-danger">Cancelled</span></td>
                                        <td>May 8,18</td>
                                    </tr>
                                    <tr>
                                        <td>#1</td>
                                        <td>#51240</td>
                                        <td>4</td>
                                        <td>Abu Musa</td>
                                        <td>Alu Pottol</td>
                                        <td>4671</td>
                                        <td><span class="badge badge-danger">Cancelled</span></td>
                                        <td>May 8,18</td>
                                    </tr>
                                    </tbody>
                                </table>
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
<!--  dashboard section end -->

@endsection

@push('js')
    <!-- chart js -->
    <script src="{{asset('frontend')}}/assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/datatables/custom-basic.js"></script>
<script src="{{asset('frontend')}}/assets/js/sidebar-menu.js"></script>
    <script src="{{asset('frontend')}}/assets/js/chart/apex/apexcharts.js"></script>
    <script src="{{asset('frontend')}}/assets/js/chart/apex/custom-chart.js"></script>
@endpush