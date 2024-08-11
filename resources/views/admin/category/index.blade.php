
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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
                          <h3 class="card-title">All Category</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#modal-default"> + Add Category</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Icon</th>
                                    <th>Brand Name</th>
                                    <th>Category Name</th>
                                    <th>Home Page</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($category as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><img src="{{ asset($row->image) }}" style="height: 40px; width:60px"></td>
                                        <td>{{ $row->brand->name }}</td>
                                        <td>{{ $row->category_name }}</td>
                                        <td>
                                          @if ($row->home_page == '1')
                                            <h6 class="btn text-success" >Active</h6>
                                          @else
                                            <h6 class="btn text-danger" >Deactive</h6>
                                          @endif
                                      </td>
                                        <td>
                                          @if ($row->category_status == '1')
                                            <h6 class="btn text-success" >Active</h6>
                                          @else
                                            <h6 class="btn text-danger" >Deactive</h6>
                                          @endif
                                      </td>
                                        <td>
                                            
                                            <a href="{{ route('category.edit',$row->id) }}" class="btn btn-info btn-sm edit" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('category.delete',$row->id) }}" id="delete" class="btn btn-danger btn-sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
        </div>
    </section>
  </div>

{{-- Category Added Modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Insert New Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.add') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Brand Name <span class="text-danger">*</span></label>
                            <select name="brand_id" id="" class="form-control  @error('brand_id') is-invalid @enderror " required>
                              <option value="" selected disabled>Choose Brand</option>
                                @foreach ($brand as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="category_name" class="form-control  @error('brand_id') is-invalid @enderror" placeholder="Category Name" value="{{old('category_name')}}" required>
                            @error('category_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                          <div class="form-group col-lg-6">
                            <label for="exampleInputFile">Home Page<span class="text-danger">*</span></label>
                            <select name="home_page" id="" class="form-control  @error('home_page') is-invalid @enderror " required>
                              <option value="" selected disabled>== Choose Options ==</option>
                                
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                                
                            </select>
                            @error('home_page')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          
                          <div class="form-group col-lg-6">
                            <label for="exampleInputFile">Publication<span class="text-danger">*</span></label>
                            <select name="category_status" id="" class="form-control  @error('category_status') is-invalid @enderror " required>
                              <option value="" selected disabled>== Choose Options ==</option>
                                
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                                
                            </select>
                            @error('category_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputFile">Category Image <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" name="image"  class="custom-file-input" id="exampleInputFile" required>
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div>
                        </div>
                           
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

      <script>
        $(function () {
          //Initialize Select2 Elements
          
      
          $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
          })
      
        })
        
      </script>

@endsection