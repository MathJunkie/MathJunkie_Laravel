<ul id="dropdown_user" class="dropdown-content">
    <li><a href="#!"><i class="mdi-action-perm-identity right"></i>Profile</a></li>
    <li><a href="#!"><i class="mdi-action-settings right"></i>Options</a></li>
    <li class="divider"></li>
    <li><a type="submit" href="/auth/logout"><i class="mdi-action-exit-to-app right"></i>Log out</a></li>
</ul>

<div class="navbar-fixed">
    <nav class="teal">
        <div class="nav-wrapper" style="padding-top:10px">
            <a href="#!" class="left" style="position: relative; bottom: 5px; left: 5px;"><img class="circle" src="{{ URL::asset('images/Icon.png') }}" style="height: 100%;"></a>
            <a href="/script" class="btn waves-effect waves-light left" style="margin-left: 20px; margin-right: 10px;">Script builder</a>
            <a href="/block" class="btn waves-effect waves-light left" style="margin-left: 10px; margin-right: 10px;">Block builder</a>
            @if (Auth::check())
            <a class="dropdown-button right" href="#!" data-activates="dropdown_user" style="position: relative; bottom: 15px; text-align: center; min-width:150px;">{{ Auth::user()->name }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
            @else
            <a class="btn waves-effect waves-light right" href="{{ Request::root() }}/login" type="submit" style="position: relative; bottom: 15px; text-align: center; min-width:150px;">Sign in</a>
            @endif
            <a class="btn-floating btn waves-effect waves-light red right"></a>
            <a href="{{Request::root()}}/admin" class="right brand-logo" style="position: relative; bottom: 15px; margin-left: 20px; margin-right: 10px;">MathJunkie</a>
        </div>
    </nav>
</div>