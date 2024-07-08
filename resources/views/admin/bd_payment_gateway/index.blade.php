
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment Gateway Table</h1>
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
                          <h3 class="card-title">All Payment Gateway</h3>
                          <a href="{{ route('payment.gateway_edit') }}" class="btn btn-info btn-sm" style="float: right"> Update Payment Option</a><br>
                          <button class="btn btn-info btn-sm" style="float: right,margin:right='2px'" data-toggle="modal" data-target="#modal-default"> + Add Payment Option</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Gateway Name</th>
                                    <th>Store Id</th>
                                    <th>Signature Key</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($view_payment_gateway !== null)
                                  @foreach ($view_payment_gateway as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ $row->gateway_name ?? "Null" }}</td>
                                        <td>{{ $row->store_id ?? "Null" }}</td>
                                        <td>{{ $row->signature_key ?? "Null" }}</td>
                                        <td>{{ $row->status ?? "Null" }}</td>
                                        <td >
                                            <a href="{{ route('payment.gateway.delete',$row->id) }}" id="delete" class="btn btn-danger sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                                @else
                                  <h1>Empty Data</h1>
                                @endif

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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Payment Gateway</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment_gateway.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Gateway Name <span class="text-danger">*</span></label>
                            <input type="text" name="gateway_name" class="form-control @error('gateway_name') is-invalid @enderror " placeholder="Gateway Name" value="{{old('gateway_name')}}" required>
                            @error('gateway_name')
                              <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Store Id</label>
                            <input type="text" name="store_id" class="form-control" placeholder="Store Id">
                        </div>

                        <div class="form-group">
                            <label for="">Signature Key</label>
                            <input type="text" name="signature_key" class="form-control" placeholder="Signature Key"> 
                        </div>

                        {{-- <div class="form-group col-lg-12">
                          <label for="exampleInputFile">Status</label>
                          <select name="status" id="" class="form-control">
                            <option value="" selected disabled>== Choose Options ==</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                          </select>
                        </div> --}}
                           
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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