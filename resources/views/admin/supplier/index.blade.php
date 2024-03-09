@extends('layouts.admin')

@section('admin_content')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" /> --}}
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 mb-2">
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
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="row ">
                                    <div class="col-lg-10 col-sm-12 pt-2">
                                        <h3 class="card-title">All Suppliers</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <a href="{{ route('supplier.create') }}" class="btn btn-light">Add new</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="8%">SL</th>
                                            <th width="17%">Supplier Name</th>
                                            <th width="15%"> Phone</th>
                                            <th width="15%"> Email</th>
                                            <th width="15%"> Address</th>
                                            <th width="15%"> Created Date</th>
                                            <th width="15%" class="text-center"> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{$item->supplier_name}}</td>
                                                <td>{{$item->phone}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->address}}</td>
                                                <td>{{$item->date}}/
                                                  @if ($item->month == 1)
                                                  January
                                              @elseif ($item->month == 2)
                                                  February
                                              @elseif ($item->month == 3)
                                                  March
                                              @elseif ($item->month == 4)
                                                  April
                                              @elseif ($item->month == 5)
                                                  May
                                              @elseif ($item->month == 6)
                                                  June
                                              @elseif ($item->month == 7)
                                                  July
                                              @elseif ($item->month == 8)
                                                  August
                                              @elseif ($item->month == 9)
                                                  September
                                              @elseif ($item->month == 10)
                                                  October
                                              @elseif ($item->month == 11)
                                                  November
                                              @elseif ($item->month == 12)
                                                  December
                                              @endif / {{$item->year}}
                                                </td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-sm btn-info edit" data-id="{{$item->id}}" data-toggle="modal" data-target="#editUser"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('supplier.delete', $item->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
  <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Supplier </h5>
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
   <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <script>
$('body').on('click', '.edit', function(){
  let user_id = $(this).data('id');
  $.get("suppliers/edit/"+user_id,function(data){
    $('#modal_body').html(data);
    
  })
})

  </script>
@endsection