<div class="brand-logo center"><img height="50px" src="{{URL::asset('images/Icon.png')}}" style="vertical-align: middle;"  alt="Logo"/>
    <span class="center-align shadow-text">Builder</span></div>
<ul class="right">
    <li><a href="#" onclick="window.print();"><i class="mdi-action-print"></i></a></li>
    @if($type == 'script')
        <li><a href="#" onclick="if (prompt('Save the link?', '{{Request::root()}}/{{$type}}/{{$id}}/view'))return true"><i class="mdi-social-share small white-text"></i></a></li>
    @endif
    @if($is_scriptowner)
    <li><a href="#" onclick="if (confirm('Möchtest du wirklich löschen?'))window.location = '{{Request::root()}}/{{$type}}/{{$id}}/delete'"><i class="mdi-action-delete small white-text"></i></a></li>
    @endif
    <li><a href="#" data-activates="slide-out" class="button-collapse small show-on-large">Comments<span class="new badge">{{$countNew}}</span></a></li>
</ul>
<ul class="left">
    <li><a href="{{Request::root()}}/{{$type}}"><i class="mdi-navigation-arrow-back small white-text"></i></a></li>
</ul>
<div id="slide-out" class="grey side-nav darken-3">
    <p class="orange darken-3 center-align flow-text">Comments</p>
    <div class="collection grey darken-3 black-text" style="border-style:none;">
        @foreach($kommentar->all() as $comment)
            <div class="collection-item @if($comment->seen) grey lighten-2 @else white @endif" style="margin-bottom: 10px;">
                <span class="flow-text">{{$comment->owner}}</span>
                <p>{{$comment->text}}</p>
                <div class="divider"></div>
                                <span class="row">
                                    @if($is_scriptowner && !$comment->seen)
                                        <a class="col s2 mdi-image-remove-red-eye" onclick="seen_comment({{$comment->id}})"></a>
                                    @endif
                                    @if($comment->owner == $user_email)
                                        <a class="col s2 mdi-editor-mode-edit" onclick="edit_comment({{$comment->id}})"></a>
                                        <a class="col s2 mdi-action-delete" onclick="delete_comment({{$comment->id}})"></a>
                                    @endif
                                    <p class="col offset-s2 s4">22.03.2016</p>
                                </span>
            </div>
        @endforeach
    </div>
    <div>
        <p>Write a Comment</p>
        <div class="row">
            <div class="input-field col s12">
                <textarea rows="2" name="comment_text" id="comment" class="materialize-textarea"></textarea>
            </div>
            <button id="comment_btn" class="col s12 green btn waves-effect waves-light" type="submit" name="action">Send Comment
                <i class="right mdi-content-send"></i>
            </button>
        </div>
    </div>
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