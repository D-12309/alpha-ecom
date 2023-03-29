@extends('admin/layout')
@section('page_title','FAQ Page')
@section('faq_select','active')
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
                        <h1 class="m-0">FAQS</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Faqs</li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-3 offset-9">
                        <a href="{{url('admin/faqs/manage_faq')}}"
                           class="btn btn-block btn-outline-primary btn-lg float-left">Add FAQ +</a>
                    </div>

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="row">
                <div class="col-12" id="accordion">
                    @foreach($data as $key => $list)
                        <div class="card card-primary card-outline">
                            <a class="" data-toggle="collapse" href="#collapseOne{{$key}}"
                               aria-expanded="true">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="card-title w-100">
                                                {{$key +1}}. {{$list->question}}
                                            </h4>
                                        </div>
                                        <div class="col-md-2">
                                            <a
                                                href="{{url('admin/faqs/manage_faq/')}}/{{$list->id}}"><i
                                                    class="fa fa-edit"></i> <span class="text-muted"></span></a>
                                            <a onclick="return confirm('Are you sure want to delete this record?')"
                                               href="{{url('admin/faqs/delete/')}}/{{$list->id}}"><i
                                                    class="fa fa-trash"></i> <span class="text-muted"></span></a>
                                        </div>
                                    </div>


                                </div>
                            </a>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion{{$key}}" style="">
                                <div class="card-body">
                                    {{$list->answer}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3 text-center">
                    <p class="lead">
                        <a href="contact-us.html">Contact us</a>,
                        if you found not the right anwser or you have a other question?<br>
                    </p>
                </div>
            </div>
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
