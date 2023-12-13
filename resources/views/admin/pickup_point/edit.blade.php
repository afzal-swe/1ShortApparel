
@extends('admin.layouts.app')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   

{{-- Category Added Modal --}}
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Pick up Point</h4>
              <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </a>
            </div>
            <div class="modal-body">
                
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <form action="{{ route('pickup_point.update',$data->id) }}" method="post" id="add-form">
        @csrf

        <div class="modal-body">

            <div class="form-group">
                <label for="pickup_point_name">Pickup Point Name </label>
                <input type="text" name="pickup_point_name" class="form-control "  value="{{ $data->pickup_point_name }}">
            </div>

            <div class="form-group">
                <label for="pickup_point_address">Pickup Point Address</label>
                <input type="text" name="pickup_point_address" class="form-control " value="{{ $data->pickup_point_address }}">
            </div>

            <div class="form-group">
                <label for="pickup_point_phone">Pickup Point Number </label>
                <input type="text" name="pickup_point_phone" class="form-control" value="{{ $data->pickup_point_phone }}">
            </div>

            <div class="form-group">
                <label for="pickup_point_phone_two">Pickup Point Number</label>
                <input type="text" name="pickup_point_phone_two" class="form-control" value="{{ $data->pickup_point_phone_two }}">
            </div>

            

            <input type="checkbox" name="status" value="1"><span> Publication</span><br>
               
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><span class="submit_btn">Submit</span></button>
            </div>
        </div>
    </form>
</div>


@endsection