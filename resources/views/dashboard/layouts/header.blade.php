<header class="navbar navbar-expand-md navbar-light">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a href="{{url('/')}}/dashboard" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3" style="font-size: 20px;">
     نظام الزيارات
    </a>
    <div class="navbar-nav flex-row order-md-last">

      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
          <span class="avatar" style=""></span>
          @if(isset(Auth::user()->id))
          <div class="d-none d-xl-block pl-2">

            <div style="font-size: 16px;">
              {{Auth::user()->name}}
            </div>
          </div>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#" onclick="event.preventDefault();
    																	 document.getElementById('logout-form').submit();">
                            @lang('site.logout')
                                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               											@csrf
                               										</form>
          </a>
        </div>
      </div>
    </div>
  </div>
</header>
