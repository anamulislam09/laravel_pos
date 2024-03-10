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
                        <h1>Purchase</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Purchase</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form action="{{ route('purchase.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 pt-2">
                                    <h3 class="card-title">Purchase Edit Form</h3>
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                    <a href="{{ route('purchase.index') }}" class="btn btn-light text-dark">Cancel Edit</a>
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
                                                    value="{{ $purchase->product_name }}" id=""
                                                    placeholder="Enter Product name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product Code</label>
                                                <input type="text" name="product_code" class="form-control"
                                                    value="{{ $purchase->product_code }}" id=""
                                                    placeholder="Enter Product Code" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Category</label>
                                                <select name="category_id" id="category"
                                                    class="form-control @error('subcategory_id') is-invalid @enderror">
                                                    <option value="" selected disabled>Select Once</option>
                                                    @foreach ($cats as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Supplier</label>
                                                <select name="supplier_id" id="supplier_id"
                                                    class="form-control @error('supplier_id') is-invalid @enderror">
                                                    <option value="" selected disabled>Select Once</option>
                                                    @foreach ($supplier as $item)
                                                        <option value="{{ $item->id }}">{{ $item->supplier_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <!-- Form Element sizes -->
                            <div class="card card-success">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Product Unit</label>
                                            <input type="text" name="product_unit" value="{{ $purchase->product_unit }}"
                                                class="form-control" id="" placeholder="Enter Product Unit">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Rate Per Unit</label>
                                            <input type="text" name="product_unit_per_rate"
                                                value="{{ $purchase->product_unit_per_rate }}" class="form-control"
                                                id="" placeholder="Enter Product_unit_per_rate">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Purchase discount</label>
                                            <input type="text" name="discount_rate" value="{{ $purchase->discount_rate }}"
                                                class="form-control" id="" placeholder="Enter discount_rate">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Purchase paid</label>
                                            <input type="text" class="form-control" value="{{ $purchase->paid }}"
                                                name="paid" id="exampleInputEmail1" placeholder="Enter paid amount">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group py-3">
                                        <label for="thumbnail">Main Thumbnail <span
                                                class="text-danger">*</span></label><br>
                                        <input type="file" class="dropify img" name="product_thumbnail"
                                            accept="image/*">
                                    </div> <br> --}}
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- /.card -->
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
