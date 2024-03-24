@extends('frontend.layouts.app')

@section('content')

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart_container">
                    <div class="cart_title">Your Wishlist Item</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            <li class="cart_item clearfix">
                                {{-- <div class="cart_item_image"><img src="{{ asset('frontend/images/shopping_cart.jpg') }}" alt=""></div> --}}
                               
                            @foreach ($wishlist as $row)
                            {{-- @dd($row); --}}
                            <li class="cart_item clearfix">
                                <div class="cart_item_image"><img src="{{ asset($row->thumbnail) }}" alt=""></div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">    
                                        <div class="cart_item_text">{{ substr($row->product_title,0,15 ?? "Null") }}..</div>
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_text">
                                            {{ $row->date ?? 'Null' }}
                                        </div>
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <a href="{{ route('product.details',$row->slug) }}" type="button" class="button cart_button_clear bg-info mt-4">Add To Cart</a>
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <a href="{{ route('wishlist_product.delete',$row->id) }}" type="button" class="button cart_button_clear bg-danger mt-4">X</a>
                                    </div>
                                </div>
                            </li><hr>
                            @endforeach 
                        </ul> 
                    </div>
                    <div class="cart_buttons">
                        <a href="{{ route('clear.wishlist') }}" type="button" class="button cart_button_checkout ">Clear Wishlist</a>
                        <a href="{{ url('/') }}" type="button" class="button cart_button_checkout ">Back To Home</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
	
@endsection