
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Website Setting Table</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                          <h3 class="card-title">Website Modify</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Website info Update Form</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('website.setting_update',$setting->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                    
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="">Website Name</label>
                                                <input type="text" name="website_name" class="form-control" value="{{ $setting->website_name }}">
                                            </div>
                    
                                            <div class="form-group">
                                                <label for="">Website Logo</label>
                                                <input type="file" name="logo" class="form-control">
                                                <input type="hidden" name="old_logo" value="{{ $setting->logo }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Website Favicon</label>
                                                <input type="file" name="favicon" class="form-control">
                                                <input type="hidden" name="old_favicon" value="{{ $setting->favicon }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Currency</label>
                                                <select name="currency" id="" class="form-control">
                                                    <option selected disabled>-- Choose Currency --</option>
                                                    <option value="$" @if ($setting->currency = "$") selected @endif >USD ($)</option>
                                                    <option value="৳" @if ($setting->currency = "৳") selected @endif >Taka (৳)</option>
                                                    <option value="₹" @if ($setting->currency = "₹") selected @endif >Rupee ⟨₹⟩</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Phone One</label>
                                                <input type="number" name="phone_one" class="form-control" value="{{ $setting->phone_one }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Phone Two</label>
                                                <input type="number" name="phone_two" class="form-control" value="{{ $setting->phone_two }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Main Email</label>
                                                <input type="email" name="main_email" class="form-control" value="{{ $setting->main_email }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Support Email</label>
                                                <input type="email" name="support_email" class="form-control" value="{{ $setting->support_email }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" name="address" class="form-control" value="{{ $setting->address }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="description" id="summernote" cols="30" rows="10">{!! $setting->description !!}</textarea>
                                            </div>

                                           
        
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Update Information</button>
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