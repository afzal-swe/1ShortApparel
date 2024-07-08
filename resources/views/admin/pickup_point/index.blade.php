
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pickup Point Table</h1>
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
                          <h3 class="card-title">Pickup Point List Here</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#addModal"> + Add Pickup Point</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table  class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Pickup Point Name</th>
                                    <th>Pickup Point Address</th>
                                    <th>Pickup Point Phone-1</th>
                                    <th>Pickup Point Phone-2</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->pickup_point_name }}</td>
                                        <td>{{ $row->pickup_point_address }}</td>
                                        <td>{{ $row->pickup_point_phone }}</td>
                                        <td>{{ $row->pickup_point_phone_two }}</td>
                                        
                                        <td >
                                            <a href="{{ route('pickup_point.edit',$row->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('pickup_point.delete',$row->id) }}" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Pickup Point</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
                <form action="{{ route('pickup_point.add') }}" method="post" id="add_form">
                    @csrf

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="pickup_point_name">Pickup Point Name <samp class="text-danger" >*</samp> </label>
                            <input type="text" name="pickup_point_name" class="form-control " placeholder="Pickup Point Name" value="{{old('pickup_point_name')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="pickup_point_address">Pickup Point Address <samp class="text-danger" >*</samp> </label>
                            <input type="text" name="pickup_point_address" class="form-control " placeholder="Pickup Point Address" value="{{old('pickup_point_address')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="pickup_point_phone">Pickup Point Number <samp class="text-danger" >*</samp> </label>
                            <input type="text" name="pickup_point_phone" class="form-control " placeholder="Pickup Point Phone-1" value="{{old('pickup_point_phone')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="pickup_point_phone_two">Pickup Point Number <samp class="text-danger" >*</samp> </label>
                            <input type="text" name="pickup_point_phone_two" class="form-control " placeholder="Pickup Point Phone-2" value="{{old('pickup_point_phone_two')}}">
                        </div>

                        

                        <input type="checkbox" name="status" value="1"><span> Publication</span><br>
                           
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><span class="loading d-none" ><i class="fas fa-spinner"></i>Loading...</span><span class="submit_btn">Submit</span></button>
                        </div>
                    </div>
                </form>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection