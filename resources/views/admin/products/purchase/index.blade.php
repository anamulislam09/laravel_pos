@extends('layouts.admin')

@section('admin_content')
    <style>
        #dataTable {
            font-size: 15px;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Purchases</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('purchase.create') }}">Home</a></li>
                            <li class="breadcrumb-item active">Purchase List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="  content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="row ">
                                    <div class="col-lg-10 col-sm-12 pt-2">
                                        <h3 class="card-title">All Purchase</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <a href="{{ route('purchase.create') }}" class="btn btn-light">Add new</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2 pl-4">
                                <div class="form-group col-4">
                                    <label for="">Category</label>
                                    <select class="form-control submitable" name="category_id" id="category_id">
                                        <option value="">All</option>
                                        @foreach ($category as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="">Supplier</label>
                                    <select class="form-control submitable" name="supplier_id" id="supplier_id">
                                        <option value="">All</option>
                                        @foreach ($supplier as $row)
                                            <option value="{{ $row->id }}">{{ $row->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="dataTable" class="table table-bordered table-striped">

                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Datatable start here --}}
    <script>
        $(document).ready(function() {
            let table = $('#dataTable').DataTable({
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                searching: true,
                ajax: {
                    url: "{{ route('purchase.index') }}",
                    data: function(e) {
                        e.category_id = $('#category_id').val();
                        e.supplier_id = $('#supplier_id').val();
                        // e.warehouse_id = $('#warehouse_id').val();
                        e.status = $('#status').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        title: "SL",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "product_name",
                        title: "Product Name",
                        searchable: true
                    },
                    {
                        data: "product_quantity",
                        title: "Quantity",
                        searchable: true
                    },
                    {
                        data: "product_unit_per_rate",
                        title: "Unit Rate",
                        searchable: true
                    },
                    {
                        data: "total_price_without_discount",
                        title: "Amount",
                        searchable: true
                    },
                    {
                        data: "discount",
                        title: "Discount Rate",
                        searchable: true
                    },
                    {
                        data: "discount_price",
                        title: "Discount Price",
                        searchable: true
                    },
                    {
                        data: "total_price_after_discount",
                        title: "Amount After Discount",
                        searchable: true
                    },
                    {
                        data: "paid",
                        title: "Paid",
                        searchable: true
                    },
                    {
                        data: "due",
                        title: "Due",
                        searchable: true
                    },
                    // {
                    //     data: "date",
                    //     // data: "month /",
                    //     // data: "year",
                    //     "render": function(data, type, full, meta) {
                    //         // return "<span class=\"" + data + "\" height=\"50\"/>";
                    //         return "<span>" + data + "</span>";
                    //     },
                    //     title: "Date",
                    //     searchable: true
                    // },
                    {
                        data: "action",
                        title: "action",
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        })

        // {{-- status ajax stert here --}}
        //   {{-- active_status --}}
        $('body').on('click', '.active_status', function() {
            let id = $(this).data('id');
            var url = "{{ url('purchase/active_status') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    // alert(data);
                    toastr.success(data);
                    window.location.reload()
                }
            })
        })

        // {{--  deactive_status --}}
        $('body').on('click', '.deactive_status', function() {
            let id = $(this).data('id');
            // alert(id);
            var url = "{{ url('/purchase/no_tactive_status') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    toastr.success(data);
                    window.location.reload()
                }
            })
        })
        // {{-- status ajax ends here --}}

        // submittable class call for evere change
        $(document).on('change', '.submitable', function() {
            $('#dataTable').DataTable().ajax.reload();
        })
    </script>
@endsection
