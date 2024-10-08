@extends('frontend.layouts.app')

@section('content')

{{-- @extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css">
@include('layouts.front_partial.collaps_nav') --}}


	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart_container card p-1">
						<div class="cart_title text-center">Billing Address</div>
						
						  <form action="{{ route('order.place') }}" method="post" id="order-place">
						  	@csrf
							<div class="row p-4">
							  <div class="form-group col-lg-6">
								<label>Customer Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="{{ Auth::user()->name }}" name="c_name">
							  </div>
							  <div class="form-group col-lg-6">
								<label>Customer Phone <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="{{ Auth::user()->phone ?? "Null" }}" name="c_phone">
							  </div>
							  <div class="form-group col-lg-6">
								<label> Country <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="c_country">
								
							  </div>
							  <div class="form-group col-lg-6">
								<label>Shipping Address <span class="text-danger">*</span> </label>
								<input type="text" class="form-control" name="c_address">
								
							  </div>
							  
							  <div class="form-group col-lg-6">
								<label>Email Address</label>
								<input type="text" class="form-control" name="c_email" required>
								
							  </div>
							  <div class="form-group col-lg-6">
								<label>Zip Code</label>
								<input type="text" class="form-control" name="c_zipcode">
							  </div>
							  <div class="form-group col-lg-6">
								<label>City Name</label>
								<input type="text" class="form-control" name="c_city">
							  </div>
							  <div class="form-group col-lg-6">
								<label>Extra Phone</label>
								<input type="text" class="form-control" name="c_extra_phone">
							  </div>
								<br>
							  	   <div class="form-group col-lg-4">
                                         <input type="radio"  name="payment_type" value="1">
                                         <label>Pay To Cart</label>
							  	   </div>
							  	   
							  	   <div class="form-group col-lg-4">
                                         <input type="radio"  name="payment_type" checked="" value="2" >
                                         <label>Hand Cash</label>
							  	   </div>
							  	   
							</div>
							<div class="form-group pl-2">
							  	<button type="submit" class="btn btn-info p-2">Order Place</button>
							</div>

							<span class="visually-hidden pl-2 d-none progress">Progressing.....</span>

						  </form>
								

						<!-- Order Total -->
						
					</div>
				</div>
				<div class="col-lg-4" >
					<div class="card">
						<div class="pl-4 pt-2">
							<p style="color: black;">Subtotal: <span style="float: right; padding-right: 5px;">{{ Cart::subtotal() }} {{ $settings->currency }}</span> </p>
							{{-- coupon apply --}}
							@if(Session::has('coupon'))
							{{-- <p style="color: black;">coupon:({{ Session::get('coupon')['name'] }}) <a href="#" class="text-danger">X</a> <span style="float: right; padding-right: 5px;">{{ Session::get('coupon')['discount'] }} {{ $settings->currency }}</span>  </p> --}}
							<p style="color: black;">coupon:({{ Session::get('coupon')['name'] }}) <a href="{{ route('coupon.remove') }}" class="text-danger">X</a> <span style="float: right; padding-right: 5px;">{{ Session::get('coupon')['discount'] }} {{ $settings->currency }}</span>  </p>
							@else
							@endif

							<p style="color: black;">Tax: <span style="float: right; padding-right: 5px;">0.00 %</span></p>
							<p style="color: black;">shipping: <span style="float: right; padding-right: 5px;">0.00 {{ $settings->currency }}</span></p>

							@if(Session::has('coupon'))
							<p style="color: black;"><b> Total: <span style="float: right; padding-right: 5px;"> {{ Session::get('coupon')['after_discount'] }} {{ $settings->currency }} </span></b></p>
							@else
								<p style="color: black;"><b> Total: <span style="float: right; padding-right: 5px;"> {{ Cart::total() }} {{ $settings->currency }} </span></b></p>
							@endif
						</div><hr>

						@if(!Session::has('coupon'))
						<form action="{{ route('apply.coupon') }}" method="post">
							@csrf
							<div class="p-4">
							  <div class="form-group">
								<label>Coupon Apply</label>
								<input type="text" class="form-control" name="coupon" required="" placeholder="Coupon Code" autocomplete="off">
							  </div>
							  <div class="form-group">
							  	<button type="submit" class="btn btn-info">Apply Coupon</button>
							  </div>
							</div>	
						</form>
						@endif
					</div>

				</div>
			</div>
		</div>
	</div><hr>

	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">

		 $('body').on('click','#removeProduct', function(){
		    let id=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/remove/') }}/'+id,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

		 //qty update with ajax
		 $('body').on('blur','.qty', function(){
		    let qty=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updateqty/') }}/'+rowId+'/'+qty,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

		 //color update
		 $('body').on('change','.color', function(){
		    let color=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updatecolor/') }}/'+rowId+'/'+color,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

		 //size update
		 $('body').on('change','.size', function(){
		    let size=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updatesize/') }}/'+rowId+'/'+size,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });


		 $('#order-place').submit(function(e) {
             $('.progress').removeClass('d-none');
        });

	</script>

@endsection


