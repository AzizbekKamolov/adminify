<div class="page-sidebar">
    <a class="logo-box" href="{{ route('dashboard.index') }}">
        <span><img src="{{ asset('assets/images/logo-white.png')}}" alt=""></span>
        <i class="ion-aperture" id="fixed-sidebar-toggle-button"></i>
        <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li @if(request()->routeIs('dashboard.index')) class="active" @endif >
                    <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i>
                        <span>{{__('form.dashboard')}}</span></a>
                </li>
                @canany(['roles.index','permissions.index','users.index'])
                    <li class="@if(request()->routeIs('roles.*','permissions.*','users.*')) active open @endif">
                        <a href="javascript:void(0);"><i class="fa fa-cogs"></i>
                            <span>{{__('form.settings')}}</span><i class="accordion-icon fa fa-angle-left"></i></a>
                        <ul class="sub-menu" style="display:block">
                            @can('users.index')
                                <li @if(request()->routeIs('users.*')) class="active" @endif ><a
                                        href="{{ route('users.index') }}">{{__('form.users.users')}}</a></li>
                            @endcan
                            @can('roles.index')
                                <li @if(request()->routeIs('roles.*')) class="active" @endif ><a
                                        href="{{ route('roles.index') }}">{{__('form.roles.roles')}}</a></li>

                            @endcan
                            @can('permissions.index')
                                <li @if(request()->routeIs('permissions.*')) class="active" @endif ><a
                                        href="{{ route(('permissions.index')) }}">{{__('form.permissions.permissions')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

            </ul>
        </div>
        <!--================================-->
        <!-- Sidebar Information Summary -->
        <!--================================-->

    </div>
    <!--================================-->
    <!-- Sidebar Footer Start -->
    <!--================================-->
    <div class="sidebar-footer">
        <a class="pull-left" href="{{ route('user.profile') }}" data-toggle="tooltip" data-placement="top"
           data-original-title="{{ __('form.my_profile') }}">
            <i class="icon-user"></i></a>
        <a class="pull-left" href="{{ route('auth.logout') }}" data-toggle="tooltip" data-placement="top"
           data-original-title="{{__('auth.logOut')}}">
            <i class="icon-power"></i></a>
    </div>
    <!--/ Sidebar Footer End -->
</div>
