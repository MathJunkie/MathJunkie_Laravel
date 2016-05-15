<ul id="dropdown_user" class="dropdown-content">
    <li><a ><i class="mdi-action-perm-identity right"></i>Profile</a></li>
    <li><a ><i class="mdi-action-settings right"></i>Options</a></li>
    <li class="divider"></li>
    <li><a type="submit" href="/auth/logout"><i class="mdi-action-exit-to-app right"></i>Log out</a></li>
</ul>

<div class="navbar-fixed">
    <nav class="teal">
        <div class="nav-wrapper">
            @if(empty($block))
            <a href="/script" class="blue darken-3 btn waves-effect waves-light left mdi-navigation-arrow-back" style="height: 100%;"></a>
            @else
            <a href="/block" class="blue darken-3 btn waves-effect waves-light left mdi-navigation-arrow-back" style="height: 100%;"></a>
            @endif
                <a href="{{Request::root()}}/admin" class="hide-on-med-and-down center brand-logo">MathJunkie</a>
            @if (Auth::check())
            <a class="dropdown-button right" href="" data-activates="dropdown_user" style="text-align: center; min-width:150px;">{{ Auth::user()->name }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
            @else
            <a class="btn waves-effect waves-light right" href="{{ Request::root() }}/login" type="submit" style="text-align: center; min-width:150px;">Sign in</a>
            @endif
            <a id="side_trigger" href="#" data-activates="slide-out" class="right btn-floating btn waves-effect waves-light red" style="top: 15px; margin-right: 10px; margin-left: 10px;"></a>

                @if(empty($isView))
                    <a id="scrollBtn" class="left teal darken-3 btn waves-effect waves-green mdi-editor-border-bottom" style="height: 100%"></a>
                    <a class="waves-effect waves-light btn modal-trigger mdi-action-help left green btn waves-effect waves-green" style="height: 100%" ></a>
                    <a onclick="if (confirm('Do you really want to delete it?'))window.location = '{{Request::url()}}/delete'" class="left red darken-3 btn waves-effect waves-light mdi-action-delete" style="height: 100%;"></a>
                    @if(empty($block))
                        <a onclick="if (prompt('Save the link?', '{{Request::url()}}/view'))return true" class="right blue darken-1 btn waves-effect waves-light mdi-social-share" style="height: 100%;"></a>
                    @endif
                @else
                    <a onclick="window.print()" class="left blue darken-3 btn waves-effect waves-light mdi-action-print" style="height: 100%;"></a>
                @endif

        </div>
    </nav>
</div>
@if(empty($isView))
<div id='slider' class="white">
    <iframe src="https://wiki.bomberus.de" height="100%" width="500"></iframe>
</div>
@endif
<div id="slide-out" class="grey side-nav darken-3">

</div>