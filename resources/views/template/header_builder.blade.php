<ul id="dropdown_user" class="dropdown-content">
    <li><a href="#!"><i class="mdi-action-perm-identity right"></i>Profile</a></li>
    <li><a href="#!"><i class="mdi-action-settings right"></i>Options</a></li>
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
            
            @if(empty($isView))
                <a class="left red darken-3 btn waves-effect waves-light mdi-action-delete" style="height: 100%;"></a>
            @endif
            <a href="{{Request::root()}}/admin" class="center brand-logo">MathJunkie</a>
            @if (Auth::check())
            <a class="dropdown-button right" href="#!" data-activates="dropdown_user" style="text-align: center; min-width:150px;">{{ Auth::user()->name }}<i class="mdi-navigation-arrow-drop-down right"></i></a>
            @else
            <a class="btn waves-effect waves-light right" href="{{ Request::root() }}/login" type="submit" style="text-align: center; min-width:150px;">Sign in</a>
            @endif
            <a id="side_trigger" href="#" data-activates="slide-out" class="right btn-floating btn waves-effect waves-light red" style="top: 15px; margin-right: 10px; margin-left: 10px;"></a>
        </div>
    </nav>
</div>
<div id="slide-out" class="grey side-nav darken-3">

</div>
<script>
    function edit_comment(i){
        $.ajax({
            method: "GET",
            url: "{{Request::root()}}/comment/"+i+"/update",
            data: {
                'text' : prompt("Please enter your updated Text", "")
            },
            success: function(result){
                reload_comment();
            }
        });
    }

    function seen_comment(i){
        $.ajax({
            method: "GET",
            url: "{{Request::root()}}/comment/"+i+"/seen",
            success: function(result){
                reload_comment();
            }
        });
    }

    function delete_comment(i){

        if (confirm("You sure?"))
        {
            $.ajax({
                method: "GET",
                url: "{{Request::root()}}/comment/"+i+"/delete",
                success: function(result){
                    reload_comment();
                }
            });
        }
    }
</script>

