<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/builder/home.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/jquery.webui-popover.min.css') }}"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Blöcke Home</title>
</head>
<body class="teal darken-2">
    @include('template/header_home')
    <form action="/block" method="post" id="mainContainer" class="container row">
        <div class="col s8 nav-wrapper">
            <div>
                <div class="input-field">
                    <input id="search" name="search" type="search" required>
                    <label for="search"><i class="mdi-action-search"></i></label>
                    <i class="mdi-navigation-close"></i>
                </div>
            </div>
        </div>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="Create" id="create_block" class="btn green col s4"/>
    </form>
    <ul id="ownBlock" class="collection">
    </ul>

    @include('template/script_home_footer')
    <script type="text/javascript">
    $('#search').keypress(function(){
        if ($(this).val().length < 2) {
            return;
        }
        $.ajax({
            url: "{{Request::root()}}/block/list?search="+$('#search').val(),
            success: function(result){
                $('#ownBlock').html('');
                var html = '';
                for (var i = 0; i < result.length; i++){
                    html += '<a href="{{ Request::root() }}/block/'+result[i].id+'" class="collection-item"><h3>'+result[i].name+'</h3><p>'+result[i].description+'</p></a>';
                }
                $('#ownBlock').html(html);
            }
        })
    });
    $('#home_comment_btn').webuiPopover({
        type:'async',
        animate:'pop',
        url:'{{Request::root()}}/admin/getNews/0'
    });
    </script>
    @include('template/footer_main')
</body>
</html>