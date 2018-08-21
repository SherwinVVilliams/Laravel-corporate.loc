  
<div class="widget-first widget recent-posts">
	<div class="recent-post group">
		<h3>{{ Lang::get('ru.latest_projects') }}</h3>
			<br>
			@if(!$portfolios->isEmpty())
				@foreach($portfolios as $portfolio)
				<div class="hentry-post group">
					<div class="thumb-img"><img src="{{ asset(env('THEME')) }}/images/projects/{{ $portfolio->img->mini }}" alt="001" title="001" style = "width: 55px "/></div>
					<div class="text">
					    <a href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}" title="{{ $portfolio->title }}" class="title">Section shortcodes &amp; sticky posts!</a>
					    <p>{{ str_limit($portfolio->text, 80) }}</p>
					    <a class="read-more" href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}">&rarr; {{Lang::get('ru.read_more')}}</a>
					</div>
				</div>
				@endforeach
			@endif
	</div>
</div>
				            
				          @if(!$comments->isEmpty())
	<div class="widget-last widget recent-comments">
		<h3>{{ Lang::get('ru.articles_latest_comments')}}</h3>
		<div class="recent-post recent-comments group">
            @foreach($comments as $comment)
				<div class="the-post group">
				    @set($hash, ($comment->email) ? md5($comment->email) : $comment->user->email)
				    <div class="avatar">
				        <img alt="" src="https://www.gravatar.com/avatar/{{ $hash }}?d=mm&s=55" class="avatar" />   
				    </div>
				    <span class="author"><strong><a href="#">{{ $comment->user ? $comment->user->name : $comment->name }}</a></strong> in</span> 
				    <a class="title" href="{{ route('articles.show', ['alias' => $comment->article->alias ])}}">{{ $comment->article->title }}</a>
				    <p class="comment">{{ $comment->text }} <a class="goto" href="{{ route('articles.show', ['alias' => $comment->article->alias ])}}"">&#187;</a>
                    </p>
				</div>
			@endforeach
		</div>
	</div>
@endif
				            
