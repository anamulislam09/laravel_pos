@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('product.create') }}">Home</a></li>
              <li class="breadcrumb-item active">Product List</li>
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
                        <h3 class="card-title">All Products</h3>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <a href="{{ route('product.create') }}" class="btn btn-light">Add new</a>
                    </div>
                </div>
            </div>
              <div class="row pt-2 pl-4">
                <div class="form-group col-2">
                  <label for="">Category</label>
                  <select class="form-control submitable" name="category_id" id="category_id">
                    <option value="" >All</option>
                    @foreach ($category as $row)
                      <option value="{{ $row->id }}">{{ $row->name }}</option>
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
          url: "{{ route('product.index') }}",
          data:function(e){
            e.category_id = $('#category_id').val();
            // e.brand_id = $('#brand_id').val();
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
            title: "Product_Name ",
            searchable: true
          },
          {
            data: "name",
            title: "Category_Name",
            searchable: true
          },
          {
            data: "quantity_status",
            "render": function(data, type, full, meta) {
              // return "<span class=\"" + data + "\" height=\"50\"/>";
              return "<span class=\"badge badge-warning\">"+ data + "</span>";
            },
            title: "Quantity Status",
            searchable: true
          },
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
      var url = "{{ url('product/active_status') }}/" + id;
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
      var url = "{{ url('/product/no_tactive_status') }}/" + id;
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