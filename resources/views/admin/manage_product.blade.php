@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('links')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>
@endsection
@section('container')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Mange Product</h1>
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
                    <div class="col-12 ">


                        <!-- /.card-header -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Manage Product Detail</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" method="post"
                                  action="{{route('product.manage_product_process')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Product Name</label>
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
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Product Qty.</label>
                                        <div class="card-body">
                                            @foreach($quantity as $key => $qty)
                                                <div class="form-group row {{$key}}">
                                                    @if ($id > 0)
                                                        <label for="inputEmail3"
                                                               class="col-sm-2 col-form-label">{{$qty->name}}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id=""
                                                                   name="qty[]"
                                                                   value="{{$qty->qty ? $qty->qty : old('qty')}}">
                                                            @error('qty')
                                                            <span style="color: red">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    @else
                                                        <label for="inputEmail3"
                                                               class="col-sm-2 col-form-label">{{$qty['name']}}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id=""
                                                                   name="qty[]"
                                                                   value="{{$qty['qty'] ? $qty['qty'] : old('qty')}}">
                                                            @error('qty')
                                                            <span style="color: red">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Product SKU</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" name="sku"
                                                   value="{{$sku ? $sku  : old('sku')}}">
                                            @error('sku')
                                            <span style="color: red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Product Mrp.</label>
                                        <div class="card-body">
                                            @foreach($mrps as $mrp)
                                                <div class="form-group row">
                                                    @if ($id > 0)
                                                        <label for="inputEmail3"
                                                               class="col-sm-2 col-form-label">{{$mrp->name}}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id=""
                                                                   name="mrp[]"
                                                                   value="{{$mrp->mrp ? $mrp->mrp : old('mrp')}}">
                                                            @error('mrp')
                                                            <span style="color: red">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    @else
                                                        <label for="inputEmail3"
                                                               class="col-sm-2 col-form-label">{{$mrp['name']}}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id=""
                                                                   name="mrp[]"
                                                                   value="{{$mrp['mrp'] ? $mrp['mrp'] : old('mrp')}}">
                                                            @error('mrp')
                                                            <span style="color: red">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Product Price.</label>
                                        <div class="card-body">
                                            @foreach($prices as $price)
                                                <div class="form-group row">
                                                    @if ($id > 0)
                                                        <label for="inputEmail3"
                                                               class="col-sm-2 col-form-label">{{$price->name}}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id=""
                                                                   name="price[]"
                                                                   value="{{$price->price ? $price->price : old('price')}}">
                                                            @error('price')
                                                            <span style="color: red">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    @else
                                                        <label for="inputEmail3"
                                                               class="col-sm-2 col-form-label">{{$price['name']}}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id=""
                                                                   name="price[]"
                                                                   value="{{$price['price'] ? $price['price'] : old('price')}}">
                                                            @error('price')
                                                            <span style="color: red">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">

                                    @foreach($slab_prices as $slab_price)
                                        @php
                                            $loop_count_num=1;
                                        @endphp
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Slab
                                                Prices.</label>
                                            <div class="card-body">
                                        @foreach($slab_price as $key => $price)
                                            @php
                                                $loop_count_prev=$loop_count_num;
                                            @endphp


                                                    @if ($id > 0)
                                                        <div id="product_images_box_{{$price->name}}">
                                                            <div
                                                                class="form-group row product_images_{{$price->name}}_{{$loop_count_num++}}">
                                                                <label for="inputEmail3"
                                                                       class="col-sm-2 col-form-label">{{$price->name}}</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control" id=""
                                                                           placeholder="Enter Qty"
                                                                           name="slabQty[{{$price->name}}][]"
                                                                           value="{{$price->qty ? $price->qty : old('qty')}}">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control" id=""
                                                                           placeholder="Enter Price"
                                                                           name="slabPrice[{{$price->name}}][]"
                                                                           value="{{$price->price ? $price->price : old('price')}}">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control" id=""
                                                                           name="slabMargin[{{$price->name}}][]"
                                                                           placeholder="Enter Margin"
                                                                           value="{{$price->margin ? $price->margin : old('margin')}}">
                                                                </div>
                                                                @if($loop_count_num==2)
                                                                    <div class="col-sm-1">
                                                                        <a class="btn btn-outline-primary btn-block"
                                                                           onclick="add_slab_module('{{$price->name}}')">
                                                                            <i class="fas fa-plus"></i>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    @php
                                                                        $loop = $loop_count_num;
                                                                    @endphp
                                                                    <div class="col-sm-1">
                                                                        <a class="btn btn-outline-danger btn-block"
                                                                           onclick="remove_image_more('{{$loop -1}}','{{$price->name}}')">
                                                                            <i class="fas fa-minus"></i>
                                                                        </a>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div id="product_images_box_{{$price['name']}}">
                                                            <div
                                                                class="form-group row product_images_{{$price['name']}}_{{$loop_count_num++}}">
                                                                <label for="inputEmail3"
                                                                       class="col-sm-2 col-form-label">{{$price['name']}}</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control" id=""
                                                                           placeholder="Enter Qty"
                                                                           name="slabQty[{{$price['name']}}][]"
                                                                           value="{{$price['qty'] ? $price['qty'] : old('qty')}}">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control" id=""
                                                                           placeholder="Enter Price"
                                                                           name="slabPrice[{{$price['name']}}][]"
                                                                           value="{{$price['price'] ? $price['price'] : old('price')}}">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control" id=""
                                                                           name="slabMargin[{{$price['name']}}][]"
                                                                           placeholder="Enter Margin"
                                                                           value="{{$price['margin'] ? $price['margin'] : old('margin')}}">
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <a class="btn btn-outline-primary btn-block"
                                                                       onclick="add_slab_module('{{$price['name']}}','{{$loop_count_num}}')">
                                                                        <i class="fas fa-plus"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif


                                        @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Brand</label>
                                        <div class="col-sm-10">
                                            <select type="text" id="is_application_submitted" name="brand_id"
                                                    class="custom-select">
                                                @foreach($brands as $Key=>$brand)
                                                    <option
                                                        value="{{$Key}}" {{$Key==$brand_id ? "selected" : ''}}>{{$brand}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-10">
                                            <select type="text" id="is_application_submitted" name="category_id"
                                                    class="custom-select">
                                                @foreach($categories as $Key=>$category)
                                                    <option
                                                        value="{{$Key}}" {{$Key==$category_id  ? "selected" : ''}}>{{$category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Key Highligh</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" id="is_application_submitted" name="key_highlight"
                                                      class="ckeditor form-control col-md-7 col-xs-12"
                                            >{{$key_highlight}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" id="is_application_submitted" name="description"
                                                      class="ckeditor form-control col-md-7 col-xs-12" required
                                            >{{$description}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Specification</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" id="is_application_submitted" name="specification"
                                                      class="ckeditor form-control col-md-7 col-xs-12"
                                            >{{$specification}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Legal
                                            Disclaimer</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" id="legal_disclaimer" name="legal_disclaimer"
                                                      class="ckeditor form-control col-md-7 col-xs-12"
                                            >{{$legal_disclaimer}}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Documents</label>
                                        <div class="needsclick dropzone col-sm-10" id="document-dropzone">
                                            @foreach($productImagesArr as $key=>$val)
                                                @if(env('APP_ENV') == 'production')
                                                    @if($val['image']!='' && Storage::disk('s3')->exists($val['image']))
                                                        <a href="/{{Storage::disk('s3')->url($val['image'])}}"
                                                           target="_blank"><img
                                                                width="50px" height="50px"
                                                                src="{{Storage::disk('s3')->url($val['image'])}}"/><a
                                                                href="{{url('admin/products/product_images_delete/')}}/{{$val['id']}}/{{$id}}">Remove</a>
                                                            @endif
                                                            @else
                                                                @if($val['image']!='')
                                                                    <a href="/{{$val['image']}}" target="_blank"><img
                                                                            width="50px" height="50px"
                                                                            src="/{{$val['image']}}"
                                                                        /> <a
                                                                            href="{{url('admin/products/product_images_delete/')}}/{{$val['id']}}/{{$id}}">click
                                                                            remove</a></a>
                                                                @endif
                                                            @endif

                                                            @error('document')
                                                            <span style="color: red">{{$message}}</span>
                                                        @enderror
                                                        @endforeach
                                        </div>

                                    </div>

                                </div>


                                <input type="hidden" name="id" value="{{$id}}"/>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Save Changes</button>
                                    <a href="{{url('admin/brands')}}" class="btn btn-default float-right">Cancel</a>
                                </div>
                                <!-- /.card-footer -->
                            </form>

                            {{--<form action="{{ route("projects.store") }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                --}}{{-- Name/Description fields, irrelevant for this article --}}{{--

                                <div class="form-group">
                                    <label for="document">Documents</label>
                                    <div class="needsclick dropzone" id="document-dropzone">

                                    </div>
                                </div>
                                <div>
                                    <input class="btn btn-danger" type="submit">
                                </div>
                            </form>--}}
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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    {{-- ...Some more scripts... --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>

        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('product.storeMedia') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            },
            init: function () {
            }
        }

        var loop_count = 1;
        var loop_image_count = 1;

        function add_slab_module(name,loop_image_count) {
                loop_image_count++;
            console.log(name);
            var html = '<div  class="form-group row product_images_' + name + '_' + loop_image_count + '"><label for="inputEmail3"\n' +
                '                                                                   class="col-sm-2 col-form-label"></label>\n' +
                '                                                            <div class="col-sm-2">\n' +
                '                                                                <input type="text" class="form-control" id=""\n' +
                '                                                                       placeholder="Enter Qty"\n' +
                '                                                                       name="slabQty[' + name + '][]"\n' +
                '                                                                       >\n' +
                '                                                            </div>\n' +
                '                                                            <div class="col-sm-2">\n' +
                '                                                                <input type="text" class="form-control" id=""\n' +
                '                                                                       placeholder="Enter Price"\n' +
                '                                                                       name="slabPrice[' + name + '][]"\n' +
                '                                                                      ">\n' +
                '                                                            </div>\n' +
                '                                                            <div class="col-sm-2">\n' +
                '                                                                <input type="text" class="form-control" id=""\n' +
                '                                                                       name="slabMargin[' + name + '][]" placeholder="Enter Margin"\n' +
                '                                                                     >\n' +
                '                                                            </div>\n' +
                '                                                            <div class="col-sm-1">\n' +
                '                                                                <a class="btn btn-outline-danger btn-block" onclick=remove_image_more("' + loop_image_count + '","' + name + '")>\n' +
                '                                                                    <i class="fas fa-minus"></i>\n' +
                '                                                                </a>\n' +
                '                                                            </div>';
            //product_images_box

            jQuery('#product_images_box_' + name).append(html)
        }

        function remove_image_more(count, name) {
            console.log('.product_images_' + name + '_' + count)
            jQuery('.product_images_' + name + '_' + count).remove();
        }

        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
