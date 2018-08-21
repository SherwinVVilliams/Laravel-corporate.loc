@extends(env('THEME').'.layouts.admin')

@section('navigation')
	{!! $navigation !!}
@endsection

@section('content')
	{!! $content ? $content : '' !!}
@endsection

@section('footer')
	{!! $footer !!}
@endsection