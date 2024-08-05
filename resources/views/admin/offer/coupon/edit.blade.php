   

    
@extends('admin.layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update New Coupon</h1>
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
                          <h3 class="card-title">Coupon Modify</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Update Sub Category</h4>
                                  <a href="{{ route('coupon.all_coupon') }}" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>

                                  </a>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('coupon.update',$edit->id) }}" method="post">
                                        @csrf
                    
                    
                                            <div class="form-group">
                                                <label for="coupon_code">Coupone Code </label>
                                                <input type="text" name="coupon_code" class="form-control " value="{{ $edit->coupon_code }}" >
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="type">Coupone Type </label>
                                                <select name="type" class="form-control" id="" required>
                                                    <option selected disabled>-- Choose Type --</option>
                                                    <option value="1">Fixed</option>
                                                    <option value="2">Percentage</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="coupon_amount">Coupone Amount </label>
                                                <input type="text" name="coupon_amount" class="form-control " value="{{ $edit->coupon_amount }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="valid_date">Valid Date </label>
                                                <input type="date" name="valid_date" class="form-control " value="{{ $edit->valid_date }}">
                                            </div>
                                
                                            <input type="checkbox" name="status" value="1" @if ($edit->status==1) checked @endif><span> Publication</span><br>
                                               
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary"><span class="submit_btn">Submit</span></button>
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

   

