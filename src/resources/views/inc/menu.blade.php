<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

        <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>


<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->

      <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        @if (Auth::guest())
            <li>
                <a href="{{ url(config('allay.base.route_prefix', 'admin').'/login') }}">
                    {{ trans('allay::base.login') }}
                </a>
            </li>
            @if (config('allay.base.registration_open'))
            <li>
                <a href="{{ url(config('allay.base.route_prefix', 'admin').'/register') }}">
                    {{ trans('allay::base.register') }}
                </a>
            </li>
            @endif
        @else
            <li>
                <a href="{{ url(config('allay.base.route_prefix', 'admin').'/logout') }}">
                    <i class="fa fa-btn fa-sign-out"></i>
                    {{ trans('allay::base.logout') }}
                </a>
            </li>
        @endif

       <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
