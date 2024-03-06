@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Admin Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
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
              <div class="card-header">
                <h3 class="card-title">All Brand list here</h3>
                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary create" style="float:right">Add
                  New</a>
              </div>
              <div class="row pt-2 pl-4">
                <div class="form-group col-2">
                  <label for="">Category</label>
                  <select class="form-control submitable" name="category_id" id="category_id">
                    <option value="" >All</option>
                    @foreach ($category as $row)
                      <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-2">
                  <label for="">Brand</label>
                  <select class="form-control submitable" name="brand_id" id="brand_id">
                    <option value="" >All </option>
                    @foreach ($brand as $row)
                      <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-2">
                  <label for="">Warehousse</label>
                  <select class="form-control submitable" name="warehouse_id" id="warehouse_id">
                    <option value="">All </option>
                    @foreach ($warehouse as $row)
                      <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-2">
                  <label for="">Status</label>
                  <select class="form-control submitable" name="status" id="status">
                    <option value="1" selected >All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
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

  {{-- childcategory edit model --}}
  <!-- Modal -->
  {{-- <div class="modal fade" id="editbrandModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Brand </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <form action="{{ route('update.brand') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="e_brand_id">
            <div class="mb-3 mt-3">
              <label for="brand_name" class="form-label">Brand Name:</label>
              <input type="text" class="form-control" value="{{ old('brand_name') }}" name="brand_name"
                id="e_brand_name">
            </div>
            @error('brand_name')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>

      </div>
    </div>
  </div> --}}

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
            e.brand_id = $('#brand_id').val();
            e.warehouse_id = $('#warehouse_id').val();
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
            title: "product_name ",
            searchable: true
          },
          // show image using yajra datatable
          {
            "name": "product_thumbnail",
            "data": "product_thumbnail",
            "render": function(data, type, full, meta) {
              return "<img src=\"" + data + "\" height=\"50\"/>";
            },
            "title": "Thumbnail",
            "orderable": true,
            "searchable": true

          },
          {
            data: "product_code",
            title: "Code",
            searchable: true
          },
          {
            data: "category_name",
            title: "Category",
            searchable: true
          },
          {
            data: "subcategory_name",
            title: "Subcategory",
            searchable: true
          },
          {
            data: "brand_name",
            title: "Brand",
            searchable: true
          },
          {
            data: "featured",
            title: "featured",
            searchable: true
          },
          {
            data: "today_deal",
            title: "Today deal",
            searchable: true
          },
          {
            data: "status",
            title: "status",
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
    // {{-- featured ajax stert here --}}
    //   {{-- active featured --}}

    $('body').on('click', '.active_featured', function() {
      let id = $(this).data('id');
      var url = "{{ url('product/active-featured') }}/" + id;

      $.ajax({
        url: url,
        type: 'get',
        success: function(data) {
          toastr.success(data);
          window.location.reload()

        }
      })
    })


    // {{-- deactive featured --}}

    $('body').on('click', '.deactive_featured', function() {
      let id = $(this).data('id');
      var url = "{{ url('/product/not-featured') }}/" + id;
      $.ajax({
        url: url,
        type: 'get',
        success: function(data) {
          toastr.success(data);
          window.location.reload()

        }
      })
    })
    // {{-- featured ajax ends here --}}

    // {{-- active-today-deal ajax stert here --}}
    //   {{-- active_todayDeal --}}
    $('body').on('click', '.active_todayDeal', function() {
      let id = $(this).data('id');
      var url = "{{ url('product/active_today_deal') }}/" + id;
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

    // {{--  deactive_todayDeal --}}
    $('body').on('click', '.deactive_todayDeal', function() {
      let id = $(this).data('id');
      // alert(id);
      var url = "{{ url('/product/not_today_dea') }}/" + id;
      $.ajax({
        url: url,
        type: 'get',
        success: function(data) {
          toastr.success(data);
          window.location.reload()
        }
      })
    })
    // {{-- active-today-deal ajax ends here --}}

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