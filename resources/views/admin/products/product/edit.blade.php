@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <style>
        .bootstrap-tagsinput .tag {
            background: #428bca;
            border: 1px solid white;
            padding: 1.6px;
            padding-left: 2px;
            margin-right: 2px;
            color: white;
            border-radius: 4px
        }

        .img {
            font-size: 16px !important;
        }
    </style>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 pt-2">
                                    <h3 class="card-title">Produst Edit Form</h3>
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                    <a href="{{ route('product.index') }}" class="btn btn-light text-dark">Cancel Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- left column -->

                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="card ">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- general form elements -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product Name</label>
                                                <input type="text" name="product_name" class="form-control"
                                                    value="{{ $product->product_name }} " id=""
                                                    placeholder="Enter Product name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Product Unit</label>
                                                <input type="text" name="product_unit"
                                                    value="{{ $product->product_unit }}" class="form-control" id=""
                                                    placeholder="Enter Product Unit">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Category</label>
                                                <select name="category_id" id="category"
                                                    class="form-control @error('subcategory_id') is-invalid @enderror">
                                                    <option value="" selected disabled>Select Once</option>
                                                    @foreach ($cats as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            @if ($product->category_id == $cat->id) selected @endif>
                                                            {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1"> Supplier</label>
                                          <select name="warehouse" id="" class="form-control">
                                              <option value="" selected disabled>Selecte once</option>
                                              @foreach ($warehouses as $warehouse)
                                                  <option value="{{ $warehouse->id }}">
                                                      {{ $warehouse->warehouse_name }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div> --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Purchase Price</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $product->purchase_price }}" name="purchase_price"
                                                    id="exampleInputEmail1" placeholder="Enter purchase_price">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Selling Price</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $product->selling_price }}" name="selling_price"
                                                    id="exampleInputEmail1" placeholder="Enter selling_price">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Discount Price</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $product->descount_price }}" name="descount_price"
                                                    id="" placeholder="Enter descount_price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <!-- Form Element sizes -->
                            <div class="card card-success pb-5">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Supplier</label>
                                            <select name="supplier_id" id="supplier_id"
                                                class="form-control @error('supplier_id') is-invalid @enderror">
                                                <option value="" selected disabled>Select Once</option>
                                                @foreach ($supplier as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($product->supplier_id == $item->id) selected @endif>
                                                        {{ $item->supplier_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="thumbnail">Main Thumbnail <span class="text-danger">*</span></label><br>
                                        <input type="file" class="dropify img" name="product_thumbnail"
                                            value="{{ $product->product_thumbnail }}" accept="image/*">
                                        <input type="hidden" name="old_image"
                                            value="{{ $product->product_thumbnail }}">
                                        <div class="mt-4 ml-4">
                                            <img src="{{ asset($product->product_thumbnail) }}" style="width: 80px "
                                                alt="{{ $product->product_thumbnail }}">
                                        </div>
                                    </div> <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

            </div>
            </form>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
    <script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>

    {{-- CHECKBOX  --}}
    <script>
        $('.dropify').dropify(); //dropify image 
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endsection
