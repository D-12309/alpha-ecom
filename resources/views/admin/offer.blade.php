@extends('admin/layout')
@section('page_title','Discount Page')
@section('discount_select','active')
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
                        <h1 class="m-0">Discounts</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Discounts</li>
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
                                    <h3 class="card-title">Discount Details</h3>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{url('admin/offers/manage_offer')}}" class="btn btn-block btn-outline-primary btn-lg float-left">Add Discount +</a>
                                    </div>
                                </div>



                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="">#</th>
                                        <th class="">Discount Name</th>
                                        <th class="">Value</th>
                                        <th class="">Percentage/Rs.</th>
                                        <th class="">Created At</th>
                                        <th class="">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $list)
                                        <tr class="">
                                            <td class=" ">{{$list->id}}</td>
                                            <td class=" ">{{$list->name}}</td>
                                            <td class=" ">{{$list->value}}</td>
                                            @if($list->type == 1)
                                                <td class=" ">Rs.</td>
                                            @else
                                                <td class=" ">Percentage</td>
                                            @endif
                                            <td class=" ">{{\Carbon\Carbon::parse($list->created_at)->format('l jS \of F Y h:i:s A')}}</td>
                                            <td class=" last">     <a onclick="return confirm('Are you sure want to delete this record?')"
                                                                      href="{{url('admin/offers/delete/')}}/{{$list->id}}"><i
                                                        class="fa fa-trash"></i> <span class="text-muted"></span></a> <a
                                                    href="{{url('admin/offers/manage_offer/')}}/{{$list->id}}"><i
                                                        class="fa fa-edit"></i> <span class="text-muted"></span></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="">#</th>
                                        <th class="">Discount Name</th>
                                        <th class="">Value</th>
                                        <th class="">Percentage/Rs.</th>
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
    <!-- page content -->
    {{-- <div class="right_col" role="main" style="min-height: 1197px;">
         <div>
             <div class="page-title">
                 <div class="title_left">
                     <h3>Users</h3>
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
                                         <th class="column-title">User Name</th>
                                         <th class="column-title">Email Address</th>
                                         <th class="column-title">Contact No.</th>
                                         <th class="column-title">Pin Code</th>
                                         <th class="column-title">Created At</th>
                                     </tr>
                                     </thead>

                                     <tbody>

                                     @foreach($data as $list)
                                         <tr class="even pointer">
                                             <td class=" ">{{$list->id}}</td>
                                             <td class=" ">{{$list->name}}</td>
                                             <td class=" ">{{$list->email}}</td>
                                             <td class=" ">{{$list->contact_no}}</td>
                                             <td class=" ">{{$list->pin_code}}</td>
                                             <td class=" ">{{\Carbon\Carbon::parse($list->created_at)->format('l jS \of F Y h:i:s A')}}</td>
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
     </div>--}}
    <!-- /page content -->
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
