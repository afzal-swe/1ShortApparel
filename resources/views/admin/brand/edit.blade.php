
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand Table</h1>
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
                          <h3 class="card-title">Brand Modify</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Update Brand</h4>
                                  <a href="{{ route('brand.index') }}" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    
                                    <span aria-hidden="true">&times;</span>
                                  </a>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('brand.update',$edit->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                    
                                        <div class="card-body">
                    
                                            <div class="form-group">
                                                <label for="">Brand Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $edit->name }}" required>
                                            </div>
                    
                                            <div class="form-group">
                                                <label for="">Brand Image</label>
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

@endsection