@extends('frontend.layouts.app')

    {{-- @section('navbar')
    @include('frontend.layouts.partial.main_navbar')
    @endsection --}}

    {{-- Category Product --}}


@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_responsive.css') }}">

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('frontend/images/shop_background.jpg') }}"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">{{ $category->category_name ?? "Null" }}</h2>
    </div>
</div>
	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Sub Categories</div>
							<ul class="sidebar_categories">
                                @foreach ($subcategory as $row)
                                    
								<li><a href="{{ route('subcategorywise.product',$row->id) }}">{{ substr($row->subcategory_name,0,20) }} ... </a></li>
                                @endforeach
							
							</ul>
						</div>
						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Color</div>
							<ul class="colors_list">
								<li class="color"><a href="#" style="background: #b19c83;"></a></li>
								<li class="color"><a href="#" style="background: #000000;"></a></li>
								<li class="color"><a href="#" style="background: #999999;"></a></li>
								<li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
								<li class="color"><a href="#" style="background: #df3b3b;"></a></li>
								<li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
							</ul>
						</div>
						
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{ count($products) }}</span> products found</div>
							<div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>

						<div class="product_grid">
							<div class="product_grid_border"></div>

							<!-- Product Item -->
                            @foreach ($products as $row)
                                <div class="product_item is_new">
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset ($row->thumbnail)}}" alt="{{$row->thumbnail}}"></div>
                                    <div class="product_content  mt-3">
                                        @if ($row->discount_price==Null)
                                            <div class="product_price">{{ $settings->currency }}{{ $row->product_price }}</div>
                                        @else
                                            <div class="product_price">{{ $settings->currency }}{{ $row->discount_price }}<span>{{ $settings->currency }}{{ $row->product_price }}</span></div>
                                        @endif
                                        {{-- <div class="product_price">$225</div> --}}
                                        <div class="product_nam"><div><a href="{{ route('product.details',$row->slug) }}" tabindex="0">{{ substr($row->product_title,0,15 ?? "Null") }} ...</a></div></div>
                                    </div>

                                    <a href="{{ route('add.wishlist',$row->id) }}">
                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                    </a>
                                </div>
                            @endforeach
						</div>

						<!-- Shop Page Navigation -->
						<div class="shop_page_nav d-flex flex-row">
							<ul class="page_nav d-flex flex-row">
								{{ $products->links() }}
							</ul>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Recently Viewed -->

    <!-- Top Viewed Products -->
	@php
        $top_view_product = DB::table('products')->where('status', 1,)->orderBy('product_views', 'DESC')->get();
    @endphp

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Products for you</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left bg-info"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right bg-info"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">
                        
                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">
                            
                            @foreach ($top_view_product as $row)
                                <!-- Recently Viewed Item -->
                                <div class="owl-item">
                                    <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image"><img src="{{ asset ($row->thumbnail)}}" alt="{{ $row->product_title }}"></div>
                                        <div class="viewed_content text-center">
                                        {{-- <div class="product_price discount">$225<span>$300</span></div> --}}
                                            @if ($row->discount_price==Null)
                                                <div class="viewed_price">{{ $settings->currency }}{{ $row->product_price }}</div>
                                            @else
                                                <div class="viewed_price">{{ $settings->currency }}{{ $row->discount_price }}<span>{{ $settings->currency }}{{ $row->product_price }}</span></div>
                                            @endif
                                            <div class="viewed_name"><div><a href="{{ route('product.details',$row->slug) }}">{{ substr($row->product_title,0,10) }}..</a></div></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection