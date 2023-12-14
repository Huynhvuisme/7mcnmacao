<aside class="sidebar-right pt-4 px-2 px-md-0 w-md-300 d-flex flex-column">
    @if(getBanner('top-sidebar'))
        <div class="d-flex justify-content-center mb-3 mw-100" style="height:250px;">
            {!! getBanner('top-sidebar') !!}
        </div>
    @endif
    @if($listNhaCai->count())
        <div>
            @include('web.block._nhacai_sidebar', ['listNhaCai' => $listNhaCai])
        </div>
    @endif
    @if (!IS_MOBILE)
        @include('web.block._lich_thi_dau_sidebar')
    @endif
    @if(IS_MOBILE && !isset($home_page))
        @include('web.block._lich_thi_dau_sidebar')
    @endif
    @if(!empty($football_league_sidebar))
        <div class="aside-box mb-3">
            <a href="{{url('/')}}">
                <div class="font-20 font-weight-bold mb-2 d-flex align-items-center">
                    <span class="square-blue mr-2"></span>
                    <div class="ml-1 text-title">SOI KÈO BÓNG ĐÁ</div>
                </div>
            </a>
            <div class="asb-content p-2 bg-white follball-league">
                @foreach($football_league_sidebar as $item)
                    <p class="p-1 mb-2 football-sigle">
                        <a href="{{ $item->link }}" class="d-flex text-black align-items-center font-weight-bold">
                            {!! genImage($item->thumbnail, '40px', '40px', $item->title, 'img-fluid mr-3'); !!}
                            {{ $item->title }}
                        </a>
                    </p>
                @endforeach
            </div>
        </div>
    @endif

    @if (!empty($listKeoPhatGoc))
        @include('web.block._post', ['posts' => $listKeoPhatGoc, 'title'=> 'Kèo Phạt góc hôm nay', 'firstPost' => true])
    @endif
    @if (!empty($listKeoXien))
        @include('web.block._post', ['posts' => $listKeoXien, 'title'=> 'kèo xiên hôm nay', 'firstPost' => true])
    @endif
    @if (!empty($listDanhGiaNhaCai))
        @include('web.block._post', ['posts' => $listDanhGiaNhaCai, 'title'=> 'Đánh giá nhà cái'])
    @endif
    @if (!empty($listHuongDanCaCuoc))
        @include('web.block._post', ['posts' => $listHuongDanCaCuoc, 'title'=> 'Hướng dẫn cá cược', 'firstPost' => true, 'fullDes' => true])
    @endif
    @if(!empty($categoryAuthor))
        <div class="aside-box mb-3">
            <div class="font-20 font-weight-bold mb-2 d-flex align-items-center">
                <span class="square-blue mr-2"></span>
                <div class="ml-1 text-title">Chuyên gia Soi Kèo</div>
            </div>
            <div class="row mx-2">
                <div class="col-5 p-0">
                    {!! genImage($categoryAuthor->avatar_image, 300, 300, $categoryAuthor->name) !!}
                </div>
                <div class="col-7">
                    Pham Bách Phong - CEO & Co-Founder Soi Kèo Số. Hơn 10 năm kinh nghiệm soi kèo, nhận định bóng đá các trận cầu đinh.
                </div>
            </div>
        </div>
    @endif
</aside>
