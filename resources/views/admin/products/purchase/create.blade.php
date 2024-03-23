@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css"
        integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <h1>Purchases</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Purchase</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-primary">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 pt-2">
                                    <h3 class="card-title">Add New Purchase</h3>
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                    <a href="{{ route('purchase.index') }}" class="btn btn-light text-dark">See all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- left column -->
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Category</label>
                                                <select name="category_id" id="category"
                                                    class="form-control @error('category_id') is-invalid @enderror">
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
                                                <label for="exampleInputEmail1">Product Name</label>
                                                <select name="product_id" id="product"
                                                    class="form-control @error('product_id') is-invalid @enderror" required>
                                                    <option value="" selected disabled>Select Once</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Product Quantity</label>
                                                <input type="text" name="product_quantity"
                                                    value="{{ old('product_quantity') }}" class="form-control"
                                                    id="" placeholder="Enter Product quantity">
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Product Quantity Per Rate</label>
                                                <input type="text" name="product_unit_per_rate"
                                                    value="{{ old('product_unit_per_rate') }}" class="form-control" id=""
                                                    placeholder="Enter Rate Per quantity">
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
                                            <label for="exampleInputPassword1">Discount Rate</label>
                                            <input type="text" name="product_unit_per_rate"
                                                value="{{ old('product_unit_per_rate') }}" class="form-control"
                                                id="" placeholder="Enter Discount Rate">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Paid Amount</label>
                                            <input type="text" name="paid" value="{{ old('paid') }}"
                                                class="form-control" id="" placeholder="Enter Amount">
                                        </div>
                                    </div>
                                    <div class="form-group pt-2">
                                        <label for="thumbnail">Main Thumbnail <span
                                                class="text-danger">*</span></label><br>
                                        <input type="file" class="dropify img" name="product_thumbnail"
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </div>
            </form>
        </section>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>

    {{-- CHECKBOX  --}}
    <script>
        $('.dropify').dropify(); //dropify image 
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>

    {{-- Add more inmage upoad  --}}
    <script>
        $(document).ready(function() {
            var postURL = "<?php echo url('addmore'); ?>";
            var i = 1;

            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i +
                    '" class="dynamic-added"> <td><input type="file" name="images[]" class="form-control name_list" accept="image/*"></td> <td><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr('id');
                $("#row" + button_id + '').remove();
            });
        });
    </script>

    <script>
        // from submit loading
        $('#add-form').on('submit', function() {
            $('.loader').removeClass('d-none');
            $('.submit_btn').addClass('d-none');
        })
    </script>

    {{-- create child category using ajax  --}}
    <script>
        $(document).ready(function() {
            // get subcategory 
            $("#category").change(function() {
                let categoryid = $(this).val();
                $("#product").html('<option value="">Select One</option>')
                $.ajax({
                    url: '/admin/product',
                    type: 'post',
                    data: 'categoryid=' + categoryid + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        $('#product').html(result);
                    }
                })
            })
            //   get childcategory 
            // $("#subcategory").change(function() {
            //     let childCatId = $(this).val();
            //     $("#childcategory").html('<option value="">Select One</option>')
            //     $.ajax({
            //         url: '/product/childcategory',
            //         type: 'post',
            //         data: 'childCatid=' + childCatId + '&_token={{ csrf_token() }}',
            //         success: function(result) {
            //             console.log(result);

            //             $('#childcategory').html(result);
            //         }
            //     })
            // })


        });
    </script>
@endsection
