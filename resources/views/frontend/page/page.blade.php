@extends('frontend.layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/shop_responsive.css') }}">

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('frontend/images/shop_background.jpg') }}"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">{{ $page->page_title ?? "Null" }}</h2>
    </div>
</div>
	<!-- Shop -->

	<div class="shop pd-5">
		<div class="container">
			<div class="row">
				{!! $page->page_description !!}
			</div>
		</div>
	</div><hr>

@endsection