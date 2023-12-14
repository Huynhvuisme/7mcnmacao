<div class="aside-box mb-3">
    <div class="font-20 font-weight-bold mb-2 d-flex align-items-center">
        <span class="square-blue mr-2"></span>
        <span class="text-title">TOP NHÀ CÁI</span>
    </div>
    <div class="asb-content">
        @foreach($listNhaCai as $key => $item)
        @php $content = json_decode($item->content) @endphp
        <div class="mb-3 border-bottom-doted pb-3 container container-nhacai">
            <div class="row">
                <div class="col-6 bg-white py-2 align-items-center position-relative border">
                    <a href="{{$content->link_bet}}" target="_blank" rel="nofollow">
                        <div class="nhacai-medal text-hover icon-bookmark @if($key > 2) bg-img-green @endif">{{ $key + 1 }}</div>
                        {!! genImage( $content->logo, 300, 300, $item->name)!!}
                    </a>
                </div>
                <div class="col-6 pr-0 d-flex flex-column justify-content-around">
                    <span class="text-dark text-dark font-weight-bold">{{ $item->name }}</span>
                    <div class="font-description child-no-margin">{!! $content->description !!}</div>
                    <a {!! !empty($content->link_bet) ? 'href="'.$content->link_bet.'"' : '' !!} target="_blank" rel="nofollow" class="d-block text-white bg-green p-2">Chơi ngay</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
