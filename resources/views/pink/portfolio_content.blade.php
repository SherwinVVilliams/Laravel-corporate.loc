
 <div id="content-page" class="content group">
	<div class="clear"></div>
	<div class="posts">
		<div class="group portfolio-post internal-post">
			<div id="portfolio" class="portfolio-full-description">
			@if($portfolio)	                        
				<div class="fulldescription_title gallery-filters">
				    <h1>{{ $portfolio->title }}</h1>
				</div>
				                        
			<div class="portfolios hentry work group">
			    <div class="work-thumbnail">
				     <a class="thumb"><img src="{{ asset(env('THEME')) }}/images/projects/{{ $portfolio->img->path }}" alt="0081" title="{{ $portfolio->title }}" /></a>
				</div>
				<div class="work-description">
				    <p>{{ $portfolio->text }}</p>
				    <div class="clear"></div>
				    <div class="work-skillsdate">
				        <p class="skills"><span class="label">Skills:</span> {{ $portfolio->filter->title }}</p>
				        <p class="workdate"><span class="label">Customer:</span>{{ $portfolio->customer }}</p>
				        <p class="workdate"><span class="label">Year:</span> 2012</p>
				    </div>
				</div>
				<div class="clear"></div>
			</div>
			@endif	                        
		<div class="clear"></div>
			@if(count($portfolios) > 0)	                        
			<h3>{{ Lang::get('ru.other_projects')}}</h3>
			@foreach($portfolios as $item)	                        
			<div class="portfolio-full-description-related-projects">
				                 
				<div class="related_project">
					<a class="related_proj related_img" href="{{ route('portfolios.show', ['alias' => $item->alias]) }}" title="{{ $item->title }}"><img src="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->mini }}" alt="0061" title="0061" /></a>
					<h4><a href="{{ route('portfolios.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h4>
				</div>
				
			 </div>
			 @endforeach
			 @endif
		</div>
		<div class="clear"></div>
		</div>
	</div>
</div>