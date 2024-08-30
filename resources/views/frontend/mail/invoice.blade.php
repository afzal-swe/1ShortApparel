
@php
    $setting = DB::table('website_settings')->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $setting->website_name }} | E-shop Invoice</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">

 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            


            <!-- Main content -->
            <div class="invoice p-3 mb-3 col-sm-12">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> {{ $setting->website_name }}
                    {{-- <img src="{{ asset ('frontend/images/logo/Logo-01.png')}}" alt="" style="height: 87px; width:200px; margin-left: -44px;">  --}}
                    
                    <small class="float-right">Date: {{ $text['date'] }}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{ $setting->website_name }}</strong><br>
                    {{ $setting->address }}<br>
                    Phone: {{ $setting->phone_one }}<br>
                    Email: {{ $setting->support_email }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{ $text['c_name'] }}</strong><br>
                    {{ $text['c_address'] }}<br>
                    Phone: {{ $text['c_phone'] }}<br>
                    Email: {{ $text['c_email'] }}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #{{ $text['order_id'] }}</b><br>
                  <br>
                  <b>Order ID:</b> {{ $text['order_id'] }}<br>
                  <b>Payment Due:</b> {{ $text['date'] }}<br>
                  <b>Account:</b> {{ $text['total'] }}
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      
                      <th>Qty</th>
                      <th>Product</th>
                      <th>Serial #</th>
                      <th>Description</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $row)
                            <tr>
                                
                                <td>{{ $row->qty }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->rowId }}</td>
                                <td>{{ "Null" }}</td>
                                <td>{{ $row->price }}</td>
                               
                            </tr>
                        @endforeach
                    
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="{{ asset('backend/dist/img/credit/visa.png') }}" alt="Visa">
                  <img src="{{ asset('backend/dist/img/credit/mastercard.png') }}" alt="Mastercard">
                  <img src="{{ asset('backend/dist/img/credit/american-express.png') }}" alt="American Express">
                  <img src="{{ asset('backend/dist/img/credit/paypal2.png') }}" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due {{ $text['date'] }}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>${{ $text['subtotal'] }}</td>
                      </tr>
                      <tr>
                        <th>Tax (0%)</th>
                        <td>$0</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$0</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>${{ $text['total'] }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  {{-- </div> --}}
  
  


<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
</body>
</html>
