@extends('admin.layouts.app')
@section('content')



 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><- Go To Home</a></li>
              <li class="breadcrumb-item active">Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none">{{ $product_details->product_title." - ".$product_details->product_code }}</h3>
              <div class="col-12">
                <img src="{{ asset($product_details->thumbnail) }}" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="{{ asset($product_details->images) }}" alt="Product Image"></div>
                <div class="product-image-thumb active"><img src="{{ asset($product_details->images) }}" alt="Product Image"></div>
                <div class="product-image-thumb active"><img src="{{ asset($product_details->images) }}" alt="Product Image"></div>
                <div class="product-image-thumb active"><img src="{{ asset($product_details->images) }}" alt="Product Image"></div>
                <div class="product-image-thumb active"><img src="{{ asset($product_details->images) }}" alt="Product Image"></div>
                {{-- <div class="product-image-thumb" ><img src="{{ asset('backend/dist/img/prod-2.jpg') }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ asset('backend/dist/img/prod-3.jpg') }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ asset('backend/dist/img/prod-4.jpg') }}" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="{{ asset('backend/dist/img/prod-5.jpg') }}" alt="Product Image"></div> --}}
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{ $product_details->product_title." - ".$product_details->product_code }}</h3>
              <p>{!! Str::of($product_details->product_description)->limit(350) !!}</p>

              <hr>
              <h4>Available Colors</h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center active ml-1">
                  Green
                  <br>
                </label>
                <label class="btn btn-default text-center ml-1">
                  Blue
                  <br>
                </label>
                <label class="btn btn-default text-center ml-1">
                  Purple
                  <br>
                </label>
                <label class="btn btn-default text-center ml-1">
                  Red
                  <br>
                </label>
                <label class="btn btn-default text-center ml-1">
                  Orange
                  <br>
                </label>
              </div>

              <h4 class="mt-3">Size <small>Please select one</small></h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-default text-center ml-1">
                  <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                  <span class="text-xl">S</span>
                  <br>
                </label>
                <label class="btn btn-default text-center ml-1">
                  <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                  <span class="text-xl">M</span>
                  <br>
                </label>
                <label class="btn btn-default text-center ml-1">
                  <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                  <span class="text-xl">L</span>
                  <br>
                </label>
                <label class="btn btn-default text-center ml-1">
                  <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                  <span class="text-xl">XL</span>
                  <br>
                </label>
              </div>

              @if ($product_details->discount_price !=null)
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                    ${{ $product_details->discount_price }}
                </h2>
                <h4 class="mt-0">
                <small>Regular Price: ${{ $product_details->product_price }} </small>
                </h4>
            </div>
              @else
                <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                        ${{ $product_details->product_price }}
                    </h2>
                    <h4 class="mt-0">
                    <small>Regular Price: ${{ $product_details->product_price }} </small>
                    </h4>
                </div>
              @endif
              

              
              <div class="mt-4 product-share">
                <a href="#" class="text-gray">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-envelope-square fa-2x"></i>
                </a>
                <a href="#" class="text-gray">
                  <i class="fas fa-rss-square fa-2x"></i>
                </a>
              </div>

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
                {!! $product_details->product_description !!}
                </div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
              <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@endsection