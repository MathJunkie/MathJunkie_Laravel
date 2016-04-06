<!DOCTYPE html>
<html lang="de">
<head>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('css/builder/home.css') }}"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="utf-8">
    <title>Blöcke Home</title>
</head>
<body class="grey darken-4">
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

    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/materialize.min.js') }}"></script>
<script type="text/javascript">
    $('#search').keypress(function(){
        $('#ownBlock').html('');
        if ($(this).val().length < 2)
        {
            return;
        }
        $.ajax({
            url: "{{Request::url()}}/list?search="+$('#search').val(),
            success: function(result){
                for (var i = 0; i < result.length; i++){
                    $('#ownBlock').append('<a href="{{Request::url()}}/'+result[i].id+'" class="collection-item"><h3>'+result[i].name+'</h3><p>'+result[i].description+'</p></a>');

                }
            }
        })
    })
</script>
@foreach ($errors->all() as $error)
    <script>Materialize.toast("{{$error}}",3000)</script>
@endforeach
</body>
</html>