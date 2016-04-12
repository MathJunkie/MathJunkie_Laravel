<ul id="dropdown_user" class="dropdown-content">
    <li><a href="#!"><i class="mdi-action-perm-identity right"></i>Profile</a></li>
    <li><a href="#!"><i class="mdi-action-settings right"></i>Options</a></li>
    <li class="divider"></li>
    <li><a type="submit" href="/auth/logout"><i class="mdi-action-exit-to-app right"></i>Log out</a></li>
</ul>

<div class="navbar-fixed">
    <nav class="teal">
        <div class="nav-wrapper">
            <a href="#!" class="left" style="position: relative; bottom: 15px;"><img class="circle" src="{{ URL::asset('images/Icon.png') }}" style="height: 100%;"></a>
            <form action="/script/home" method="get">
                <button type="submit" href="/script/home" class="btn waves-effect waves-light left" style="margin-left: 20px; margin-right: 10px;">Script builder</button>
            </form>
            <form action="/block/home" method="GET">
                <button type="submit" href="/block/home" class="btn waves-effect waves-light left" style="margin-left: 10px; margin-right: 10px;">Block builder</button>
            </form>
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

<script>
    $(document).ready(function(){
        $(".dropdown-button").dropdown();
        $('.carousel').carousel();
    });
</script>