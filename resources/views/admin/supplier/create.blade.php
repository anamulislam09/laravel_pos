@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Suppliers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Supplier</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- form start -->
                <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header ">
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-12 pt-2">
                                            <h3 class="card-title">Add New Produst</h3>
                                        </div> 
                                        <div class="col-lg-2 col-sm-12">
                                            <a href="{{ route('supplier.index') }}" class="btn btn-light text-dark">See all</a>
                                        </div> 
                                    </div>
                                </div>
                               
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- general form elements -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Supplier Name</label>
                                                <input type="text" name="supplier_name" class="form-control"
                                                    value="{{ old('supplier_name') }}" id=""
                                                    placeholder="Enter supplier name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Supplier Contract Number</label>
                                                <input type="text" name="phone" value="{{ old('phone') }}"
                                                    class="form-control" id="" placeholder="Enter phone number">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Supplier Email</label>
                                                <input type="email" class="form-control" value="{{ old('email') }}"
                                                    name="email" id="exampleInputEmail1" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Supplier Address</label>
                                                <input type="text" class="form-control" value="{{ old('address') }}"
                                                    name="address" id="" placeholder="Enter address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
