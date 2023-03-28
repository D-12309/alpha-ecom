@extends('admin/layout')
@section('page_title','Manage offer')
@section('offer_select','active')
@section('links')
@endsection
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Mange Offer</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Offers</li>
                        </ol>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 offset-3">


                        <!-- /.card-header -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Manage Offer Detail</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="post" action="{{route('offer.manage_offer_process')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Offer Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$name ? $name : old('name')}}">
                                            @error('name')
                                            <span style="color: red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Offer Value</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputEmail3" name="value"
                                                   value="{{$value ? $value : old('value')}}">
                                            @error('value')
                                            <span style="color: red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Offer Type</label>
                                        <div class="col-sm-10">
                                            <select type="text" id="is_application_submitted" name="type"
                                                    class="custom-select">
                                                @if($type == 1)
                                                    <option value="1" selected>Rs.</option>
                                                    <option value="2">Percentage</option>
                                                @else
                                                    <option value="1" >Rs.</option>
                                                    <option value="2" selected>Percentage</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="{{$id}}"/>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Save Changes</button>
                                    <a href="{{url('admin/offers')}}"class="btn btn-default float-right">Cancel</a>
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
    <script src="{{asset('admin_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection
