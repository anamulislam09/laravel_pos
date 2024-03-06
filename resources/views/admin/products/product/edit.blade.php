@extends('layouts.admin')

@section('admin_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .bootstrap-tagsinput .tag {
      background: #428bca;
      border: 1ps solid white;
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
            <h1>Admin Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="card-header pr-5">
      <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary" style="float:right">product list</a>
  </div>
  <!-- /.card-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- form start -->
        <form action="{{route('store.product')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Produst</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <!-- general form elements -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" name="product_name" class="form-control" value="{{$product->product_name}}" id="" placeholder="Enter Product name" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product code</label>
                        <input type="text" name="product_code" value="{{$product->product_code}}" class="form-control" id="" placeholder="Enter Product code" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> Category</label>
                        <select name="category_id" id="category"
                          class="form-control @error('subcategory_id') is-invalid @enderror" required>
                          <option value="" selected disabled>Select Once</option>
                          @foreach ($cats as $cat)
                            <option value="{{ $cat->id }}" @if ($cat->id == $product->category_id) selected @endif >{{ $cat->category_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Subcategory</label>
                        <select name="subcategory_id" id="subcategory"
                          class="form-control @error('subcategory_id') is-invalid @enderror"required>
                          <option value="" selected disabled>Select Once</option>
                          {{-- @foreach ($subcats as $subcat)
                        <option value="{{ $subcat->id }}">{{ $subcat->subcategory_name }}</option>
                      @endforeach     --}}
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> ChildCategory</label>
                        <select name="childcategory_id" id="childcategory"
                          class="form-control @error('childcategory_id') is-invalid @enderror">
                          <option value="" selected disabled>Select Once</option>
                          {{-- @foreach ($childcats as $childcat)
                            <option value="{{ $childcat->id }}">{{ $childcat->childcategory_name }}</option>
                          @endforeach --}}
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Brand</label>
                        <select name="brand_id" id="" class="form-control">
                          <option value="" selected disabled>Selecte once</option>
                          @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" @if ($brand->id == $product->brand_id) selected @endif>{{ $brand->brand_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> Pickup Point</label>
                        <select name="pickup_point_id" id="" class="form-control">
                          <option value="" selected disabled>Selecte once</option>
                          @foreach ($pic_poines as $pic_poine)
                            <option value="{{ $pic_poine->id }}" @if ($pic_poine->id == $product->pickup_point_id) selected @endif>{{ $pic_poine->pickup_point_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product Unit</label>
                         <input type="text" class="form-control" name="product_unit" value="{{$product->product_unit}}" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Purchase Price</label>
                        <input type="text" class="form-control" value="{{$product->purchase_price}}" name="purchase_price"  >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Seling Price</label>
                        <input type="text" class="form-control" value="{{$product->selling_price}}" name="selling_price" id="" >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Discount Price</label>
                        <input type="text" class="form-control" value="{{$product->descount_price}}" name="descount_price" id="" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> Warehouse</label>
                        <select name="warehouse" id="" class="form-control">
                          <option value="" selected disabled>Selecte once</option>
                          @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" @if ($warehouse->id==$product->warehouse) selected @endif>{{ $warehouse->warehouse_name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Stock</label>
                        <input type="text" class="form-control" id="" value="{{$product->stock_quantity}}" name="stock_quantity" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tags</label>
                        <input type="text" name="product_tags" value="{{$product->product_tags}}" data-role="tagsinput" class="form-control" id="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1"> color</label>
                        <input type="text" name="product_color" value="{{$product->product_color}}" data-role="tagsinput" class="form-control" id="" >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Product size</label>
                        <input type="text" class="form-control" id="" data-role="tagsinput" value="{{$product->product_size}}" name="product_size">
                      </div>
                    </div>
                  </div>

                  <div class="mb-3 mt-3">
                    <label for="product_details" class="form-label">Product details:</label>
                    <textarea name="product_description" id="summernote" class="form-control">{{$product->product_description}}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Video embade code</label>
                    <textarea name="product_video" class="form-control" >{{$product->product_video}}</textarea>
                  </div>

                  {{-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                          </div> --}}
                  <!-- /.card-body -->
                </div>

              </div>
            </div>

            <!--/form left ends here-->

            <!-- right column -->
            <div class="col-md-4">
              <!-- Form Element sizes -->
              <div class="card card-success">
                <div class="card-header">
                  {{-- <h3 class="card-title">Different Height</h3> --}}
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="thumbnail">Main Thumbnail <span class="text-danger">*</span></label><br>
                    <input type="file" class="dropify img" name="product_thumbnail" accept="image/*" required>
                  </div> <br>

                  <div class="">
                    <table class="table table-bordered" id="dynamic_field">
                      <div class="card-header">
                        <h3 class="card-title">More Images (Click Add For More Image)</h3>
                      </div>
                      <tr>
                        <td><input type="file" name="images[]" class="form-control name_list"></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add</button>
                        </td>
                      </tr>
                    </table>
                  </div>

                  <div class="card p-4">
                    <h6>Featured Product</h6>
                    <input type="checkbox" name="featured" value="1" @if ($product->featured==1) checked @endif  data-bootstrap-switch
                      data-off-color="danger" data-on-color="success">
                  </div>

                  <div class="card p-4">
                    <h6> Today Deal</h6>
                    <input type="checkbox" name="today_deal" value="1" @if ($product->today_deal==1) checked @endif data-bootstrap-switch data-off-color="danger"
                      data-on-color="success">
                  </div>

                  <div class="card p-4">
                    <h6> Slider Product </h6>
                    <input type="checkbox" name="product_slider" value="1" @if ($product->product_slider==1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                  </div>
                  
                  <div class="card p-4">
                    <h6> Status</h6>
                    <input type="checkbox" name="status" value="1" @if ($product->status==1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                  </div>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- /.card -->
            </div>
            <!--/.col (right) -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

          </div>
        </form>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
  <script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>

  {{-- CHECKBOX  --}}
  <script>
    $('.dropify').dropify(); //dropify image 
    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  </script>

  {{-- Add more inage upoad  --}}
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
        $("#subcategory").html('<option value="">Select One</option>')
        $.ajax({
          url: '/product/subcategory',
          type: 'post',
          data: 'categoryid=' + categoryid + '&_token={{ csrf_token() }}',
          success: function(result) {
            $('#subcategory').html(result);
          }
        })
      })
    //   get childcategory 
      $("#subcategory").change(function() {
        let childCatId = $(this).val();
        $("#childcategory").html('<option value="">Select One</option>')
        $.ajax({
          url: '/product/childcategory',
          type: 'post',
          data: 'childCatid=' + childCatId + '&_token={{ csrf_token() }}',
          success: function(result) {
            console.log(result);

            $('#childcategory').html(result);
          }
        })
      })


    });
  </script>
@endsection