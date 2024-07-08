
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub-Category Table</h1>
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
                          <h3 class="card-title">All Sub-Category</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#modal-default"> + Add Sub-Category</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Brand Logo</th>
                                    <th>Brand Name</th>
                                    <th>Category Name</th>
                                    <th>Sub-Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($sub_category as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><img src="{{ asset($row->image) }}" style="height: 40px; width:60px"></td>
                                        <td>{{ $row->brand->name }}</td>
                                        <td>{{ $row->category->category_name }}</td>
                                        <td>{{ $row->subcategory_name }}</td>
                                        <td>
                                          @if ($row->status == '1')
                                          <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                          @else
                                          <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                          @endif
                                      </td>
                                        <td >
                                            <a href="{{ route('subcategory.edit',$row->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('subcategory.delete',$row->id) }}" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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
              <h4 class="modal-title">Insert Sub Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('subcategory.add') }}" method="post" enctype="multipart/form-data">
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
                          <label for="exampleInputEmail1">Category Name <span class="text-danger">*</span> </label>
                          <select name="category_id" id="" class="form-control  @error('category_id') is-invalid @enderror " required>
                            <option disabled="" selected="">==choose Category==</option>
                            @foreach($brand as $row)
                               @php 
                                  $category=DB::table('categories')->where('brand_id',$row->id)->get();
                               @endphp
                               <option style="color:blue;" disabled="">{{ $row->name }}</option>
                                  @foreach($category as $row)
                                    <option value="{{ $row->id }}"> -- {{ $row->category_name }}</option>
                                  @endforeach
                            @endforeach 
                          </select>
                          @error('category_id')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Sub Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="subcategory_name" class="form-control  @error('subcategory_name') is-invalid @enderror" placeholder="Sub Category Name" value="{{old('subcategory_name')}}" required>
                            @error('subcategory_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Category Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control" required>
                            
                        </div>
   
                        <input type="checkbox" name="subcategory_status" value="1"><span> Publication</span><br>
                           
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

      <script>
        $(function () {
          //Initialize Select2 Elements
          
      
          $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
          })
      
        })
        
      </script>

@endsection