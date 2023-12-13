
@extends('admin.layouts.app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   

{{-- Category Added Modal --}}
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create New Coupon</h4>
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

    <form action="{{ route('coupon.update',$edit->id) }}" method="post" id="add-form">
        @csrf

        <div class="card-body">

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

            <input type="checkbox" name="status" value="1"><span> Publication</span><br>
               
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><span class="d-none loader" ><i class="fas fa-spinner"></i>Loading..</span><span class="submit_btn">Submit</span></button>
            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script type="text/javascript">

        // Rorm Submit route system
        $('#add-form').on('submit', function(){
           $('.loader').removeClass('d-none');
           $('.submit_btn').addClass('d-none');
        });

    </script>

@endsection