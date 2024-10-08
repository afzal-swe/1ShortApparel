
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    @php
      $website_info = DB::table('website_settings')->first();
      $order = DB::table('orders')->get();
      $message = DB::table('contacts')->get();
    @endphp
    <a href="{{ route('dashboard') }}" class="brand-link">
      @if ($website_info !== Null)
      <img src="" class="brand-image img-circle elevation-3" style="opacity: .8">
      {{-- <img src="{{ asset ($website_info->favicon)}}" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">{{ $website_info->website_name }}</span>
      @else
      <img src="{{ asset ('backend/dist/img/user2-160x160.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Testing Website</span>
      @endif
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('dashboard') }}" class="nav-link active">
              <p>Dashboard</p>
            </a>
          </li>




          {{-- Sales Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                User Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>


            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('role.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User & Parmission</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('manage.role') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage User Parmission</p>
                </a>
              </li>
            </ul>
          
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.view') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.review') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Review</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- Sales Section Start --}}
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Sales Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Sales</p>
                </a>
              </li>
            </ul>
          </li> --}}
          
          {{-- Sales Section End --}}

          @if (Auth::user()->product==1)
            
          {{-- Product Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Product Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="{{ route('brand.index') }}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Product Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Product Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('subcategory.index') }}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Sub Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehouse.all_warehouse') }}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Ware House</p>
                </a>
              </li>
              
            </ul>
          </li>
          {{-- Product Section End --}}
          @else
            
          @endif

          {{-- Customers Section Start --}}
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Customers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customers Information</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customers Wishlist</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customers Add to cart</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- Customers Section End --}}

          
          <li class="nav-item">
            <a href="{{ route('product.all_product') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Product Managment
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product_add') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.all_product') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Product</p>
                </a>
              </li>
            </ul>
          </li>
            
         

          @if (Auth::user()->order==1)
            
          {{-- Orders Section End --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">{{ count($order) }}</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_order.view') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Orders</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Orders Section End --}}
          @else
            
          @endif
          

          @if (Auth::user()->ticket==1)
            
          {{-- Tickets Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Ticket
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ticket.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ticket</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Tickets Section End --}}
          @else
          @endif

          @if (Auth::user()->contact==1)
            
          {{-- Contact Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Contact Message
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">{{ count($message) }}</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('contact.message') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Message</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Contact Section End --}}
          @else
          @endif



          
          <li class="nav-item">
            <a href="{{ route('main_profile') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Profile
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          
          {{-- Gallery Section Start --}}
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                File Manager
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Photo Gallery</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Video Gallery</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- Gallery Section End --}}

          @if (Auth::user()->blog==1)
          {{-- Blog Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_blog.category') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Blog Section End --}}
          @else
          @endif

          {{-- Mail Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('mail_mailbox') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Mail</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Mail Section End --}}


          @if (Auth::user()->offer==1)
            
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Offer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('coupon.all_coupon') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupon</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('campaign.all_campaign') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E Campaign</p>
                </a>
              </li>
            </ul>
          </li>
          @else
            
          @endif

          @if (Auth::user()->pickup==1)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pickup Point
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('all_pickup_point') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Pickup Point</p>
                </a>
              </li>
            </ul>
          </li>
          @else
          @endif


          @if (Auth::user()->report==1)
          {{-- Report Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Reports Section
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('order_report.view') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Order Report</p>
                </a>
              </li>
            </ul>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Report</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Report</p>
                </a>
              </li>
            </ul>--}}
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ticket_view.print') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ticket Report</p>
                </a>
              </li>
            </ul>  --}}
          </li>
          {{-- Report Section End --}}
          @else 
          @endif

          @if (Auth::user()->setting==1)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Setting Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('seo.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('social.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Social Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('website.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Website Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('page.all') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Page Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('smtp.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMTP Setting</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ route('payment.all') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Gateway</p>
                </a>
              </li> --}}
            </ul>
          </li>
            
          @else
            
          @endif


          

          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Login & Register
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{ route('admin.password_change') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="logout" href="{{ route('admin.logout') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>

              
                {{-- <li class="nav-item menu-open">
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <p class="nav-link active">Logout</p>
                        </x-dropdown-link>
                    </form>         
                </li> --}}
                
               
              </li>
              {{-- <li class="nav-item">
                <a href="pages/examples/register.html" class="nav-link">
                  
                </a>
              </li> --}}
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>