<p class="orange darken-3 white-text center-align flow-text">Comments</p>
<div class="collection grey darken-3 black-text" style="border-style:none;">
    @foreach($kommentar as $comment)
        <div class="collection-item @if($comment->seen) grey lighten-2 @else white @endif" style="margin-bottom: 10px;">
            <span class="flow-text">{{$comment->user->name}}</span>
            <p>{{$comment->text}}</p>
            <div class="divider"></div>
                                <span class="row">
                                    @if(($is_scriptowner) && !$comment->seen)
                                        <a class="col s2 mdi-image-remove-red-eye" onclick="seen_script({{$comment->id}})"></a>
                                    @endif
                                    @if (Auth::check())
                                        @if($comment->user_id == Auth::user()->id)
                                            <a class="col s2 mdi-editor-mode-edit" onclick="edit_script({{$comment->id}})"></a>
                                            <a class="col s2 mdi-action-delete" onclick="delete_script({{$comment->id}})"></a>
                                        @endif
                                    @endif
                                    <p class="col offset-s2 s4">22.03.2016</p>
                                </span>
        </div>
    @endforeach
</div>
<div>
    <p class="white-text flow-text">Write a Comment</p>
    <div class="row white-text">
        <div class="input-field col s12">
            <textarea rows="2" name="comment_text" id="comment" class="materialize-textarea"></textarea>
        </div>
        <button id="comment_btn" class="col s12 green btn waves-effect waves-light" type="submit" name="action">Send Comment
            <i class="right mdi-content-send"></i>
        </button>
    </div>
</div>