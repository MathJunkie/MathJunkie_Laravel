<ul id="dropdown_user" class="dropdown-content">
    <li><a href="#!"><i class="mdi-action-perm-identity right"></i>Profile</a></li>
    <li><a href="#!"><i class="mdi-action-settings right"></i>Options</a></li>
    <li class="divider"></li>
    <form action="/auth/logout" method="GET">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <li><a type="submit"><i class="mdi-action-exit-to-app right"></i>Log out</a></li>
    </form>
</ul>

<div class="navbar-fixed">
    <nav class="teal">
        <div class="nav-wrapper">
            <form action="/admin" method="GET">
                <input type="hidden" name="nav" value="admin">
                <button class="btn waves-effect waves-light left" type="submit" style="height: 100%; position: absolute; left: 0px;"><i class="mdi-navigation-arrow-back"></i></button>
            </form>
            <a href="{{Request::root()}}/admin" class="center brand-logo">MathJunkie</a>
            @if (Auth::check())
            <a class="dropdown-button right" href="#!" data-activates="dropdown_user" style="text-align: center; min-width:150px;">{{ Auth::user()->name }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
            @else
            <a class="btn waves-effect waves-light right" href="{{ Request::root() }}/login" type="submit" style="text-align: center; min-width:150px;">Sign in</a>
            @endif
            <a class="right btn-floating btn waves-effect waves-light red right" style="top: 15px;"></a>
        </div>
    </nav>
</div>

<script>
    $(document).ready(function(){
        $(".dropdown-button").dropdown();
        $('.carousel').carousel();
    });
</script>