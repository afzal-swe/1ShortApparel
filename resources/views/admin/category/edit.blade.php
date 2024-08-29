

@extends('admin.layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Table</h1>
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
                          <h3 class="card-title">Category Modify</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Update Category</h4>
                                  <a href="{{ route('category.index') }}" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </a>
                                </div>
                                <div class="modal-body">
                                  <form action="{{ route('category.update.form',$edit->id) }}" method="Post" enctype="multipart/form-data">
                                    @csrf
                                    
                                   
                                  
                                    <div class="form-group">
                                      <label for="">Brand Name</label>
                                      <select name="brand_id" class="form-control">
                                          @foreach ($brand as $row)
                                          <option value="{{ $row->id }}">{{ $row->name }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="">Category Name</label>
                                      <input type="text" name="category_name" class="form-control" value="{{ $edit->category_name }}">
                                  </div>
                                  
                                  <div class="row">
                                    <div class="form-group col-lg-6">
                                      <label for="exampleInputFile">Home Page</label>
                                      <select name="home_page" id="" class="form-control">
                                          <option value="1" @if ($edit->home_page=="1") selected @endif>Yes</option>
                                          <option value="0" @if ($edit->home_page=="0") selected @endif>No</option>
                                      </select>
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                      <label for="exampleInputFile">Publication<span class="text-danger">*</span></label>
                                      <select name="category_status" class="form-control">
                                       
                                          <option value="1" @if ($edit->category_status=="1") selected @endif>Yes</option>
                                          <option value="0" @if ($edit->category_status=="0") selected @endif>No</option>
                                          
                                      </select>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="exampleInputFile">Category Image <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <input type="file" name="image"  class="custom-file-input">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                      </div>
                                      <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                      </div>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group bt-1">
                                    
                                    <div class="input-group">
                                      <div class="custom-file">
                                        <img src="{{ asset($edit->image) }}" alt="" style="height: 50px; width:70px;">
                                      </div>
                                      
                                    </div>
                                  </div>
                                  
                                  
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  <button type="Submit" class="btn btn-primary">Update</button>
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

    
@endsection
