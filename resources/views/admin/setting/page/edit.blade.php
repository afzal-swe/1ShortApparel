
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Page Table</h1>
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
                          <h3 class="card-title">Page Modify</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Page Edit Form</h4>
                                  {{-- <a href="{{ route('page.all') }}" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </a> --}}
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('page.update',$edit->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                    
                                        <div class="card-body">
                    
                                            <div class="form-group">
                                                <label for="">Page Position </label>
                                                <select name="page_position" id="" class="form-control">
                                                    <option value="1" @if ($edit->page_position==1) selected @endif>Line One</option>
                                                    <option value="2" {{ ($edit->page_position==2) ? "selected" : "" }}>Line Two</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Page Name</label>
                                                <input type="text" name="page_name" class="form-control" value="{{ $edit->page_name }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Page Title</label>
                                                <input type="text" name="page_title" class="form-control" value="{{ $edit->page_title }}">  
                                            </div>

                                            <div class="form-group">
                                                <label for="">Page Description</label>
                                                <textarea name="page_description" id="summernote" cols="30" rows="10">{!! $edit->page_description !!}</textarea>
                                                <small>This data will show on your webpage.</small>
                                            </div>
                                           
        
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Page Update</button>
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