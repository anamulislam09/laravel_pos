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
                        <div class="col-lg-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-sm-12">
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
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
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
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Product Name</label>
                                                <select name="product_id" id="product"
                                                    class="form-control @error('product_id') is-invalid @enderror">
                                                    <option value="" selected disabled>Select Once</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Product Quantity</label>
                                                <input type="text" name="product_quantity"
                                                    value="{{ old('product_quantity') }}" class="form-control"
                                                    id="product_quantity" placeholder="Enter Product quantity">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Product Quantity Per Rate</label>
                                                <input type="text" name="product_unit_per_rate"
                                                    value="{{ old('product_unit_per_rate') }}" class="form-control"
                                                    id="product_unit_per_rate" placeholder="Enter Rate Per quantity">
                                            </div>
                                        </div>
                                        <button type="button" style="width: 70px "
                                            class="btn btn-primary my-3 btn-sm align-self-end" id="btn-add">ADD</button>
                                    </div>
                                    <div class="row">

                                        {{-- <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Discount Rate</label>
                                                <input type="text" name="discount_rate"
                                                    value="{{ old('discount_rate') }}" class="form-control" id=""
                                                    placeholder="Enter Discount Rate">
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Paid Amount</label>
                                                <input type="text" name="paid" value="{{ old('paid') }}"
                                                    class="form-control" id="" placeholder="Enter Amount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card-body" id="table">
                <div class=" mt-3 ">

                    <strong class="m-auto">
                        <caption> Purchase Products</caption>
                    </strong>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody class="item-table">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
    {{-- get product from category wise using ajax  --}}
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

        });
    </script>

    <script type="text/javascript">
        function getAmount() {
            //     var qty = $('#product_quantity').val();
            //     var rate = $('#product_unit_per_rate').val();
            //     // var total = qty * rate;
            // $('#amount').val(qty * rate);
            // alert(total);

            //get the sum of each column of each row
            // var sum_value = 0;
            // $('.value').each(function() {
            //     sum_value += +$(this).val();
            //     $('#total_value').val(sum_value);
            // })

            // var sum_rate = 0;
            // $('.rate').each(function() {
            //     sum_rate += +$(this).val();
            //     $('#total_rate').val(sum_rate);
            // })

            // var sum_amount = 0;
            // $('.amount').each(function() {
            //     sum_amount += +$(this).val();
            //     $('#total_amount').val(sum_amount);
            // })
        }

        $('#btn-add').on('click', function() {
            var tbody = '';
            product = $('#product').val();
            qty = $('#product_quantity').val();
            qty_rate = $('#product_unit_per_rate').val();

            total = qty * qty_rate;
            // $('#amount').val(qty * rate);
            // discount_rate = $('#discount_rate').val();
            tbody += '<tr>'
            tbody += '<td class="serial"></td>'
            tbody += '<td>' + product + '</td>'
            tbody += '<td>' + qty + '</td>'
            tbody += '<td>' + qty_rate + '</td>'
            tbody += '<td>' + total + '</td>'
            tbody += '<input type="hidden" name="product[]" value="' + product + '" />'
            tbody += '<input type="hidden" name="qty[]" value="' + qty + '" />'
            tbody += '<input type="hidden" name="qty_rate[]" value="' + qty_rate + '" />'
            tbody += '<input type="hidden" name="amount[]" value="' + total + '" />'
            tbody += '</tr>'
            $('.item-table').append(tbody);
            setSerial();
            $('#product').val('');
            $('#product_quantity').val('');
            $('#product_unit_per_rate').val('');
        });

        function setSerial() {
            var i = 1;
            $('.serial').each(function(key, element) {
                $(element).html(i++);
            });
        }
    </script>
@endsection
