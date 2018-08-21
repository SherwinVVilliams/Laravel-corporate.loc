@extends(env('THEME').'.layouts.site')

@section('navigation')
	{!! $navigation !!}
@endsection

@section('content')
	{!! $content !!}
@endsection

@section('sidebar')
	{!! $sidebar !!}
@endsection

@section('footer')
	{!! $footer !!}
@endsection