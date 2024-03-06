@extends('layouts.admin')

@section('admin_content')
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
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
                                    <div class="col-lg-8 col-sm-12">
                                        <h3 class="card-title">All Users</h3>
                                    </div>
                                    {{-- @php
                                        $isExist = DB::table('users')
                                            ->where('customer_id', Auth::guard('admin')->user()->id)
                                            ->first();
                                        $flat = DB::table('flats')
                                            ->where('customer_id', Auth::guard('admin')->user()->id)
                                            ->where('status', 0)
                                            ->first();
                                    @endphp
                                    @if ($flat)
                                        <div class="col-lg-2 col-sm-6">
                                            <a href="{{ !$isExist ? 'javascript:void(0)' : route('user.create') }} "
                                                class="btn btn-sm btn-outline-primary">Add
                                                New User</a>
                                        </div>
                                    @elseif (!$flat)
                                        <div class="col-lg-2 col-sm-6">
                                            <a href="" class="btn btn-sm btn-outline-primary disabled">Add
                                                New User</a>
                                        </div>
                                    @endif
                                    <div class="col-lg-2 col-sm-12">
                                        <a href="{{ !$isExist ? route('users.create') : 'javascript:void(0)' }}"
                                            class="btn btn-sm btn-outline-primary">User Manage</a>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Id</th>
                                        {{-- <th width="10%">Customer_Id</th> --}}
                                        <th>User Name</th>
                                        <th>Flat_Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>NID</th>
                                        <th>Status</th>
                                        {{-- <th>Role_id</th> --}}
                                        <th> Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        @php
                                            $flat = DB::table('flats')->where('customer_id', Auth::guard('admin')->user()->id)
                                                ->where('flat_unique_id', $item->flat_id)
                                                ->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $item->user_id }}</td>
                                            <td>{{ $item->name }}</td>
                                            @if (!empty($flat))
                                            <td>{{ $flat->flat_name }}</td>
                                            @else
                                            <td>Undefine</td>
                                            @endif
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->nid_no }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <span class="badge badge-danger">Deactive</span>
                                                @else
                                                    <span class="badge badge-primary">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-info edit"
                                                    data-id="{{ $item->id }}" data-toggle="modal"
                                                    data-target="#editUser"><i class="fas fa-edit"></i></a>
                                                {{-- <a href="{{ route('user.delete', $item->id) }}"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> --}}
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

    {{-- category edit model --}}
    <!-- Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit USer </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="modal_body">

                </div>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
    <script>
        $('body').on('click', '.edit', function() {
            let user_id = $(this).data('id');
            $.get("/admin/users/edit/" + user_id, function(data) {
                $('#modal_body').html(data);

            })
        })
    </script>
@endsection
