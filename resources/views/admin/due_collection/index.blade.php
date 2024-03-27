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
                        <h1> All Collections</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Collection List</li>
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
                                        <h3 class="card-title">All Due Collections</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <a href="{{ route('collections.create') }}" class="btn btn-light">Add new</a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row pt-2 pl-4">
                                <div class="form-group col-4">
                                    <label for="">Supplier</label>
                                    <select class="form-control submitable" name="supplier_id" id="supplier_id">
                                        <option value="">All</option>
                                        @foreach ($collections as $row)
                                            <option value="{{ $row->id }}">{{ $row->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User Name</th>
                                            <th class="d-none">User Phone</th>
                                            <th class="d-none">User ID</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Created By</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($collections as $key => $item)
                                            @php
                                                $user = DB::table('users')
                                                    ->where('customer_id', Auth::guard('admin')->user()->id)
                                                    ->where('user_id', $item->user_id)
                                                    ->first();
                                                $createdBy = DB::table('customers')
                                                    ->where('id', $item->auth_id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $item->invoice_id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td class="d-none">{{ $user->phone }}</td>
                                                <td class="d-none">{{ $user->user_id }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->date }}/{{ $item->month }}/{{ $item->year }}</td>
                                                <td>{{ $createdBy->name }}</td>
                                                <td>
                                                    <a href="{{ route('sales.update', $item->invoice_id) }}"
                                                        class="btn btn-sm btn-info"><i class="fas fa-book"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach

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
@endsection
