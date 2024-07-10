
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    @php
      $website_info = DB::table('website_settings')->first();
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

          {{-- Report Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Report Section
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Report</p>
                </a>
              </li>
              
            </ul>
          </li>
          {{-- Report Section End --}}

          {{-- Sales Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Sales Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Sales</p>
                </a>
              </li>
            </ul>
          </li>
          
          {{-- Sales Section End --}}

          {{-- Product Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Product Section
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product.all_product') }}" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Product Managment
                    <i class="right fas fa-angle-left"></i>
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
              <li class="nav-item">
                <a href="#" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>User Review</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Product Section End --}}

          {{-- Customers Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
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
          </li>
          {{-- Customers Section End --}}

          {{-- Orders Section End --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
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
          

          {{-- Tickets Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
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



          
          <li class="nav-item">
            <a href="{{ route('main_profile') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Profile
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          
          {{-- Gallery Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
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
          </li>
          {{-- Gallery Section End --}}

          {{-- Blog Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
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

          {{-- Mail Section Start --}}
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
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
              <li class="nav-item">
                <a href="{{ route('payment.all') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Gateway</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Login & Register Setting
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
              <li class="nav-item">
                <a href="pages/examples/register.html" class="nav-link">
                  
                </a>
              </li>
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>