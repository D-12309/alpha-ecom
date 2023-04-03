@extends('admin/layout')
@section('page_title','Manage Business Detail')
@section('business_detail_select','active')
@section('links')
@endsection
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Mange Business Detail</h1>
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
                    <div class="col-6 offset-3">


                        <!-- /.card-header -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Manage Business Detail</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" >
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Owner Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$owner_name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Owner Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$shop_name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Shop Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$shop_name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Contact Person Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$contact_person_name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Owner Image</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$owner_image}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Recipient Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$recipient_name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Contact Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$mobile_no}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">House No.</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$house_no}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Street Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$street}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Locality</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$locality}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Landmark</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$landmark}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">City</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$city}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pin Code</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$pin_code}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Id Type</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$id_type}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Id No.</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$id_no}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Licence TYpe</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$licence_type}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Licence No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$licence_no}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Licence Image</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$licence_image}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Government Image</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="name"
                                                   value="{{$government_image}}">
                                        </div>
                                    </div>
                                </div>




                                <input type="hidden" name="id" value="{{$id}}"/>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="approved" class="btn btn-info">Approved</button>
                                    <button type="submit" name="rejected" class="btn btn-info">Rejected</button>
                                    <a href="{{url('admin/brands')}}"class="btn btn-default float-right">Cancel</a>
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
