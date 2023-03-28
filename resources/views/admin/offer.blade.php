@extends('admin/layout')
@section('page_title','Offer Page')
@section('brand_select','active')
@section('container')
    <!-- page content -->
    <div class="right_col" role="main" style="min-height: 1197px;">
        <div>
            <div class="page-title">
                <div class="title_left">
                    <h3>Offers</h3>
                    <a class="btn btn-primary" href="{{url('admin/offers/manage_offer')}}">Add <Offer></Offer> +</a>
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
                                        <th class="column-title">Offer Name</th>
                                        <th class="column-title">Value</th>
                                        <th class="column-title">Percentage/Rs.</th>
                                        <th class="column-title">Created At</th>
                                        <th class="column-title">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($data as $list)
                                        <tr class="even pointer">
                                            <td class=" ">{{$list->id}}</td>
                                            <td class=" ">{{$list->name}}</td>
                                            <td class=" ">{{$list->value}}</td>
                                            @if($list->type == 1)
                                            <td class=" ">Rs.</td>
                                            @else
                                                <td class=" ">Percentage</td>
                                            @endif
                                            <td class=" ">{{\Carbon\Carbon::parse($list->created_at)->format('l jS \of F Y h:i:s A')}}</td>
                                            <td class=" last"> <a
                                                    href="{{url('admin/offers/manage_offer/')}}/{{$list->id}}"><i
                                                        class="fa fa-edit"></i> <span class="text-muted"></span></a>
                                                <a onclick="return confirm('Are you sure want to delete this record?')"
                                                   href="{{url('admin/offers/delete/')}}/{{$list->id}}"><i
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

