@extends('admin/layout')
@section('page_title','Manage FAQ')
@section('faq_select','active')
@section('links')
@endsection
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Mange FAQ</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">faqs</li>
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


                        <!-- /.card-header -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Manage FAQ Detail</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="post" action="{{route('faq.manage_faq_process')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Question</label>

                                        <div class="col-sm-10">
                                            <textarea type="text" id="legal_disclaimer" name="question"
                                                      class="ckeditor form-control col-md-7 col-xs-12"
                                            >{{$question}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Answer</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" id="legal_disclaimer" name="answer"
                                                      class="ckeditor form-control col-md-7 col-xs-12"
                                            >{{$answer}}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <input type="hidden" name="id" value="{{$id}}"/>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Save Changes</button>
                                    <a href="{{url('admin/faqs')}}" class="btn btn-default float-right">Cancel</a>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.card-body -->

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

    <!-- /page content -->
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="{{asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
