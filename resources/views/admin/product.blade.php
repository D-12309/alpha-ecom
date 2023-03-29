@extends('admin/layout')
@section('page_title','Product Page')
@section('product_select','active')
@section('links')
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin_assets/dist/css/adminlte.min.css')}}">
@endsection
@section('container')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Products</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-9">
                                        <h3 class="card-title">Product Details</h3>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{url('admin/products/manage_product')}}" class="btn btn-block btn-outline-primary btn-lg float-left">Add Product +</a>
                                    </div>
                                </div>



                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="">#</th>
                                        <th class="">Product Name</th>
                                        <th class="">Image</th>
                                        <th class="">Quantity</th>
                                        <th class="">MRP</th>
                                        <th class="">Price</th>
                                        <th class="">Created At</th>
                                        <th class="">Action</th>
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
                                                        class="fa fa-trash"></i> <span class="text-muted"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="">#</th>
                                        <th class="">Product Name</th>
                                        <th class="">Image</th>
                                        <th class="">Quantity</th>
                                        <th class="">MRP</th>
                                        <th class="">Price</th>
                                        <th class="">Created At</th>
                                        <th class="">Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('admin_assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin_assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
