<div id = "content-page" class = 'content-group'>
	<div class = 'hentry group'>
		<h2>Добавленные статьи</h2>
		<div class = 'short-table white'>
			<table style = 'width: 100%' cellpadding="0" cellspacing="0">
				@if($articles)
				<thead>
					<tr>
						<th class = 'align-left'>ID</th>
						<th>Заголовок</th>
						<th>Текст</th>
						<th>Изображение</th>
						<th>Категории</th>
						<th>Псевдоним</th>
						<th colspan="2">Действие</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $article)
					<tr class = 'align-left' id = "{{ $article->alias }}">
						<td class = 'align-left'>{{ $article->id }}</td>
						<td class = 'align-left'>{{ $article->title }}</a></td>
						<td class = 'align-left'>{{ str_limit($article->text, 150) }}</td>
						<td class = 'align-left'>
							@if(isset($article->img->path))
							<img src = "{{ asset(env('THEME'))}}/images/articles/{{ $article->img->mini }}">{{ $article->img->path }}
							@else
							{{ 'empty'}}
							@endif
							</td>
						<td class = 'align-left'>{{ $article->category->title }}</td>
						<td class = 'align-left'>{{ $article->alias }}</td>
						<td class = 'align-left'>
							<a href = "{{ route('admin.articles.edit', ['articles' => $article->alias]) }}"class = 'btn btn-primary'>Редактировать</a>
						</td>
						<td class = 'align-left' id = "{{ $article->alias}} ">
							<form action = "{{ route('asyncDeleteArticle') }}" method = "post" id="deleteForm">
								{{ csrf_field() }}
								<input type = 'hidden' name = 'article_alias' id = 'article_alias' value = "{{ $article->alias }}">
								<input type="submit" name="btn_del" class = 'btn btn-french-5' id = 'btn_del' value = 'Удалить'>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
				@endif
		</div>
	</div>	
		<a href = '{{ route("admin.articles.create") }}' class = 'btn btn-french-1'>Добавить статью</a>
</div>