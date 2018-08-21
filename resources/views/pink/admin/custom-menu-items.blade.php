
	<tr>
		<td style="text-align: left;">{{ $paddingLeft }}{{ $item->title }}</td>
		<td> {{ $item->url }} </td>
		<td><a href = "{{ route('admin.menus.edit', ['id' => $item->id]) }}" class = 'btn btn-french-1'>Edit</a></td>
		<td>
			<form action = "{{ route('admin.menus.destroy', ['id' => $item->id])}}" method = 'POST'>
				{{ csrf_field() }}
				{{ method_field('DELETE')}}
				<button type="submit" class = 'btn btn-frech-5'>Delete</button>
				
			</form>
		</td>
	</tr>
	@foreach($childMenus as $child)
		@if($child->parent == $item->id)
			@include(env('THEME').'.admin.custom-menu-items', array('item' => $child, 'childMenus' => $childMenus, 'paddingLeft' => '--' ))
		@endif
	@endforeach