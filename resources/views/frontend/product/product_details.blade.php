@extends('frontend.layouts.app')
@section('content')

@php
 $review_5=App\Models\Review::where('product_id',$product->id)->where('rating',5)->count();
 $review_4=App\Models\Review::where('product_id',$product->id)->where('rating',4)->count();
 $review_3=App\Models\Review::where('product_id',$product->id)->where('rating',3)->count();
 $review_2=App\Models\Review::where('product_id',$product->id)->where('rating',2)->count();
 $review_1=App\Models\Review::where('product_id',$product->id)->where('rating',1)->count();

 $sum_rating=App\Models\Review::where('product_id',$product->id)->sum('rating');
 $count_rating=App\Models\Review::where('product_id',$product->id)->count('rating');

//  //Share plugin 
// 			 // Share button 1
//          $shareButtons1 = \Share::page(
//               url()->current()
//          )
//          ->facebook()
//          ->twitter()
//          ->linkedin()
//          ->telegram()
//          ->whatsapp() 
//          ->reddit();


@endphp

<style type="text/css">
	.checked {
  color: orange;
}
</style>


<div class="single_product">
    <div class="container">
        <div class="row">
            @php
                $img=explode(',',$product->images);
                $color=explode(',',$product->product_color);
                $size=explode(',',$product->product_size);
            @endphp
            <!-- Images -->
            <div class="col-lg-1 order-lg-1 order-2">
                <ul class="image_list">
                    @isset($product->images)
                        @foreach($img as $image)
                        <li data-image="{{ asset ($image)}}"><img src="{{ asset ($image)}}" alt=""></li>
                        @endforeach
                    @endisset
                   
                </ul>
            </div>



            <!-- Selected Image -->
            <div class="col-lg-4 order-lg-2 order-1">
                <div class="image_selected"><img src="{{ asset ($product->thumbnail) }}" alt=""></div>
            </div>

            <!-- Description -->
            <div class="col-lg-4 order-3">
                <div class="product_description">
                    <div class="product_category">{{ $product->category->category_name }}</div>
                    <div class="product_name" style="font-size: 20px;">{{ $product->product_title }} - {{ $product->product_code }}</div>
                    <div class="product_category"><b>Brand: {{ $product->brand->name }}</b></div>
                    @if ($product->stock_quantity == 0 || $product->stock_quantity == Null)
                    <div class="product_category text-danger" style="margin-top: 10px;" ><b>Out Of Stock : {{ $product->stock_quantity }}</b></div>
                         
                    @else
                    <div class="product_category" style="margin-top: 10px;" >Status : <b class="text-success">In Stock - {{ $product->stock_quantity }} {{ $product->product_unit }}</b></div>
                    @endif
                    <br>
                    @if($sum_rating !=NULL)	
					 	@if(intval($sum_rating/$count_rating) == 5)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@else
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@endif
					@endif 	
					 </div>
					<div>

                  
                    {{-- <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div> --}}
                    @if ($product->discount_price==Null)
					    <div class="product_price" style="margin-top: 18px; margin-left:50px;">{{ $setting->currency }}{{ $product->product_price }}</div>
					@else
					<div class="product_price" style="margin-top: 18px; margin-left:50px;">
                        {{-- <del class="text-danger">{{ $setting->currency }}{{ $product->product_price }}</del> {{ $setting->currency }}{{ $product->discount_price }}</div> --}}
					@endif
                    {{-- <div class="product_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis, nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus cursus urna, eget dictum lacus turpis.</p></div> --}}
                    <div class="order_info d-flex flex-row " style="margin-top: 18px; margin-left:50px;">
                        <form action="{{ route('add.to.cart',$product->id) }}" method="post" id="add_cart_form" enctype="multipart/form-data">
                            @csrf
                            {{-- Cart Add Details --}}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            @if ($product->discount_price==Null)
                            <input type="hidden" name="price" value="{{ $product->product_price }}">
                            @else
                            <input type="hidden" name="price" value="{{ $product->discount_price }}">
                            @endif
                            <div class="form-group ">
                                <div class="row">
                                    @isset($product->product_size)
                                    
                                    <div class="col-lg-6 ">
                                        <label for="" style="margin-left:8px;">Sizse</label>
                                        <select class="custom-select form-control-sm" name="size" style="min-width: 120px; ">
                                        @foreach ($size as $siz)
                                            <option value="{{ $siz }}">{{ $siz }}</option>
                                        @endforeach
                                    </select>
                                        
                                    </div>
                                    @endisset
                                    @isset($product->product_color)
                                    <div class="col-lg-6">
                                        <label for="exampleInputEmail1" style="margin-left:8px;">Color <span class="text-danger">*</span> </label>
                                            <select class="custom-select form-control-sm" name="color" style="min-width: 120px;">
                                                <option selected disabled>Choose Color</option>
                                                    @foreach ($color as $col)
                                                        <option value="{{ $col }}">{{ $col }}</option>
                                                    @endforeach
                                                
                                            </select>
                                    </div>
                                    @endisset
                                </div>
                            </div>
                            <div class="clearfix" style="z-index: 1000; margin-left:-5px;">

                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix ml-3">
                                    <span>Quantity: </span>
                                    <input class="form-control form-control-sm" name="quantity_input" id="quantity_input" type="text" pattern="[1-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>

                                <!-- Product Color -->
                                <ul class="product_color">
                                    <li>
                                        <span>Color: </span>
                                        <div class="color_mark_container"><div id="selected_color" class="color_mark"></div></div>
                                        <div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

                                        <ul class="color_list">
                                            <li><div class="color_mark" style="background: #999999;"></div></li>
                                            <li><div class="color_mark" style="background: #b19c83;"></div></li>
                                            <li><div class="color_mark" style="background: #000000;"></div></li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>

                           
                            <div class="button_container" style="margin-top: 5px">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                        @if ($product->stock_quantity<1)
                                            <button class="btn btn-outline-info" type="submit" disabled>Add to cart</button>
                                        @else
                                            <button class="btn btn-outline-info" type="submit" ><span class="loading d-none">...</span>Add to cart</button>
                                        @endif
                                        
                                        <a href="{{ route('add.wishlist',$product->id) }}" class="btn btn-outline-primary" type="button">Add to wishlist</a>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-3" style="border-left: 1px solid grey; padding-left: 10px;">
                {{-- {!! $shareButtons1 !!} --}}
             <strong class="text-muted">Pickup Point of this product</strong><br>
             {{-- <i class="fa fa-map"> {{ $product->pickpoint->pickup_point_address }} </i><hr><br> --}}
             <strong class="text-muted"> Home Delivery :</strong><br>
             -> (4-8) days after the order placed.<br> 
             -> Cash on Delivery Available.
             <hr><br>
             <strong class="text-muted"> Product Return & Warrenty :</strong><br>
             -> 7 days return guarranty.<br> 
             -> Warrenty not available.
             <hr><br>
            @isset($product->product_video) 
             <strong>Product Video : </strong>
             <iframe width="340" height="205" src="https://www.youtube.com/embed/{{ $product->product_video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @endisset 
        </div>

    </div><br><br>
    <div class="row">
        <div class="col-lg-12">
         <div class="card">
          <div class="card-header">
            <h4>Product details of {{ $product->product_title }}</h4>
          </div>
            <div class="card-body">
                    {!! $product->product_description !!}
            </div>
         </div>
        </div>
    </div><br>


    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                Average Review of  {{ $product->product_title }}:<br>
            @if($sum_rating !=NULL)
                @if(intval($sum_rating/$count_rating) == 5)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                @elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star "></span>
                @elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                @elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                @else
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                <span class="fa fa-star "></span>
                @endif
            @endif	
            </div>
            <div class="col-md-3">
                {{-- all review show --}}
                Total Review Of This Product:<br>
                            <div>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span> Total {{ $review_5 }} </span>
                            </div>

                            <div>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star "></span>
                                <span> Total {{ $review_4 }} </span>
                            </div>

                            <div>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span> Total {{ $review_3 }} </span>
                            </div>

                            <div>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span> Total {{ $review_2 }} </span>
                            </div>

                            <div>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span> Total {{ $review_1 }} </span>
                            </div>
                            
                        
            </div>
            <div class="col-lg-6">
                <form action="{{ route('store.review') }}" method="post">
                    @csrf
                  <div class="form-group">
                    <label for="details">Write Your Review</label>
                    <textarea type="text" class="form-control" name="review" required=""></textarea>
                  </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <div class="form-group ">
                    <label for="review">Write Your Review</label>
                     <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;">
                         <option disabled="" selected="">Select Your Review</option>
                         <option value="1">1 star</option>
                         <option value="2">2 star</option>
                         <option value="3">3 star</option>
                         <option value="5">4 star</option>
                         <option value="5">5 star</option>
                     </select> 
                     
                  </div>
                  @if(Auth::check())
                  <button type="submit" class="btn btn-sm btn-info"><span class="fa fa-star "></span> submit review</button>
                  @else
                   <p>Please at first login to your account for submit a review.</p>
                  @endif
                </form>
            </div>
        </div>
            <br>
    
        {{-- all review of this product --}}	
						<strong>All review of {{ $product->product_title }}</strong> <hr>
                        <div class="row">
                            @foreach($review as $row)
                                <div class="card col-lg-5 m-2">
                                  <div class="card-header">
                                          {{ $row->user->name }}  ( {{ date('d F , Y'), strtotime($row->review_date) }} )
                                  </div>
                                  <div class="card-body">
                                          {{ $row->review }}
                                            @if($row->rating==5)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </div>
                                            @elseif($row->rating==4)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </div>
                                            @elseif($row->rating==3)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </div>
                                            @elseif($row->rating==2)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            </div>
                                            @elseif($row->rating==1)
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                            </div>
                                            @endif
                                  </div>
                             </div>
                          @endforeach
                        </div>	

        </div>
    </div>
</div>

<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Related Product</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">
                    
                    <!-- Recently Viewed Slider -->
                  
                    <div class="owl-carousel owl-theme viewed_slider">
                        
                        <!-- Recently Viewed Item -->
                        @foreach ($related_product as $row)
                            <a href="{{ route('product.details',$row->slug) }}">
                                <div class="owl-item">
                                    <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image"><img src="{{ asset ($row->thumbnail)}}" alt="{{ $row->product_title }}"></div>
                                        <div class="viewed_content text-center">

                                            @if ($row->discount_price==Null)
                                            <div class="viewed_price" style="margin-top: 25px;">{{ $setting->currency }}{{ $row->product_price }}</div>
                                            @else
                                            <div class="viewed_price" style="margin-top: 25px;">
                                                {{-- {{ $setting->currency }}{{ $row->discount_price }} <span>{{ $setting->currency }}{{ $row->product_price }}</span></div> --}}
                                            @endif

                                            <div class="viewed_name">{{ substr($row->product_title, 0, 40) }}</div>
                                        </div>
                                        <ul class="item_marks">
                                            <li class="item_mark item_discount">new</li>
                                            {{-- <li class="item_mark item_new">new</li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

{{-- <div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">
                    
                    <!-- Brands Slider -->

                    <div class="owl-carousel owl-theme brands_slider">
                        
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset ('frontend/images/brands_1.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset ('frontend/images/brands_2.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset ('frontend/images/brands_3.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset ('frontend/images/brands_4.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset ('frontend/images/brands_5.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset ('frontend/images/brands_6.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset ('frontend/images/brands_7.jpg')}}" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{ asset ('frontend/images/brands_8.jpg')}}" alt=""></div></div>

                    </div>
                    
                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Newsletter -->

{{-- <div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="{{ asset ('frontend/images/send.png')}}" alt=""></div>
                        <div class="newsletter_title">Sign up for Newsletter</div>
                        <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="#" class="newsletter_form">
                            <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                            <button class="newsletter_button">Subscribe</button>
                        </form>
                        <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $('#add_cart_form').submit(function(e){
        e.preventDefault();
        $('.loading').removeClass('d-none');
        // alert("done");
        var url = $(this).att('action');
        var request = $(this).serialize();
        $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                toastr.success(data);
                $('#add_cart_form')[0].reset();
                $('.loading').addClass('d-none');
                cart();
            }
        });
    });
</script>

@endsection