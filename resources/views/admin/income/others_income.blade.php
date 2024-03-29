@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-10 col-sm-12">
                                        <h3 class="card-title"> Others Income Entry Form</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        {{-- <a href="{{route('flat.index')}}" class="btn btn-sm btn-outline-primary">All Flats</a> --}}
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                               <div class="row py-5">
                                <div class="col-10 m-auto border p-5">
                                    <form action="{{ route('others.income.store') }}" method="POST">
                                        @csrf
                                            <div class=" form-group">
                                                <label for="floor" class="">Income Info :</label>
                                                <input type="text" class="form-control" value="" name="income_info"
                                                    id="income_info" placeholder="Enter income info" required>
                                            </div>
                                            <div class=" form-group">
                                                <label for="floor" class="">Amount :</label>
                                                <input type="text" class="form-control" value="" name="amount"
                                                    id="amount" placeholder="Enter income amount" required>
                                            </div>
                                            
                                            <div class="">
                                                <button type="submit" class="btn btn-primary btn-end"
                                                    id="generate">Create</button>
                                            </div>
                                    </form>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
