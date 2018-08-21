@if(isset($menu))         
<div class="menu classic">
    <ul id="nav" class="menu">
        @foreach($menu as $item)
            @if($item->parent == 0)
            <li>
                <a href="{{ $item->path }}">{{ $item->title }}</a>
                @foreach($child_menu as $child)
                    @if($child['parent'] == $item->id)
                        <ul class="sub-menu">
                            @foreach($child_menu as $child)
                                @if($child['parent'] == $item->id)
                                    <li><a href = "{{ $child['path'] }}">{{$child['title']}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                        @break;
                    @endif
                @endforeach 
            </li>
            @endif
            <!--<ul class="sub-menu">
                <li><a href="home-ii.html">Home II</a></li>
                <li><a href="home-iii.html">Home III</a></li>
                <li><a href="home-iv.html">Home IV</a></li>
                <li><a href="home-v.html">Home V</a></li>
                <li><a href="home-vi.html">Home VI</a></li>
                <li><a href="home-vii.html">Home VII</a></li>
                <li><a href="home-viii.html">Home VIII</a></li>
                <li><a href="home-ix.html">Home IX</a></li>
                <li><a href="home-x.html">Home X</a></li>
                <li><a href="landing-page.html">Landing page</a></li>
             </ul>-->
        @endforeach                           
    </ul>
</div>
@endif