<div id = 'content-page' class = 'content group'>
	<div class = 'hentry group'>
		<h3 class = 'title_page'>Привилегии</h3>
		<form action="{{ route('admin.permissions.store') }}" method = 'POST'>
			{{ csrf_field() }}
			<div class = 'short-table white'>
				<table style = 'width: 100%'>
					<thead>
						<th>Привилегии</th>
						@if(!$roles->isEmpty())
							@foreach($roles as $role)
								<th>{{$role->name }}</th>
							@endforeach
						@endif
					</thead>
					<tbody>
						@if(!$permissions->isEmpty())
							@foreach($permissions as $perm)
							<tr>
								<td>{{ $perm->name }}</td>
								@foreach($roles as $role)
								<td>
									@if($role->hasPermission($perm->name))
									<input type="checkbox" id="" name = "{{ $role->id }}[]" value = " {{ $perm->id }}" checked>
									@else
									<input type="checkbox" name = "{{ $role->id}}[]" value="{{ $perm->id }}"  >
									@endif
								</td>
								@endforeach
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<input type="submit" class = 'btn btn-the-salmon-dance-3' value = 'Обновить'>
		</form>
	</div>
</div>