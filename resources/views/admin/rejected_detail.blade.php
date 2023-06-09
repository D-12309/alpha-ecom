@extends('admin/layout')
@section('page_title','Rejected Detail Page')
@section('rejected_detail_select','active')
@section('links')
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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
                        <h1 class="m-0">Business Detail</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Business Detail</li>
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
                                <h3 class="card-title">Business Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Owner Name</th>
                                        <th>Shop name</th>
                                        <th>Contact Person Name</th>
                                        <th>Owner Image</th>
                                        <th>Recipient Name</th>
                                        <th>Mobile No</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                        <th>Rejected Message (if Rejected)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $list)
                                        <tr class="">
                                            <td class=" ">{{$list->id}}</td>
                                            <td class=" ">{{$list->owner_name}}</td>
                                            <td class=" ">{{$list->shop_name}}</td>
                                            <td class=" ">{{$list->contact_person_name}}</td>
                                            <td class=" ">{{$list->owner_image}}</td>
                                            <td class=" ">{{$list->recipient_name}}</td>
                                            <td class=" ">{{$list->mobile_no}}</td>
                                            <td class=" ">{{\Carbon\Carbon::parse($list->created_at)->format('l jS \of F Y h:i:s A')}}</td>
                                            <td class=" last"><a class="mt-2"
                                                                 href="{{url('admin/business-details/')}}/{{$list->id}}">view
                                                    <span class="text-muted"></span></a>
                                            </td>
                                            <td class="col-md-12">
                                                <form class="form-horizontal" method="post"
                                                      action="{{route('rejected.rejected_message')}}">
                                                    @csrf

                                                    <div class="col-md-12">
                                                        <input type="hidden" name="id" value="{{$list->id}}">
                                                        <textarea type="text" class="form-control" id="inputEmail3"
                                                                  name="rejected_message" required
                                                                  placeholder="rejection message ...">{{$list->rejected_message ?? ''}}</textarea>
                                                        @if (!$list->is_rejected)
                                                            <button type="submit" class="btn btn-danger mt-2">Rejected
                                                            </button>
                                                        @else
                                                            Rejected
                                                        @endif
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Owner Name</th>
                                        <th>Shop name</th>
                                        <th>Contact Person Name</th>
                                        <th>Owner Image</th>
                                        <th>Recipient Name</th>
                                        <th>Mobile No</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                        <th>Rejected Message (if Rejected)</th>
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
