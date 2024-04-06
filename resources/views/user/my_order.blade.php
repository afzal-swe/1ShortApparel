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
                    {{ __('Dashboard') }}
                    <a href="{{ route('write_user.review') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                </div>

                <div class="card-body">
                   
                   <h4>My All Orders</h4>
                   <div>
                       <table class="table">
                         <thead>
                           <tr>
                             <th scope="col">OrderId</th>
                             <th scope="col">Date</th>
                             <th scope="col">Total</th>
                             <th scope="col">Payment Type</th>
                             <th scope="col">Status</th>
                             <th scope="col">Action</th>
                           </tr>
                         </thead>
                         <tbody>
                          @foreach($orders as $row)
                           <tr>
                             <td>{{ ($row->order_id)  }}</td>
                             <td>{{ date('d F , Y') ,strtotime($row->order_id)  }}</td>
                             <td>{{ $row->total }} {{ $settings->currency }}</td>
                             <td>
                                @if($row->payment_type==2)
                                  <span class="badge badge-info">Paypal</span>
                                @else
                                 <span class="badge badge-info">Order</span>
                                 @endif    
                            </td>
                             <td>
                              @if($row->status==0)
                                 <span class="badge badge-danger">Order Pending</span>
                              @elseif($row->status==1)
                                 <span class="badge badge-info">Order Recieved</span>
                              @elseif($row->status==2)
                                 <span class="badge badge-primary">Order Shipped</span>
                              @elseif($row->status==3)
                                 <span class="badge badge-success">Order Done</span> 
                              @elseif($row->status==4)
                                 <span class="badge badge-warning">Order Return</span>   
                              @elseif($row->status==5)  
                                 <span class="badge badge-danger">Order Cancel</span>
                              @endif          
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info" title="View Order"><i class="fa fa-eye"></i></a>
                            </td>
                           </tr>
                          @endforeach 
                         </tbody>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection