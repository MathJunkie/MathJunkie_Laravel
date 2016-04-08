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
        <div class="nav-wrapper row">
            <div class="col s6">
                <form action="/admin" method="GET">
                    <input type="hidden" name="nav" value="admin">
                    <button class="btn waves-effect waves-light"type="submit" style="height: 100%; position: absolute; left: 0px;"><i class="mdi-navigation-arrow-back"></i></button>
                </form>
            </div>
            <div class="col s2">
                <a href="{{Request::root()}}/admin" class="center brand-logo">MathJunkie</a>
            </div>
            <div class="col s5">
                <a class="right btn-floating btn waves-effect waves-light red navigation" style="top: 15px;"></a>
            </div>
            <div class="col s1">
                <a class="dropdown-button right" href="#!" data-activates="dropdown_user" style="text-align: center; min-width:150px;">{{ Auth::user()->name }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
            </div>
        </div>
    </nav>
</div>

<script>
    $(document).ready(function(){
        $(".dropdown-button").dropdown();
        $('.carousel').carousel();
    });
</script>