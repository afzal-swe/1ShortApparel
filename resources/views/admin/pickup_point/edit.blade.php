

@extends('admin.layouts.app')
@section('content')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pickup Point Update</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pickup Point</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('pickup_point.update',$data->id) }}" method="post" >
        @csrf
        {{-- <input type="hidden" name="id" value="{{  }}"> --}}
       	<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Pickup Point Update</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">

                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Pickup Point Name</label>
                      <input type="text" class="form-control" name="pickup_point_name" value="{{ $data->pickup_point_name }}" >
                    </div>

                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Pickup Point Address</label>
                      <input type="text" class="form-control" name="pickup_point_address" value="{{ $data->pickup_point_address }}">
                    </div>

                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Pickup Point Number-1</label>
                      <input type="text" class="form-control" name="pickup_point_phone" value="{{ $data->pickup_point_phone }}">
                    </div>

                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Pickup Point Number-2</label>
                      <input type="text" class="form-control" name="pickup_point_phone_two" value="{{ $data->pickup_point_phone_two }}" >
                    </div>
                  </div>

                 
                  <input type="checkbox" name="status" value="1"><span> Publication</span><br>
                    
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <button class="btn btn-info ml-2" type="submit">Update</button>
           </div>
            <!-- /.card -->

           
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection