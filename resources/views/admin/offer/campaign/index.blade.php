
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
                          <h3 class="card-title">Campaign List Here</h3>
                          <button class="btn btn-info btn-sm" style="float: right" data-toggle="modal" data-target="#addModal"> + Create Campaign</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table  class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Campaign Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Discount</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$row)
                                {{-- @dd($row); --}}
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td><img src="{{ asset($row->image) }}" style="height: 40px; width:110px"></td>
                                        <td>{{ $row->title ?? "Null" }}</td>
                                        <td>{{ $row->start_date ?? "Null" }}</td>
                                        <td>{{ $row->end_date ?? "Null" }}</td>
                                        <td>{{ $row->discount?? "Null" }}</td>
                                        <td>{{ $row->month ?? "Null" }}</td>
                                        <td>{{ $row->year ?? "Null" }}</td>
                                        <td>
                                          @if ($row->status == 1)
                                            <a href="#"><span class="badge badge-success">Active</span></a>
                                          @else
                                            <a href="#"><span class="badge badge-danger">Inactive</span></a>
                                          @endif
                                        </td>
                                        
                                        <td >
                                            <a href="{{ route('campaign.edit',$row->id) }}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('campaign.delete',$row->id) }}" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
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
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create New Campaign</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('campaign.add') }}" method="post" id="add-form" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="coupon_code">Campaign Title  <samp class="text-danger">*</samp></label>
                            <input type="text" name="title" class="form-control " placeholder="Campaign Title" value="{{old('title')}}" required>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Start Date <samp class="text-danger">*</samp></label>
                                    <input type="date" class="form-control" name="start_date"  required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">End Date <samp class="text-danger">*</samp></label>
                                    <input type="date" class="form-control" name="end_date" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Discount (%)<samp class="text-danger">*</samp></label>
                                    <input type="text" class="form-control" name="discount" required>
                                    <small class="form-text text-danger">Discount percentage are apply for all product selling price</small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Image <samp class="text-danger">*</samp></label>
                                    <input type="file" class="form-control" name="image" required>
                                    <small class="form-text">This is your campaign banner</small>
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-lg-12">
                          <div class="form-group">
                              <label for="type">Status <samp class="text-danger">*</samp></label>
                              <select name="status" id="status" class="form-control">
                                <option disabled selected>== Select Status ==</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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
        <!-- /.modal-dialog -->
    </div>

@endsection