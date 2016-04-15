<script type="text/javascript">
    function reload_script(){
    @if (empty($block))
        url_getNew = "{{Request::root()}}/comment/{{$script->id}}/getNew/1";
        url_sidebar = "{{Request::root()}}/comment/{{$script->id}}/script_list";
        idScript = {{$script->id}};
        isScript = 1;
    @else
        url_getNew = "{{Request::root()}}/comment/{{$block->id}}/getNew/0";
        url_sidebar = "{{Request::root()}}/comment/{{$block->id}}/block_list";
        idScript = {{$block->id}};
        isScript = 0;
    @endif

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
                        reload_script();
                    }
                });
            });
        });
    }

    function seen_script(i){
        $.ajax({
            method: "GET",
            url: "{{Request::root()}}/comment/"+i+"/seen",
            success: function(result){
                reload_script();
            }
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
    $(document).ready(function(){
        reload_script();
        $('#scrollBtn').click(function () {
            var scrollPos = document.body.scrollHeight;
            if ($('body').scrollTop() != 0) {
                scrollPos = 0;
            }
            $("html, body").animate({ scrollTop: scrollPos }, 1500);
        });
        $('.modal-trigger').leanModal();
    });
</script>