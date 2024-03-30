@extends('frontend.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('User Profile') }}
                </div>

                <div class="card-body">
                   <div>
                   	  <form action="{{ route('userInfo.update',Auth::user()->id) }}" method="post">
                   	  	@csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Customer Name</label>
                   	      <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                   	    </div>

                   	    {{-- <div class="form-group">
                   	      <label for="exampleInputEmail1">Customer User Name</label>
                   	      <input type="text" class="form-control" name="user_name" value="{{ Auth::user()->user_name }}">
                   	    </div> --}}

                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Customer Email</label>
                   	      <input type="email" class="form-control" name="" readonly="" value="{{ Auth::user()->email }}">
                   	    </div>

                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Customer Phone</label>
                   	      <input type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                   	    </div>
                   	    
                   	    <br>
                   	    <button type="submit" class="btn btn-primary">Save</button>
                   	  </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection