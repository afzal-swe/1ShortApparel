
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Category Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><- Go To Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                        <div class="card-header">
                          <h3 class="card-title">Sub Category Modify</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Update Sub Category</h4>
                                  <a href="{{ route('subcategory.index') }}" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </a>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('subcategory.update',$edit->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                    
                                        <div class="card-body">
                    
                                            <div class="form-group">
                                                <label for="">Brand Name</label>
                                                <select name="brand_id" id="" class="form-control" >
                                                    <option value="" selected disabled>Choose Brand</option>
                                                    @foreach ($brand as $row)
                                                    <option value="{{ $row->id }}" <?php if($row->id == $edit->brand_id) { echo "selected"; }?>>{{ $row->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Category Name</label>
                                                <select name="category_id" id="" class="form-control" >
                                                    <option value="" selected disabled>Choose Brand</option>
                                                    @foreach ($category as $row)
                                                    <option value="{{ $row->id }}" <?php if($row->id == $edit->category_id) { echo "selected"; }?>>{{ $row->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Sub Category Name</label>
                                                <input type="text" name="subcategory_name" class="form-control" value="{{ $edit->subcategory_name }}" required>
                                            </div>
                    
                                            <div class="form-group">
                                                <label for="">Sub Category Image</label>
                                                <input type="file" name="image" class="form-control" >
                                            </div>
        
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                              </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div>
    </section>
  </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
@endsection