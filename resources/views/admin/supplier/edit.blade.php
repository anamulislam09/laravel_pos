<form action="{{ route('supplier.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="modal-body">

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Supplier Name</label>
                        <input type="text" name="supplier_name" class="form-control"
                            value="{{ $data->supplier_name }}" id="" placeholder="Enter supplier name"
                            required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Supplier Contract Number</label>
                        <input type="text" name="phone" value="{{ $data->phone }}" class="form-control"
                            id="" placeholder="Enter phone number">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Supplier Email</label>
                        <input type="email" class="form-control" value="{{ $data->email }}" name="email"
                            id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Supplier Address</label>
                        <input type="text" class="form-control" value="{{ $data->address }}" name="address"
                            id="" placeholder="Enter address">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
