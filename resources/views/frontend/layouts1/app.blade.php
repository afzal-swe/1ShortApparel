<!DOCTYPE html>
<html lang="en">
<head>
	@php
      $website_info = DB::table('website_settings')->first();
    @endphp
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @if ($website_info !== Null)
  <title>{{ $website_info->website_name }}</title>
  @else
  <title>Testing Site</title>
  @endif
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{ asset ('frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/plugins/slick-1.8.0/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/styles/responsive.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset ('frontend/styles/product_responsive.css')}}">

<link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.css')}}">



</head>

<body>

<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset ('frontend/images/phone.png')}}" alt=""></div>+38 068 005 3570</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset ('frontend/images/mail.png')}}" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">English<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">English</a></li>
											<li><a href="#">Bangla</a></li>
										</ul>
									</li>
									<li>
										<a href="#">Currency<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">Taka (৳)</a></li>
											<li><a href="#">Dollar ($)</a></li>
										</ul>
									</li>
								</ul>
							</div>

							@if(Auth::check())
							<div class="top_bar_user" style="margin-top: -80px;">
								{{-- <div class="user_icon"><img src="{{ asset ('frontend/images/user.svg')}}" alt=""></div> --}}
								
									<ul class="standard_dropdown top_bar_dropdown" style="width: 200px; padding:10px;">
										<li>
											<a href="">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
											<ul style="width: 200px;">
												<li><a href="">Profile</a></li>
												<li><a href="">Setting</a></li>
												<li><a href="">Order List</a></li>
												<li><a href="">
													<form method="POST" action="{{ route('logout') }}">
														@csrf
								
														<x-dropdown-link :href="route('logout')"
																onclick="event.preventDefault();
																			this.closest('form').submit();">
															<p class="nav-link active">Sing Out</p>
														</x-dropdown-link>
													</form>       
													</a>
												</li>
											</ul>
										</li>
									</ul>

									{{-- <div><a href="{{ route('logout') }}">Sign Out</a></div> --}}

									{{-- <div>
										<form method="POST" action="{{ route('logout') }}">
											@csrf
					
											<x-dropdown-link :href="route('logout')"
													onclick="event.preventDefault();
																this.closest('form').submit();">
												<p class="nav-link active">Sing Out</p>
											</x-dropdown-link>
										</form>         
									</div> --}}
								
							</div>
							@endif

							@guest
								<div class="top_bar_menu top_bar_user">
									<div><a href="{{ route('register') }}">Register | </a></div>
								<div><a href="{{ route('login') }}">Sign in</a></div>
								</div>
							@endguest
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							
							@if ($website_info !== Null)
								<div class="logo"><a href="{{ url('/') }}">{{ $website_info->website_name }}</a></div>
							@else
								<title>Testing Site</title>
							@endif
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">All Categories</a></li>
													<li><a class="clc" href="#">Computers</a></li>
													<li><a class="clc" href="#">Laptops</a></li>
													<li><a class="clc" href="#">Cameras</a></li>
													<li><a class="clc" href="#">Hardware</a></li>
													<li><a class="clc" href="#">Smartphones</a></li>
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>


					{{-- @php
						$wishlist = DB::table('wishlists')->where('user_id', Auth::id())->count();
					@endphp --}}
					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{ asset ('frontend/images/heart.png')}}" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="#">Wishlist</a></div>
									{{-- <div class="wishlist_count">{{ $wishlist }}</div> --}}
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{ asset ('frontend/images/cart.png')}}" alt="">
										<div class="cart_count"><span>0</span></div>
										{{-- <div class="cart_count"><span>{{Cart::count()}}</span></div> --}}
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="#">Cart</a></div>
										{{-- <div class="cart_price">{{ $setting->currency }} {{ 0 }}</div> --}}
										{{-- <div class="cart_price">{{ $setting->currency }} {{ Cart::total() }}</div> --}}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Main Navigation -->

		@include('frontend.layouts.partial.main_navbar')
		
		<!-- Menu -->
	</header>
	
	<!-- Banner -->

	

	@yield('content')
	<!-- Footer -->

	@include('frontend.layouts.partial.footer')

<script src="{{ asset ('frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset ('frontend/styles/bootstrap4/popper.js')}}"></script>
<script src="{{ asset ('frontend/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{ asset ('frontend/plugins/greensock/TweenMax.min.js')}}"></script>
<script src="{{ asset ('frontend/plugins/greensock/TimelineMax.min.js')}}"></script>
<script src="{{ asset ('frontend/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
<script src="{{ asset ('frontend/plugins/greensock/animation.gsap.min.js')}}"></script>
<script src="{{ asset ('frontend/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
<script src="{{ asset ('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{ asset ('frontend/plugins/slick-1.8.0/slick.js')}}"></script>
<script src="{{ asset ('frontend/plugins/easing/easing.js')}}"></script>
<script src="{{ asset ('frontend/js/custom.js')}}"></script>
<script src="{{ asset ('frontend/js/product_custom.js')}}"></script>

<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>

<script>
	@if (Session::has('messege'))
	var type="{{Session::get('alert-type','info')}}"
	switch(type){
		case 'info':
			toastr.info("{{ Session::get('messege') }}");
			break;
		case 'success':
			toastr.success("{{ Session::get('messege') }}");
			break;
		case 'warning':
			toastr.warning("{{ Session::get('messege') }}");
			break;
		case 'error':
			toastr.error("{{ Session::get('messege') }}");
			break;
	}   
	@endif
  </script>
</body>

</html>