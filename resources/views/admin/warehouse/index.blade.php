
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ware House Table</h1>
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
                          <h3 class="card-title">Warehouse List</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#modal-default"> + Add Warehouse</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Warehouse  Name</th>
                                    <th>Warehouse  Address</th>
                                    <th>Warehouse Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warehouse as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->warhouse_name }}</td>
                                        <td>{{ $row->warhouse_address }}</td>
                                        <td>{{ $row->warhouse_phone }}</td>
                                        
                                        <td >
                                            <a href="{{ route('warehouse.edit',$row->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('warehouse.delete',$row->id) }}" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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

{{-- Category Added Modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Ware House</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('warehouse.store') }}" method="post">
                    @csrf


                        <div class="form-group">
                            <label for="">Warehouse Name </label>
                            <input type="text" name="warhouse_name" class="form-control @error('warhouse_name') is-invalid @enderror " placeholder="Warehouse Name" value="{{old('warhouse_name')}}">
                            @error('warhouse_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Warehouse Address </label>
                            <input type="text" name="warhouse_address" class="form-control @error('warhouse_address') is-invalid @enderror " placeholder="Warehouse Address" value="{{old('warhouse_address')}}">
                            @error('warhouse_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Warehouse Phone </label>
                            <input type="text" name="warhouse_phone" class="form-control @error('warhouse_phone') is-invalid @enderror " placeholder="Warehouse Number" value="{{old('warhouse_phone')}}">
                            @error('warhouse_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                           
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><span class="d-none loader" ><i class="fas fa-spinner"></i>Loading..</span><span class="submit_btn">Submit</span></button>
                        </div>
                    
                </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection