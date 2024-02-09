<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ $settings->website_name }}</title>
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

<!-- Theme style -->
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
					<div class="col-lg-12 d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset ('frontend/images/phone.png')}}" alt=""></div>{{ $settings->phone_one }}</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset ('frontend/images/mail.png')}}" alt=""></div><a href="mailto:1shotapparelandgoods@gmaill.com">{{ $settings->main_email }}</a></div>
						<div class="top_bar_content ml-auto">

							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">English<i class="fas fa-chevron-down"></i></a>
										
									</li>
									<li>
										<a href="#">{{ $settings->currency }}<i class="fas fa-chevron-down"></i></a>
										{{-- <ul>
											<li><a href="#">{{ $settings->currency }}</a></li>
											
										</ul> --}}
									</li>
								</ul>
							</div>
							
							@guest
							<div class="top_bar_user">
								<div class="user_icon"><img src="{{ asset ('frontend/images/user.svg')}}" alt=""></div>
								<div><a href="{{ route('register') }}">Register</a></div>
								<div><a href="{{ route('login') }}">Sign in</a></div>
							</div>

							@else
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">Profile</a></li>
											<li><a href="#">Setting</a></li>
											<li><a href="#">Order List</a></li>
											<li><a href="#">Admin Deshboard</a></li>
											<li><a href="{{ route('customer.logout') }}">Logout</a></li>
										</ul>
									</li>
								</ul>
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
					<div class="col-lg-2 col-sm-2 col-3 order-1 mt-4 mb-3" >
						<div class="logo_container">
							<div class="logo" >
                                <a href="{{ route('home_page') }}">
                                    <img src="{{ asset ('frontend/images/logo/Logo-01.png')}}" alt="" style="height: 150px; width:300px; margin-left: -70px;">
                                    {{-- <img src="{{ asset ('frontend/images/logo/Logo-01.png')}}" alt="" style="height: 150px; width:300px; margin-left: -70px;"> --}}
                                </a>
							</div>
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
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset ('frontend/images/search.png')}}" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					@php
						$wishlist = DB::table('wishlists')->where('user_id', Auth::id())->count();
					@endphp

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{ asset ('frontend/images/heart.png')}}" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="#">Wishlist</a></div>
									<div class="wishlist_count">{{ $wishlist }}</div>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{ asset ('frontend/images/cart.png')}}" alt="">
										<div class="cart_count"><span>10</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="#">Cart</a></div>
										<div class="cart_price">$85</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        @yield('navbar')
	
	</header>

	@yield('content')
	

	<!-- Footer -->

	@include('frontend.layouts.partial.footer')
	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Code Artist.IT</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="{{ asset ('frontend/images/logos_1.png')}}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset ('frontend/images/logos_2.png')}}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset ('frontend/images/logos_3.png')}}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset ('frontend/images/logos_4.png')}}" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('frontend/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('frontend/js/product_custom.js')}}"></script>

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