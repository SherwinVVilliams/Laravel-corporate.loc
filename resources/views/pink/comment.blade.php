  @foreach($comments as $comment)	
  <li id = "li-comment-{{ $comment->id }} " class="comment even d{{ ($comment->user_id == $article->user_id) ? 'bypostauthor odd' : ''}}">
				                <div id = "comment-{{ $comment->id }}" class="comment-container">
				                    <div class="comment-author vcard">
				                    	@set($hash, isset($comment->email) ? md5($comment->email) : md5($comment->user->email))
				                        <img alt="" src="https://www.gravatar.com/avatar/{{ $hash }}?d=mm&s=75" class="avatar" height="75" width="75" />
                                         <cite class="fn">{{ $comment->user->name or $comment->name }}</cite>                 
				                    </div>
				                            <!-- .comment-author .vcard -->
				                    <div class="comment-meta commentmetadata">
				                        <div class="intro">
				                             <div class="commentDate">
				                                <a href="#">
{{ 'Sep 16, 2017 13:21'}}</a>                        
				                            </div>
				                            <div class="commentNumber">#&nbsp;</div>
				                        </div>
				                        <div class="comment-body">
				                            <p>{{$comment->text}}</p>
				                        </div>
				                        <div class="reply group">
		<a class="comment-reply-link" href="#respond" onclick="return addComment.moveForm(&quot;comment-{{ $comment->id }}&quot;, &quot;{{$comment->id}}&quot;, &quot;respond&quot;, &quot;{{$comment->article->id}}&quot;)">Reply</a>                    
				                        </div>
				                                <!-- .reply -->
				                    </div>
				                            <!-- .comment-meta .commentmetadata -->
				                </div>
				                @if(isset($com[$comment->id]))
				                	<ul class = 'children'>
										@include(env('THEME').'.comment', ['comments'=> $com[$comment->id]])
				                	</ul>
				                @endif  <!-- #comment-##  -->
				            </li>
@endforeach