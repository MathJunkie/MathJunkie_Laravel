    function reload_script(url_getNew, url_sidebar, idScript, isScript){
        $('#side_trigger').load(url_getNew);
        $('#slide-out').load(url_sidebar, function(){
            $("#side_trigger").sideNav({
                menuWidth: 300, // Default is 240
                edge: 'right' // Choose the horizontal origin
            });

            $("#comment_btn").click(function(){
                $.ajax({
                    method: "GET",
                    url: "{{Request::root()}}/comment",
                    data: {
                        'text' : $('#comment').val(),
                        'isScript' : isScript,
                        'idScript' : idScript
                    },
                    success: function(result){
                        reload_comment();
                    }
                });
            });
        });
    }

    function edit_script(i){
        $.ajax({
            method: "GET",
            url: "{{Request::root()}}/comment/"+i+"/update",
            data: {
                'text' : prompt("Please enter your updated Text", "")
            },
            success: function(result){
                reload_script();
            }
        });
    }

    function delete_script(i){

        if (confirm("You sure?"))
        {
            $.ajax({
                method: "GET",
                url: "{{Request::root()}}/comment/"+i+"/delete",
                success: function(result){
                    reload_script();
                }
            });
        }
    }
@if (empty($block))
    reload_script("{{Request::root()}}/comment/{{$script->id}}/getNew/1","{{Request::root()}}/comment/{{$script->id}}/script_list",{{$script->id}},1);
@else
    reload_script("{{Request::root()}}/comment/{{$block->id}}/getNew/0","{{Request::root()}}/comment/{{$block->id}}/block_list",{{$block->id}},0);
@endif