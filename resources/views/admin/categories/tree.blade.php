@extends('admin.layout.master')

@section('content')
@push('css')
<style> 
    .fa{
        padding:4px;
      font-size:16px;
    }
</style>
@endpush
@include('elements.alert')
@component('admin.layout.inc.breadcrumb')
  @slot('pageTitle')
    Categories
  @endslot
  @slot('page')
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      <li class="breadcrumb-item active" aria-current="page">Tree</li>
  @endslot
@endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Categories</h5>
                    </div>
                    <div class="card-body">
                        <table border="1" class="table table-borderd">
                            <thead>
                              <tr>
                                 <th width="50" class="text-center">Sl</th>
                                 <th colspan="4">Categories Name</th>
                                 <th width="200">Slug</th>
                                 <th width="150" class="text-center">Commision</th>
                                 <th width="80" class="text-center">Action</th>
                              </tr>
                          </thead>
                        <tbody>
                            @php $i=1 @endphp
                            @foreach ($categories as  $cat)
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td colspan="4">{{$cat->name}}</td>
                                    <td>{{$cat->slug}}</td>
                                    <td class="text-center">{{$cat->percentage}}%</td>
                                    <td><a href="{{ url('/andbaazaradmin/category/'.$cat->slug.'/edit')}}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i> </a></td>
                                </tr>
                                @php $i++ @endphp
                                @foreach ($cat->allChilds as $child)
                                    <tr>
                                        <td class="text-center">{{$i}}</td>
                                        <td></td>
                                        <td colspan="3">{{$child->name}}</td>
                                        <td>{{$child->slug}}</td>
                                        <td class="text-center">{{$child->percentage}}%</td>
                                        <td><a href="{{ url('/andbaazaradmin/category/'.$child->slug.'/edit')}}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i> </a></td>
                                    </tr>
                                    @php $i++ @endphp
                                    @foreach ($child->allChilds as $level3)
                                        <tr>
                                            <td class="text-center">{{$i}}</td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">{{$level3->name}}</td>
                                            <td>{{$level3->slug}}</td>
                                            <td class="text-center">{{$level3->percentage}}%</td>
                                            <td><a href="{{ url('/andbaazaradmin/category/'.$level3->slug.'/edit')}}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i> </a></td>
                                        </tr>
                                        @php $i++ @endphp
                                        @foreach ($level3->allChilds as $level4)
                                            <tr>
                                                <td class="text-center">{{$i}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="1">{{$level4->name}}</td>
                                                <td>{{$level4->slug}}</td>
                                                <td class="text-center">{{$level4->percentage}}%</td>
                                                <td><a href="{{ url('/andbaazaradmin/category/'.$level4->slug.'/edit')}}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i> </a></td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection