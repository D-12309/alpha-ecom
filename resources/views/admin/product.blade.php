@extends('admin/layout')
@section('page_title','Product Page')
@section('product_select','active')
@section('container')
    <!-- page content -->
    <div class="right_col" role="main" style="min-height: 1197px;">
        <div>
            <div class="page-title">
                <div class="title_left">
                    <h3>Products</h3>
                    <a class="btn btn-primary" href="{{url('admin/products/manage_product')}}">Add Product +</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">#</th>
                                        <th class="column-title">Product Name</th>
                                        <th class="column-title">Image</th>
                                        <th class="column-title">Quantity</th>
                                        <th class="column-title">MRP</th>
                                        <th class="column-title">Price</th>
                                        <th class="column-title">Created At</th>
                                        <th class="column-title">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($data as $list)
                                        <tr class="even pointer">
                                            <td class=" ">{{$list->id}}</td>
                                            <td class=" ">{{$list->name}}</td>
                                            @if(env('APP_ENV') == 'production')
                                                @if (Storage::disk('s3')->exists($list['productImages'][0]['image']))
                                                    <td> <img src="{{Storage::disk('s3')->url($list['productImages'][0]['image'])}}" width="100px"></td>
                                                @endif
                                            @else
                                                <td> <img src="/{{$list['productImages'][0]['image']}}" width="100px"></td>
                                            @endif
                                            <td class=" ">{{$list->qty}}</td>
                                            <td class=" ">{{$list->mrp}}</td>
                                            <td class=" ">{{$list->price}}</td>

                                            <td class=" ">{{\Carbon\Carbon::parse($list->created_at)->format('l jS \of F Y h:i:s A')}}</td>
                                            <td class=" last"> <a
                                                    href="{{url('admin/products/manage_product/')}}/{{$list->id}}"><i
                                                        class="fa fa-edit"></i> <span class="text-muted"></span></a>
                                                <a onclick="return confirm('Are you sure want to delete this record?')"
                                                   href="{{url('admin/products/delete/')}}/{{$list->id}}"><i
                                                        class="fa fa-remove"></i> <span class="text-muted"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $data->links() !!}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

