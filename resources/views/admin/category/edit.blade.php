<form action="#" method="post" enctype="multipart/form-data">
  @csrf


      {{-- <div class="form-group">
          <label for="">Brand Name <span class="text-danger">*</span></label>
          <select name="brand_id" id="" class="form-control">
            <option value="" selected disabled>Choose Brand</option>
              @foreach ($brand as $row)
              <option value="{{ $row->id }}">{{ $row->name }}</option>
              @endforeach
          </select>
      </div> --}}

      <div class="form-group">
          <label for="">Category Name <span class="text-danger">*</span></label>
          <input type="text" name="category_name" class="form-control" value="{{ $data->category_name }}">

      </div>

      <div class="row">
        <div class="form-group col-lg-6">
          <label for="exampleInputFile">Home Page<span class="text-danger">*</span></label>
          <select name="home_page" id="" class="form-control">
            <option value="" selected disabled>== Choose Options ==</option>
              <option value="1" @if($data->home_page==1) selected>Yes</option>
              <option value="0" @if($data->home_page==0) selected>No</option>
          </select>
        </div>
        
        <div class="form-group col-lg-6">
          <label for="exampleInputFile">Publication<span class="text-danger">*</span></label>
          <select name="category_status" id="" class="form-control ">
            <option value="" selected disabled>== Choose Options ==</option>
              
              <option value="1" @if($data->status==1) selected @endif >Yes</option>
              <option value="0" @if($data->status==0) selected @endif >No</option>
              
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="exampleInputFile">Category Image <span class="text-danger">*</span></label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="image"  class="custom-file-input" id="exampleInputFile" required>
            <input type="hidden" name="old_image"  id="exampleInputFile" value="{{ $data->image }}">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text">Upload</span>
          </div>
        </div>
      </div>
         
      <div class="card-footer">
          <button type="submit" class="btn btn-primary">Update Category</button>
      </div>
</form>