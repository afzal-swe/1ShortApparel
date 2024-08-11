
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Table</h1>
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
                          <h3 class="card-title">All Products</h3>
                          <a href="{{ route('product_add') }}" class="btn btn-info btn-sm" style="float: right" data-target="#modal-default"> + Add Product</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    {{-- <th>Subcategory</th> --}}
                                    <th>Product Name</th>
                                    <th>Featured</th>
                                    <th>Today Deal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($product as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><img src="{{ asset($row->thumbnail) }}" style="height: 40px; width:60px"></td>
                                        <td>{{ $row->brand->name }}</td>
                                        <td>{{ $row->category->category_name }}</td>
                                        {{-- <td>{{ $row->subcategory->subcategory_name }}</td> --}}
                                        <td>{{ $row->product_title }}</td>
                                        <td>
                                          @if ($row->featured == '1')
                                          <button class="btn btn-success btn-sm">On</button>
                                          @else
                                          <button class="btn btn-danger btn-sm">Off</button>
                                          @endif
                                      </td>
                                        <td>
                                          @if ($row->today_deal == '1')
                                          <button class="btn btn-success btn-sm">On</button>
                                          @else
                                          <button class="btn btn-danger btn-sm">Off</button>
                                          @endif
                                      </td>
                                        <td>
                                          @if ($row->status == '1')
                                          <button class="btn btn-success btn-sm">On</button>
                                          @else
                                          <button class="btn btn-danger btn-sm">Off</button>
                                          @endif
                                      </td>
                                        <td >
                                            <a href="{{ route('product_view',$row->id) }}" class="btn btn-primary btn-sm" title="View Data"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('product_edit',$row->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('product.delete',$row->id) }}" id="delete" class="btn btn-danger btn-sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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

  <script>
    $(function () {
      //Initialize Select2 Elements
      
  
      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })
  
    })
    
  </script>

@endsection