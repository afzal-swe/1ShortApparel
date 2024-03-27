<div class="card">
    <div class="card-header">Welcome , {{ Auth::user()->name }}</div>
    <div class="card-body">
         <img class="card-img-top" src="https://thumbs.dreamstime.com/b/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg">
         <ul class="list-group list-group-flush">
            <a href="{{ route('deshboard') }}" class="text-muted"> <li class="list-group-item"><i class="fas fa-home"></i> Dashboard</li></a>
            <a href="{{ route('user_info') }}" class="text-muted"> <li class="list-group-item"><i class="fas fa-home"></i> Profile</li></a>
            <a href="{{ route('wishlist.view') }}" class="text-muted"> <li class="list-group-item"> <i class="far fa-heart"></i> Wishlist</li></a>
            <a href="#" class="text-muted"> <li class="list-group-item"> <i class="fas fa-file-alt"></i>  My Order</li></a>
            
            <a href="{{ route('user.setting') }}" class="text-muted"> <li class="list-group-item"><i class="fas fa-edit"></i> Setting</li> </a>
            <a href="#" class="text-muted"> <li class="list-group-item"> <i class="fab fa-telegram-plane"></i> Open Ticket</li> </a>
            <a href="{{ route('customer.logout') }}" class="text-muted"> <li class="list-group-item"> <i class="fas fa-sign-out-alt"></i> Logout</li> </a>
           </ul>
     
    </div>
</div>