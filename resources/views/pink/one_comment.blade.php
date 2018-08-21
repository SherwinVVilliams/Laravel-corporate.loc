  <li id = "li-comment-{{ $data['id'] }} " class="comment even borGreen" style = "border: 2px solid green">
	<div id = "comment-{{ $data['id']}}" class="comment-container">
		<div class="comment-author vcard">
			<img alt="" src="https://www.gravatar.com/avatar/{{ $data['hash'] }}?d=mm&s=75" class="avatar" height="75" width="75" />
                <cite class="fn">{{ $data['name'] }}</cite>
		</div>
	<div class="comment-meta commentmetadata">
		<div class="intro">
			<div class="commentDate">
				<a href="#">
{{ 'Just Now'}}</a>                        
			</div>
			<div class="commentNumber">#&nbsp;</div>
		</div>
			<div class="comment-body">
				<p>{{$data['text']}}</p>
			</div>
	</div>
	</div>
</li>