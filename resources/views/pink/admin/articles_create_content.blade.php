<div id = 'content-page' class = 'content group'>
	<div class = 'hentry group'>
		<form action="{{(isset($article->id)) ? route('admin.articles.update', ['articles' => $article->alias]) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class = 'contact-form'>
			<ul>
				<li class = 'text-field'>
					{{ csrf_field() }}
					<label for = 'name-contact-us'>
						<span class = 'label'>Название:</span>
						<br>
						<span class = 'sublabel'>Заголовок материала</span><br>
					</label>
					<div class = 'input-prepend'><span class = 'add-on'><i class = 'icon-user'></i></span>
						<input type="text" name="title" value = "{{ isset($article->title) ? $article->title : old('title') }}" placeholder="Input name of page" >
					</div>
				</li>
				<li class = 'text-field'>
					<label for = 'name-contact-us'>
						<span class = 'label'>Псевдоним:</span>
						<br>
						<span class = 'sublabel'>Заголовок материала</span><br>
					</label>
					<div class = 'input-prepend'><span class = 'add-on'><i class = 'icon-user'></i></span>
						<input type="text" name="alias" value = "{{ isset($article->alias) ? $article->alias : old('alias') }}" placeholder="Input alias of page" >
					</div>
				</li>
				<li class = 'text-field'>
					<label for = 'message-contact-us'>
						<span class = 'label'>Краткое описание:</span>
						<br>
					</label>
					<div class = 'input-prepend'>
						<textarea name="desc"  id = 'editor2' placeholder="Input description of page" >{{ isset($article->desc) ? $article->desc : old('desc') }}</textarea>
					</div>
				</li>
				<li class = 'text-field'>
					<label for = 'message-contact-us'>
						<span class = 'label'>Oписание:</span>
						<br>
					</label>
					<div class = 'input-prepend'>
						<textarea name="text" id = 'editor' placeholder="Input description of page" >{{ isset($article->text) ? $article->text : old('text') }}</textarea>
					</div>
				</li>
				@if(isset($article->img->path))
				<li class = 'text-field'>
					
					<span class = 'sublabel'>Изображение</span><br>
					<div class = 'input-prepend'>
					<img src = '{{ asset(env("THEME"))."/images/articles/".$article->img->max }}'>
					<input type="hidden" name = "old_image" value="{{ $article->img->path }}" >
					<p>{{ $article->img->path }}</p>
					</div>
				</li>
				@endif
				<li class = 'text-field'>
					<label for = 'name-contact-us'>
						<span class = 'label'>Изображение:</span>
						<br>
						<span class = 'sublabel'>Изображение материала</span><br>
					</label>
					<div class = 'input-prepend'>
						<input type="file" name="image" class = 'filestyle' data-button='filestyle' >
					</div>
				</li>
				<li class = 'text-field'>
					<label for = 'name-contact-us'>
						<span class = 'label'>Категории:</span>
						<br>
						<span class = 'sublabel'>Категории материала</span><br>
					</label>
					<div class = 'input-prepend'>
						<select name = 'category_id'>
							@foreach($categories as $category)
								@if(isset($article->category_id))
									@if($article->category_id == $category->id)
									<option  selected value ="{{ $category->id}}">{{ $category->title }}</option>
									@else 
									<option value="{{ $category->id}}">{{ $category->title }}</option>
									@endif
								@else
								<option value="{{ $category->id }}">{{ $category->title }} </option>
								@endif
							@endforeach
						</select>
					</div>
				</li>

				<li class = 'submit-button'>
					@if(isset($article->id))
						<input type="hidden" name="_method" value = "PUT">
					@endif
					<button type = 'submit' class = 'btn btn-success'>Сохранить</button>
				</li>
			</ul>
		</form>
	</div>
</div>
<script>
	CKEDITOR.replace( 'editor' );
	CKEDITOR.replace( 'editor2' );
</script>