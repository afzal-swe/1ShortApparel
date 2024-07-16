@extends('frontend.layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_responsive.css') }}">
{{-- @include('layouts.front_partial.collaps_nav') --}}

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('frontend/images/shop_background.jpg') }}"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">Campaign Products</h2>
		</div>
	</div>

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{ count($products) }}</span> products found</div>
							<div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></i></span>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>

						<div class="product_grid row">
							<div class="product_grid_border"></div>

							@foreach($products as $row)
							{{-- @dd($products); --}}
								<div class="product_item is_new col-lg-2">
									<div class="product_border"></div>
									<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset($row->thumbnail) }}" alt=""></div>
									<div class="product_content pt-2">
										<div class="product_price">{{ $settings->currency }}{{ $row->price }}</div>
										<div class="product_name"><div><a href="#" tabindex="0">{{ $row->product_title }}</a></div></div>
										{{-- <div class="product_name"><div><a href="{{ route('campaign.product.details',$row->id) }}" tabindex="0">{{ $row->product_title }}</a></div></div> --}}
									</div>
									<a href="{{ route('add.wishlist',$row->product_id) }}">
									  <div class="product_fav"><i class="fas fa-heart"></i></div>
									</a>
								</div>
							@endforeach
						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							<ul class="page_nav d-flex flex-row">
								{{-- {{ $products->links() }} --}}
							</ul>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

<script src="{{ asset('frontend/js/shop_custom.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection