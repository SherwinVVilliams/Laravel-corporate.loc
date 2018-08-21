<div id = 'content-page' class = 'content-group'>
		<div class = 'hentry group'>
			<h3 class = 'title_page'>Меню</h3>
			<div class = 'short-table white'>
				<table style="width: 100%;" cellspacing= '0' cellpadding="0">
					<thead>
						<th>Name</th>
						<th>Link</th>
						<th colspan="2">Operation</th>
					</thead>
					<tbody>
						@if($menu)
							@foreach($menu as $item)

							@if($item->parent == 0)
@include(env('THEME').'.admin.custom-menu-items', ['item' => $item, 'childMenus' => $childMenus, 'paddingLeft' => ''])
							@endif

							@endforeach
						@endif
					</tbody>
				</table>
				<a href = "{{ route('admin.menus.create') }}" class = 'btn btn-french-3'>Add</a>
			</div>
		</div>
</div>