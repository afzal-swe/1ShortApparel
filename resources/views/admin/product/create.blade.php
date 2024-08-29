
@extends('admin.layouts.app')
@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<style type="text/css">
  .bootstrap-tagsinput .tag {
    background: #428bca;;
    border: 1px solid white;
    padding: 1 6px;
    padding-left: 2px;
    margin-right: 2px;
    color: white;
    border-radius: 4px;
  }
</style>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('product.all_product') }}"><- Go To Home</a></li>
              <li class="breadcrumb-item active">Add New product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

       <form action="{{ route('product_store') }}" method="post" enctype="multipart/form-data">
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Information</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Product Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="product_title" value="{{ old('product_title') }}" placeholder="Product Name">
                      @error('product_title')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Product Code <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" value="{{ old('product_code') }}" name="product_code" placeholder="Product Code">
                      @error('product_code')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Category <span class="text-danger">*</span> </label>
                      <select class="form-control" name="category_id" id="category_id">
                        <option disabled="" selected="">==choose category==</option>
                        @foreach($category as $row)
                          
                           <option style="color:blue;">{{ $row->category_name }}</option>
                             
                        @endforeach 
                      </select>
                      @error('category_id')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>

                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Subcategory <span class="text-danger">*</span> </label>
                      <select class="form-control" name="subcategory_id" id="subcategory_id">
                        <option disabled="" selected="">==choose Subcategory==</option>
                        @foreach($category as $row)
                           @php 
                              $subcategory=DB::table('sub_categories')->where('category_id',$row->id)->get();
                           @endphp
                           <option style="color:blue;" disabled="">{{ $row->category_name }}</option>
                              @foreach($subcategory as $row)
                                <option value="{{ $row->id }}"> -- {{ $row->subcategory_name }}</option>
                              @endforeach
                        @endforeach 
                      </select>
                      @error('subcategory_id')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Brand <span class="text-danger">*</span> </label>
                      <select class="form-control" name="brand_id">
                        <option selected disabled>==choose brand==</option>
                        @foreach($brand as $row)
                          <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach 
                      </select>
                      @error('brand_id')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Pickup Point</label>
                      <select class="form-control" name="pickup_point">
                        <option selected disabled>==choose pickup point==</option>
                        @foreach($pickup_point as $row)
                          <option value="{{ $row->id }}">{{ $row->pickup_point_name  }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Unit <span class="text-danger">*</span> </label>
                      <input type="text" class=form-control name="product_unit" value="{{ old('product_unit') }}" placeholder="Unit (e.g. KG, Pc, etc)">
                      @error('product_unit')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Tags</label><br>
                      <input type="text" name="product_tags" class="form-control" value="{{ old('product_tags') }}" data-role="tagsinput" placeholder="Tags">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Unit price  <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" {{ old('product_price') }} name="product_price" placeholder="0">
                      @error('product_price')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Selling Price <span class="text-danger">*</span> </label>
                      <input type="text" name="product_purchase_price" value="{{ old('product_purchase_price') }}" class="form-control" placeholder="0">
                      @error('product_purchase_price')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInput">Discount Price </label>
                      <input type="text" name="discount_price" value="{{ old('discount_price') }}" class="form-control" placeholder="0">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Warehouse <span class="text-danger">*</span> </label>
                      <select class="form-control" name="warehouse">
                        @foreach($warehouse as $row)
                         <option value="{{ $row->warhouse_name }}">{{ $row->warhouse_name }}</option>
                        @endforeach 
                      </select>
                      @error('warehouse')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Quantity </label>
                      <input type="text" name="stock_quantity" value="{{ old('stock_quantity') }}" class="form-control" placeholder="0">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Color</label><br>
                      <input type="text" class="form-control" value="{{ old('product_color') }}" data-role="tagsinput" name="product_color" placeholder="color" />
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Size</label><br>
                      <input type="text" class="form-control" value="{{ old('product_size') }}" data-role="tagsinput" name="product_size" placeholder="S, M, L, XL, 2XL" />
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Product Details</label>
                      <textarea class="form-control textarea" name="product_description">{{ old('product_description') }}</textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Product Video</h3>
                  </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-lg-12">
                          <label for="exampleInputPassword1">Video Embed Code</label>
                          <input class="form-control" name="product_video" value="{{ old('product_video') }}" placeholder="Only code after embed word">
                          <small class="text-danger">Only code after embed word</small>
                        </div>
                        <div class="form-group col-lg-12">
                          <label for="exampleInputPassword1">Video Link</label>
                          <input class="form-control" name="video" value="{{ old('video') }}" placeholder="Video Link">
                        </div>
                      </div>
                    </div>
                </div>
              </div >
            </div>
  
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">SEO Meta Tags</h3>
                  </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-lg-12">
                          <label for="exampleInputPassword1">Meta Title</label>
                          <input class="form-control" name="video" value="{{ old('video') }}" placeholder="Meta Title">
                          
                        </div>
                        <div class="form-group col-lg-12">
                          <label for="exampleInputPassword1">Description</label>
                          <textarea class="form-control" name="" id="" cols="70" rows="4"></textarea>
                        </div>
                        <div class="form-group col-lg-12">
                          <label for="exampleInputPassword1">Meta Image</label>
                          <input type="file" class="form-control" name="video">
                        </div>
                       
                      </div>
                    </div>
                </div>
              </div >
            </div >
            
            <!-- /.card -->
           </div>

           
            <!-- /.card -->
          <!-- right column -->
          <div class="col-md-4">
            <!-- Form Element sizes -->
            <div class="card card-primary">
              <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span> </label><br>
                    <input type="file" name="thumbnail" accept="image/*" class="dropify">
                    @error('thumbnail')
                      <samp class="text-danger">{{ $message }}</samp>
                    @enderror
                  </div><br>
                  <div class="">  
                    <table class="table table-bordered" id="dynamic_field">
                    <div class="card-header">
                      <h3 class="card-title">More Images (Click Add For More Image)</h3>
                    </div> 
                      <tr>  
                          <td><input type="file" accept="image/*" name="images" class="form-control name_list" /></td>  
                          <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>  
                      </tr>  
                      @error('images')
                        <samp class="text-danger">{{ $message }}</samp>
                      @enderror
                    </table>    
                  </div>
                     <div class="card p-4">
                        <h6>Featured Product</h6><hr>
                       <div><span> Status </span> <input type="checkbox" name="featured" value="1" class="btn" style="margin-left: 20px;"></div>
                     </div>

                     <div class="card p-4">
                        <h6>Today Deal</h6><hr>
                        <div><span> Status </span> <input type="checkbox" name="today_deal" value="1" class="btn" style="margin-left: 20px;"></div>
                     </div>

                     <div class="card p-4">
                        <h6>New Arrivals</h6><hr>
                       <div><span> Status </span> <input type="checkbox" name="hot_new_arrivals" value="1" class="btn" style="margin-left: 20px;"></div>
                     </div>

                     <div class="card p-4">
                        <h6>Best Sellers</h6><hr>
                       <div><span> Status </span> <input type="checkbox" name="hot_best_sellers" value="1" class="btn" style="margin-left: 20px;"></div>
                     </div>

                     <div class="card p-4">
                        <h6>Flash Deal</h6><hr>
                       <div><span> Status </span> <input type="checkbox" name="flash_deal_id" value="1" class="btn" style="margin-left: 20px;"></div>
                     </div>

                     <div class="card p-4">
                        <h6>Trendy Product</h6><hr>
                       <div><span> Status </span> <input type="checkbox" name="trendy" value="1" class="btn" style="margin-left: 20px;"></div>
                     </div>

                     <div class="card p-4">
                        <h6>Product Slider</h6><hr>
                       <div><span> Status </span> <input type="checkbox" name="product_slider" value="1" class="btn" style="margin-left: 20px;"></div>
                     </div>

                     <div class="card p-4">
                        <h6>Cash On Delivery</h6><hr>
                       <div><span> Status </span> <input type="checkbox" name="cash_on_delivery" value="1" class="btn" style="margin-left: 20px;"></div>
                     </div>

                     <div class="card p-4">
                        <h6>Product Publication</h6><hr>
                       <div><span> Status </span> <input type="checkbox" name="status" value="1"  class="btn" style="margin-left: 20px;"></div>
                     </div>
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div >
           
         </div>

          

           <button class="btn btn-info ml-2" type="submit" disabled>Save & Unpublish</button>
           <button class="btn btn-success ml-2" type="submit">Save & Publish</button>
        </div>
      </form>
    </div><br>
  </section>
    <!-- /.content -->
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script src="{{ asset('public/backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


<script type="text/javascript">
  $('.dropify').dropify();  //dropify image
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

                        


    $(document).ready(function(){      
       var postURL = "<?php echo url('addmore'); ?>";
       var i=1;  


       $('#add').click(function(){  
            i++;  
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
       });  

       $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
       });  
     }); 

 



</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  
</script>

@endsection