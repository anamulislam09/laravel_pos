<form action="{{route('category.update')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="modal-body">
        
        <div class="mb-3 mt-3">
            <label for="name" class="form-label"> Category Name :</label>
           <input type="text" class="form-control" value="{{ $data->name }}" name="name">
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>