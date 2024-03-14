
@extends('admin.layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Campaign Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                          <h3 class="card-title">Campaign</h3>
                          <a href="{{ route('campaign.all_campaign') }}">
                            <button class="btn btn-info btn-sm" style="float: right"> <- Go Back</button>
                        </a>
                          
                        </div>
                        <!-- /.card-header -->
                        
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Campaign Edit</h4>
                              </div>
                              <div class="modal-body">
                                  <form action="{{ route('campaign.update',$data->id) }}" method="post" enctype="multipart/form-data">
                                      @csrf
                  
                                      <div class="card-body">
                  
                                          <div class="form-group">
                                              <label for="coupon_code">Campaign Title</label>
                                              <input type="text" name="title" class="form-control " value="{{$data->title}}">
                                          </div>
                  
                                          <div class="row">
                                              <div class="col-lg-6">
                                                  <div class="form-group">
                                                      <label for="type">Start Date</label>
                                                      <input type="date" class="form-control" name="start_date"  value="{{$data->start_date}}">
                                                  </div>
                                              </div>
                                              <div class="col-lg-6">
                                                  <div class="form-group">
                                                      <label for="type">End Date</label>
                                                      <input type="date" class="form-control" name="end_date" value="{{$data->end_date}}">
                                                  </div>
                                              </div>
                                          </div>
                  
                                          <div class="row">
                                              <div class="col-lg-6">
                                                  <div class="form-group">
                                                      <label for="type">Discount (%)</label>
                                                      <input type="text" class="form-control" name="discount" value="{{$data->discount}}">
                                                      <small class="form-text text-danger">Discount percentage are apply for all product selling price</small>
                                                  </div>
                                              </div>
                                              <div class="col-lg-6">
                                                  <div class="form-group">
                                                      <label for="type">Image <samp class="text-danger">*</samp></label>
                                                      <input type="file" class="form-control" name="image" value="{{$data->image}}" required>
                                                      <small class="form-text">This is your campaign banner</small>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="type">Status <samp class="text-danger">*</samp></label>
                                                <select name="status" id="status" class="form-control">
                                                  <option disabled>== Select Status ==</option>
                                                  <option value="1" @if ($data->status == "1") selected @endif>Active</option>
                                                  <option value="0" @if ($data->status == "0") selected @endif>Inactive</option>
                                                </select>
                                            </div>
                                          </div>
                                             
                                          <div class="card-footer">
                                              <button type="submit" class="btn btn-primary"><span class="d-none loader" ><i class="fas fa-spinner"></i>Loading..</span><span class="submit_btn">Submit</span></button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                      
                </div>
            </div>
        </div>
    </section>
  </div>
@endsection