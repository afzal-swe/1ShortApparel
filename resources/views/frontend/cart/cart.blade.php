@extends('frontend.layouts.app')

@section('content')

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>

                    
                    <div class="cart_items">
                        <ul class="cart_list">
                            <li class="cart_item clearfix">
                                {{-- <div class="cart_item_image"><img src="{{ asset('frontend/images/shopping_cart.jpg') }}" alt=""></div> --}}
                                <div class="cart_item_image">
                                    <img src="{{ asset ('frontend/images/logo/Logo-01.png')}}" alt="" >
                                </div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between mt-4">
                                    
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_title">Name</div>
                                        
                                    </div>
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Color</div>
                                        
                                    </div>
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_title">Size</div>
                                        
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_title">Quantity</div>
                                        
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_title">Price</div>
                                        
                                    </div>
                                    
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Total</div>
                                        
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_title">Action</div>
                                        
                                    </div>
                                </div>
                            </li><hr>
                            @foreach ($content as $row)
                            {{-- @dd($row); --}}
                            @php
                                $product = DB::table('products')->where('id', $row->id)->first();
                                // $colors = explode(',',$product->color);
                                // $sizes = explode(',',$product->size);
                            @endphp
                            <li class="cart_item clearfix">
                                <div class="cart_item_image"><img src="{{ asset($row->options->thumbnail) }}" alt=""></div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_text">{{ substr($row->name,0,6 ?? "Null") }}..</div>
                                    </div>

                                    {{-- @if($row->options->color !=Null) --}}
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_text">
                                            <select class="custom-select form-control-sm" name="color" style="min-width: 100px;">

                                                <option value="">Null</option>
                                            </select>
                                        </div>
                                    </div>  
                                    {{-- @endif --}}

                                    {{-- @if($row->options->size !=Null) --}}
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_text">
                                            <select class="custom-select form-control-sm" name="size" style="min-width: 100px;">
                                                {{-- @foreach ($sizes as $size)
                                                <option value="">{{ $size }}</option>
                                                @endforeach --}}
                                                <option value="">Null</option>
                                            </select>
                                        </div>
                                    </div>  
                                    {{-- @endif --}}
                                    <div class="cart_item_quantity cart_info_col">
                                        
                                        <div class="cart_item_text" style="width: 100px;">
                                            <input type="number" name="quantity_input" class="custom-select form-control-sm" value="{{ $row->qty }}" min="1">
                                        </div>
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                       
                                        <div class="cart_item_text">{{ $settings->currency }} {{ $row->price }} X {{ $row->qty }}</div>
                                    </div>
                                    
                                    <div class="cart_item_total cart_info_col">
                                        
                                        <div class="cart_item_text">{{ $settings->currency }} {{ $row->qty*$row->price }}</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        
                                        <a href="#" class="cart_item_text btn btn-danger" data-id="{{ $row->rowId }}" id="removeProduct">x</a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">$2000</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <a href="{{ route('cart.destory') }}" type="button" class="button cart_button_clear btn-danger">Clear Cart</a>
                        <button type="button" class="button cart_button_checkout">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $('body').on('click','#removeProduct',function(){
        let id=$('this').data('id');
        alert(id);
        // $.ajax({

        //     url:'{{ url('cart/remove/') }}/'+id,
        //     type:'get',
        //     async:false,
        //     success:function(data);
        //     toastr.success(data);
        //     location.reload();
        // });

    });
</script>
	
@endsection