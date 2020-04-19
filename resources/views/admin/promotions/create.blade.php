@extends('admin.layout.master')

@section('content')
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Create Promotion
                                    <small>AndBaazar Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Promotion </li>
                                <li class="breadcrumb-item active">Create Promotion</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="card tab2-card">
                    <div class="card-header">
                        <h5>Create New Promotion</h5>
                    </div>
                    <div class="card-body">
                                <form class="needs-validation" novalidate="" action="{{ route('promotion.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-10">
                                          <div class="form-group col-md-10 ">
                                             <div class="form-group row">
                                                 <label for="title" class="col-xl-3 col-md-4">Promotion Head <span>*</span></label>
                                                <select name="promotion_head_id" class="form-control col-md-8 " id="promotion_head_id" required autocomplete="off">
                                                    <option value="" selected disabled>Select Promotion Head</option>
                                                    @foreach ($promotionhead as $row)
                                                        <option value="{{ $row->id }}">{{$row->promotion_name}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            <div class="form-group row">
                                                <label for="title" class="col-xl-3 col-md-4">Title <span>*</span></label>
                                                <input class="form-control col-md-8" name="title" id="title" type="text" required="">
                                            </div>

                                            <div class="form-group row">
                                                <label for="description" class="col-xl-3 col-md-4">Description <span>*</span></label>
                                                <textarea class="form-control col-md-8" name="description" id="description" type="text" required=""></textarea>
                                            </div>
                                            <div class="form-group row">
                                                <label for="valid_from" class="col-xl-3 col-md-4">Valid From  <span>*</span></label>
                                               <input type="date" name="valid_from" value="{{old('date',date('Y-m-d'))}}" class="form-control col-md-8 datepickerDB" id="valid_from" required autocomplete="off">
                                            </div>
                                            <div class="form-group row">
                                                <label for="valid_to" class="col-xl-3 col-md-4">Valid To  <span>*</span></label>
                                               <input type="date" name="valid_to" value="{{old('date',date('Y-m-d'))}}" class="form-control col-md-8 datepickerDB" id="valid_to" required autocomplete="off">
                                            </div>
                                            <div class="form-group row">
                                                <label for="coupon_code" class="col-xl-3 col-md-4">Coupon Code <span>*</span></label>
                                                <input class="form-control col-md-8" name="coupon_code" id="coupon_code" type="text" required="">
                                            </div>
                                              <div class="form-group row">
                                                <label class="col-xl-3 col-md-4"></label>
                                                <div class="checkbox checkbox-primary col-md-8">
                                                    <button type="submit"  class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>
@endsection
