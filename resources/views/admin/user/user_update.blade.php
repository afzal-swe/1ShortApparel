@extends('admin.layouts.app')
@section('content')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('user.update',$edit->id) }}" method="post" >
        @csrf
        {{-- <input type="hidden" name="id" value="{{  }}"> --}}
       	<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update  User</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Employee Name </label>
                      <input type="text" class="form-control" name="name" value="{{ $edit->name }}" >
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Employee Email</label>
                      <input type="email" class="form-control" value="{{ $edit->email }}" name="email" disabled>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Employee User Name</label>
                      <input type="text" class="form-control" value="{{ $edit->user_name ?? "Null" }}" name="user_name" >
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Employee Phone</label>
                      <input type="text" class="form-control" value="{{ $edit->phone ?? "Null" }}" name="phone" >
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-3">
                        <h6>Category</h6>
                       <input type="checkbox" name="category" value="1" @if($edit->category==1) checked @endif >
                    </div>
                    <div class="col-3">
                        <h6>Product</h6>
                       <input type="checkbox" name="product" value="1"  @if($edit->product==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Offer</h6>
                       <input type="checkbox" name="offer" value="1" @if($edit->offer==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Order</h6>
                       <input type="checkbox" name="order" value="1"  @if($edit->order==1) checked @endif>
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-3">
                        <h6>Pickuppoint</h6>
                       <input type="checkbox" name="pickup" value="1" @if($edit->pickup==1) checked @endif >
                    </div>
                    <div class="col-3">
                        <h6>Tickets</h6>
                       <input type="checkbox" name="ticket" value="1"  @if($edit->ticket==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Contact</h6>
                       <input type="checkbox" name="contact" value="1" @if($edit->contact==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Report</h6>
                       <input type="checkbox" name="report" value="1"  @if($edit->report==1) checked @endif>
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-3">
                        <h6>Setting</h6>
                       <input type="checkbox" name="setting" value="1" @if($edit->setting==1) checked @endif >
                    </div>
                    <div class="col-3">
                        <h6>Userrole</h6>
                       <input type="checkbox" name="userrole" value="1" @if($edit->userrole==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>blog</h6>
                       <input type="checkbox" name="blog" value="1" @if($edit->blog==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Status</h6>
                       <input type="checkbox" name="status" value="1" @if($edit->status==1) checked @endif>
                    </div>
                 
                  </div>
                    
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