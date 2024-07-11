
@extends('admin.layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Message Table</h1>
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
                          <h3 class="card-title">Message List Here</h3>
                          
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table  class="table table-bordered table-striped table-sm ytable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Desctiption</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($contact)
                                    
                                @foreach ($contact as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->name ?? "Null"}}</td>
                                        <td>{{ $row->email ?? "Null"}}</td>
                                        <td>{{ $row->phone ?? "Null" }}</td>
                                        <td>{{ $row->desctiption ?? "Null" }}</td>
                                        <td >
                                            <a href="#" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.message',$row->id) }}" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endisset
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
              <h4 class="modal-title">Create New Coupon</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('coupon.add') }}" method="post" id="add-form">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="coupon_code">Coupone Code </label>
                            <input type="text" name="coupon_code" class="form-control " placeholder="Coupone Code" value="{{old('coupon_code')}}" required>
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
                            <input type="text" name="coupon_amount" class="form-control " placeholder="Coupone Amount" value="{{old('coupon_amount')}}" required>
                        </div>

                        <div class="form-group">
                            <label for="valid_date">Valid Date </label>
                            <input type="date" name="valid_date" class="form-control " placeholder="Valid Date" value="{{old('valid_date')}}" required>
                        </div>

                        <input type="checkbox" name="status" value="1"><span> Publication</span><br>
                           
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