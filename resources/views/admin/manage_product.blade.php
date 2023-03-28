@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')
    <!-- page content -->
    <div class="right_col" role="main" style="min-height: 1197px;">
        <div>
            <div class="page-title">
                <div class="title_left">
                    <h3>Manage Product</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px">
                    <div class="x_panel">
                        <div class="x_content">
                            <br>
                            <form id="demo-form2" method="post" action="{{route('product.manage_product_process')}}"
                                  data-parsley-validate="" class="form-horizontal form-label-left"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Product Name<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="is_application_submitted" name="name"
                                               class="form-control col-md-7 col-xs-12"
                                               value="{{$name ? $name : old('name')}}" required>
                                        @error('name')
                                        <span style="color: red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Product Qty.<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="is_application_submitted" name="qty"
                                               class="form-control col-md-7 col-xs-12"
                                               value="{{$qty ? $qty : old('qty')}}" required>
                                        @error('qty')
                                        <span style="color: red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Product SKU<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="is_application_submitted" name="sku"
                                               class="form-control col-md-7 col-xs-12"
                                               value="{{$sku ? $sku : old('sku')}}" required>
                                        @error('sku')
                                        <span style="color: red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">MRP<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="is_application_submitted" name="mrp"
                                               class="form-control col-md-7 col-xs-12"
                                               value="{{$mrp ? $mrp : old('mrp')}}" required>
                                        @error('mrp')
                                        <span style="color: red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Price<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="is_application_submitted" name="price"
                                               class="form-control col-md-7 col-xs-12"
                                               value="{{$price ? $price : old('price')}}" required>
                                        @error('price')
                                        <span style="color: red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Brand<span
                                            class="required">*</span>
                                    </label>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select type="text" id="is_application_submitted" name="brand_id"
                                                class="form-control col-md-7 col-xs-12" required>
                                            @foreach($brands as $Key=>$brand)
                                                <option
                                                    value="{{$Key}}" {{$Key==$brand_id ? "selected" : ''}}>{{$brand}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Category<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select type="text" id="is_application_submitted" name="category_id"
                                                class="form-control col-md-7 col-xs-12" required>
                                            @foreach($categories as $Key=>$category)
                                                <option
                                                    value="{{$Key}}" {{$Key==$category_id  ? "selected" : ''}}>{{$category}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Key Highlight<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <textarea type="text" id="is_application_submitted" name="key_highlight"
                                                  class="ckeditor form-control col-md-7 col-xs-12"
                                        >{{$key_highlight}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Description<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <textarea type="text" id="is_application_submitted" name="description"
                                                  class="ckeditor form-control col-md-7 col-xs-12" required
                                        >{{$description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Specification<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <textarea type="text" id="is_application_submitted" name="specification"
                                                  class="ckeditor form-control col-md-7 col-xs-12"
                                        >{{$specification}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="legal_disclaimer">Legal Disclaimer<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <textarea type="text" id="legal_disclaimer" name="legal_disclaimer"
                                                  class="ckeditor form-control col-md-7 col-xs-12"
                                        >{{$legal_disclaimer}}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                     <div class="form-group">
                                         <div class="row" id="product_images_box">
                                             @php
                                                 $loop_count_num=1;
                                             @endphp
                                             @foreach($productImagesArr as $key=>$val)
                                                 @php
                                                     $loop_count_prev=$loop_count_num;
                                                 @endphp
                                                 <input id="piid" type="hidden" name="piid[]"
                                                        value="{{$val['id']}}">
                                                 <div class="col-md-4 product_images_{{$loop_count_num++}}">
                                                     <label for="images" class="control-label mb-1">
                                                         Image</label>
                                                     <input id="images" name="images[]" type="file"
                                                            class="form-control" aria-required="true"
                                                            aria-invalid="false">
                                                     @error('images')
                                                     <span style="color: red">{{$message}}</span>
                                                     @enderror
                                                     @if(env('APP_ENV') == 'production')
                                                         @if($val['image']!='' && Storage::disk('s3')->exists($val['image']))
                                                             <a href="/{{Storage::disk('s3')->url($val['image'])}}" target="_blank"><img
                                                                     width="100px" src="{{Storage::disk('s3')->url($val['image'])}}"/></a>
                                                         @endif
                                                     @else
                                                         @if($val['image']!='')
                                                             <a href="/{{$val['image']}}" target="_blank"><img
                                                                     width="100px" src="/{{$val['image']}}"/></a>
                                                         @endif
                                                     @endif
                                                 </div>

                                                 <div class="col-md-2">
                                                     <label for="images" class="control-label mb-1">
                                                         &nbsp;&nbsp;&nbsp;</label>

                                                     @if($loop_count_num==2)
                                                         <button type="button" class="btn btn-success btn-lg"
                                                                 onclick="add_image_more()">
                                                             <i class="fa fa-plus"></i>&nbsp; Add
                                                         </button>
                                                     @else
                                                         <a href="{{url('admin/products/product_images_delete/')}}/{{$val['id']}}/{{$id}}">
                                                             <button type="button" class="btn btn-danger btn-lg">
                                                                 <i class="fa fa-minus"></i>&nbsp; Remove
                                                             </button>
                                                         </a>
                                                     @endif
                                                 </div>
                                             @endforeach
                                         </div>
                                     </div>
                                 </div>--}}
                                <div id="product_images_box">
                                    @php
                                        $loop_count_num=1;
                                    @endphp
                                    @foreach($productImagesArr as $key=>$val)
                                        @php
                                            $loop_count_prev=$loop_count_num;
                                        @endphp
                                        <div class="form-group">
                                            <input id="piid" type="hidden" name="piid[]"
                                                   value="{{$val['id']}}">
                                            <div class="product_images_{{$loop_count_num++}}">
                                                <label for="images" class="control-label col-md-3 col-sm-3 col-xs-12">
                                                    Image</label>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <input id="images" name="images[]" type="file"
                                                           class="form-control" aria-required="true"
                                                           aria-invalid="false">
                                                </div>
                                                @error('images')
                                                <span style="color: red">{{$message}}</span>
                                                @enderror
                                                @if(env('APP_ENV') == 'production')
                                                    @if($val['image']!='' && Storage::disk('s3')->exists($val['image']))
                                                        <a href="/{{Storage::disk('s3')->url($val['image'])}}"
                                                           target="_blank"><img
                                                                width="100px"
                                                                src="{{Storage::disk('s3')->url($val['image'])}}"/></a>
                                                    @endif
                                                @else
                                                    @if($val['image']!='')
                                                        <a href="/{{$val['image']}}" target="_blank"><img
                                                                width="100px" src="/{{$val['image']}}"/></a>
                                                    @endif
                                                @endif
                                                <div class="col-md-2">
                                                    <label for="images" class="control-label mb-1">
                                                        &nbsp;&nbsp;&nbsp;</label>

                                                    @if($loop_count_num==2)
                                                        <button type="button" class="btn btn-success btn-lg"
                                                                onclick="add_image_more()">
                                                            <i class="fa fa-plus"></i>&nbsp; Add
                                                        </button>
                                                    @else
                                                        <a href="{{url('admin/products/product_images_delete/')}}/{{$val['id']}}/{{$id}}">
                                                            <button type="button" class="btn btn-danger btn-lg">
                                                                <i class="fa fa-minus"></i>&nbsp; Remove
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                </div>


                                {{--<div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                           for="Application Submitted">Product Image<span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" id="is_application_submitted" name="image"
                                               class="form-control col-md-7 col-xs-12">
                                        @if(env('APP_ENV') == 'production')
                                            @if (Storage::disk('s3')->exists($image))
                                                <img src="{{Storage::disk('s3')->url($image)}}" width="100px">
                                            @endif
                                        @else
                                            <img src="/{{$image }}" width="100px">
                                        @endif
                                        @error('image')
                                        <span style="color: red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>--}}

                                <input type="hidden" name="id" value="{{$id}}"/>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a class="btn btn-primary" href="{{url('admin/products')}}">Cancel</a>
                                        <button type="submit" class="btn btn-success">Save Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        var loop_count = 1;
        var loop_image_count = 1;

        function add_image_more() {
            loop_image_count++;
            console.log(loop_image_count);
            var html = '<div class="form-group product_images_' + loop_image_count + '"><input id="piid" type="hidden" name="piid[]" value=""><div><label for="images" class="control-label col-md-3 col-sm-3 col-xs-12"> Image</label><div class="col-md-3 col-sm-6 col-xs-12"><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div></div>';
            //product_images_box
            html += '<div class="col-md-2 product_images_' + loop_image_count + '""><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("' + loop_image_count + '")><i class="fa fa-minus"></i>&nbsp; Remove</button></div></div>';
            jQuery('#product_images_box').append(html)
        }

        function remove_image_more(count) {
            jQuery('.product_images_' + count).remove();
        }

        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });

    </script>
    <!-- /page content -->
@endsection
