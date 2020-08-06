@extends('admin.layout.master') @section('content') @push('css')
<style>
    .fa {
        padding: 4px;
        font-size: 16px;
    }
</style>
@endpush 
@include('elements.alert') 
@component('admin.layout.inc.breadcrumb') 
@slot('pageTitle') News Feed 
@endslot 
@slot('page')
<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
<li class="breadcrumb-item active" aria-current="page">News Feed</li>
@endslot @endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- <div class="card-header">
                        <h5> Product List</h5>
                    </div> -->
                <div class="card-body">  
                            <div class="card-body order-datatable">
                                <table class="table table-borderd" id="dataTableNoPagingDesc3">
                                    <thead>
                                        <tr>
                                            <th width="50">Sl</th>
                                            <th>Product Name</th>
                                            <th>Feed By</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=0; @endphp @foreach($newsFeed as $row)
                                        <tr>
                                            <td>{{ ++$i }}</td> 
                                            <td>{{ $row->item->name}}</td>
                                            <td>{{ $row->user->first_name.' '.$row->user->last_name}}</td>
                                            <td>{{ $row->title}}</td>
                                            <td>{{ Baazar::short_text(strip_tags($row->news_desc),30) }}</td>
                                            <td>{{ $row->item->type }}</td>
                                            <td>
                                                @if($row->item->status == 'Pending')
                                                <label class="badge badge-pill badge-info p-2">Pending</label>
                                                @elseif($row->item->status == 'Active')
                                                <label class="badge badge-pill badge-success p-2">Active</label>
                                                @else
                                                <label class="badge badge-pill badge-primary p-2">Reject</label>
                                                {{-- <a href="#" id="" class="badge badge-pill badge-warning p-2" data-toggle="modal" data-original-title="test" data-target="#tagEditModal{{$row->id}}">Reject</a>  --}}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <ul>
                                                    <li>
                                                        {{-- <a href="{{ url('/merchant/product/'.$row->slug) }}"><button class="btn btn-sm btn-secondary">View</button></a> --}}
                                                        <a href="#" id="" class="btn btn-sm btn-secondary" data-toggle="modal" data-original-title="test" data-target="#feedModal{{$row->id}}">View</a>
                                                    </li> 
                                                </ul>
                                            </td>
                                        </tr>
                                        
                                        <div class="modal fade" id="feedModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title f-w-600" id="exampleModalLabel">News Feed</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>

                                                    <div class="modal-body">  
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="cal-md-6">
                                                                    <img  src="{{!empty($row->image) ? asset($row->image) : asset('/uploads/newsfeed_image/newsfeed-4.png')}}" alt="" height="200" width="200" class="img-fluid"> 
                                                                </div>
                                                            </div> 
                                                            <h3 class="font-weight-bold mt-2">{{ $row->title }}</h3> 
                                                            <p>{!! $row->news_desc !!}</p>
                                                            <div>
                                                                @if($row->item->type == 'ecommerce')
                                                                @if($row->item->status == 'Pending')
                                                                <label class="badge badge-pill badge-info p-2">Pending</label>
                                                                <a href="{{ url('/merchant/product/'.$row->item->slug) }}" class="btn btn-sm btn-warning">Approve</a> 
                                                                <a href="{{ url('/merchant/product/'.$row->item->slug) }}" class="btn btn-sm btn-primary">Reject</a>
                                                                @elseif($row->item->status == 'Active')
                                                                <label class="badge badge-pill badge-success p-2">Active</label>
                                                                @else
                                                                <label class="badge badge-pill badge-primary p-2">Reject</label> 
                                                                @endif
                                                                @else
                                                                @if($row->item->status == 'Pending')
                                                                <label class="badge badge-pill badge-info p-2">Pending</label>
                                                                <a href="{{ url('/merchant/sme/product/'.$row->item->slug) }}" class="btn btn-sm btn-warning">Approve</a>
                                                                <a href="{{ url('/merchant/sme/product/'.$row->item->slug) }}" class="btn btn-sm btn-primary">Reject</a> 
                                                                @elseif($row->item->status == 'Active')
                                                                <label class="badge badge-pill badge-success p-2">Active</label>
                                                                @else
                                                                <label class="badge badge-pill badge-primary p-2">Reject</label> 
                                                                @endif
                                                                @endif
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            @endforeach
                                        </div>
                                    </tbody>
                                </table>
                            </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection