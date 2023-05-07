<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0">
        {{-- <img src="{{asset("images/logo.png")}}" class="navbar-brand-img h-100" alt="main_logo"> --}}
        <span class="ms-1 font-weight-bold text-white">KouFood</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{url('/')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">home</i>
            </div>
            <span class="nav-link-text ms-1">Ana Sayfa</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('dashboard') ? 'active  bg-gradient-primary' : ''}}" href="{{url('dashboard')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Gösterge Paneli</span>
          </a>
        </li>
        <li class="nav-item">
          <a 
            class="nav-link text-white 
            {{Request::is('categories') ? 'active  bg-gradient-primary' : ''}}
            {{Request::is('addCategory') ? 'active  bg-gradient-primary' : ''}}
            {{Request::is('editCategory/*') ? 'active  bg-gradient-primary' : ''}}
            {{Request::is('deleteCategory/*') ? 'active  bg-gradient-primary' : ''}}
            "
            href="{{url('categories')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Kategoriler</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white
           {{ Request::is('products') ? 'active  bg-gradient-primary':'' }}
           {{ Request::is('addProduct') ? 'active  bg-gradient-primary':'' }}
           {{ Request::is('editProduct/*') ? 'active  bg-gradient-primary':'' }}
           {{ Request::is('deleteProduct/*') ? 'active  bg-gradient-primary':'' }}
           "
           href="{{ url('products') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">apps</i>
            </div>
            <span class="nav-link-text ms-1">Ürünler</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white
           {{ Request::is('orders') ? 'active  bg-gradient-primary':'' }}
           {{ Request::is('admin/order_details/*') ? 'active  bg-gradient-primary':'' }}
           "
           href="{{ url('orders') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">shopping_cart</i>
            </div>
            <span class="nav-link-text ms-1">Siparişler</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white
           {{ Request::is('users') ? 'active  bg-gradient-primary':'' }}
           {{ Request::is('view_user/*') ? 'active  bg-gradient-primary':'' }}
           "
           href="{{ url('users') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">people</i>
            </div>
            <span class="nav-link-text ms-1">Kullanıcılar</span>
          </a>
        </li>
      </ul>
    </div>
    
  </aside>