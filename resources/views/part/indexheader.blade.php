
<div class="navbar ">
<header>
            <div class="container">

              <div id="branding">
                @if(Auth::check())
                <a href="{{route('user.logout')}}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span> Log Out </a>
                @else
            <a href="{{route('user.signup')}}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span> Sign Up </a>
            <a href= "{{route('user.signin')}}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span> Sign In </a>

              @endif
            <a href="{{route('admin.ShoppingCart')}}"><i class="fa fa-2x fa-shopping-cart"></i></a>
                              <lavel id="cart-badge" class="badge badge-warning">@{{totalCartItems}}</lavel>


              </div>


              <nav>
                <ul>
                <li><a href= "{{route('user.index')}}">HOME</a></li>
                <li class="current"><a href="{{route('index.about')}}">ABOUT<a></li>
                <li><a href="{{route('index.services')}}">SERVICES</a></li>

                </ul>
              </nav>
            </div>
          </header>
