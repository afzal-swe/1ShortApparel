<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-8">
                <div class="company_name text-center">
                    <h3><b>{{ $settings->website_name }}</b> </h3>
                    <h6>All Order Details
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <table class="w-100 table-bordered">
        <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Subtotal ({{ $settings->currency }})</th>
                  <th>Total ({{ $settings->currency }})</th>
                  <th>Payment Type</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
        </thead>
        <tbody>
            @foreach ($ticket as $key=>$row)
                <tr>
                    {{-- <td><h6 class="p-0 m-0">{{ ++$key }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->c_name }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->c_phone }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->c_email }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->subtotal }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->total }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->payment_type }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->date }}</h6></td> --}}
                    <td><h6 class="p-0 m-0">
                        @if($row->status==0) 
                            Pending
                        @elseif ($row->status==1) 
                            Recieved
                       
                        @else 
                            Cancel
                        @endif     
                    </h6></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>