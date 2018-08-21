@if(isset($menu))         
<div class="menu classic">
    <ul id="nav" class="menu">
        @foreach($menu as $item)
            <li>
                <a href="{{ $item['route'] }}">{{ $item['name'] }}</a>
            </li>
        @endforeach                           
    </ul>
</div>
@endif