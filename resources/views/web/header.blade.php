{{-- <div id="fb-root"></div> --}}
@php
    $url = $_SERVER['REQUEST_URI'];
@endphp
<header>

    <div class="p-0 pb-5 pb-md-4 pb-lg-5 ">

        <div class="d-none d-lg-flex header-banner justify-content-center align-items-center" style="min-height: 130px;">

            <a href="/">

                <img title="{{ getSiteSetting('site_logo_title')}}" class="img-fluid" src="/web/images/logo-header.jpg?1111" alt="{{ getSiteSetting('site_logo_alt')}}" width="1920" height="600">

            </a>

            {{-- <div class="d-flex text-white justify-content-center align-items-center" style="width: 728px;height:90px;">

                <?//php echo getBanner('header-pc')?>

            </div> --}}

        </div>

    </div>

</header>

<div class="mt-n5 mt-md-n4 mt-lg-n5 nav-menu position-sticky px-0 px-md-3" style="background: #1d1547">

    <nav class=" container navbar navbar-expand-lg navbar-dark  rounded-lg-top px-3 nav-menu position-sticky m-auto" style="background: #1d1547">

        <a class="navbar-brand navbar-toggler border-0 m-0 p-0" href="/">

            <img src="/web/images/logo-header.jpg?1111" class="img-fluid" alt="7mcn88" width="200" height="30">

        </a>

        <button class="navbar-toggler border-0 m-0 p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto w-100 justify-content-between">

                <li class="nav-item d-lg-none">

                    <form method="get" action="/tim-kiem" target="_top" class="form-inline my-2 d-flex flex-nowrap">

                        <input name="q" class="form-control mr-sm-2 font-13 text-white w-100 pl-3" style="background: none;border:none;" type="search" placeholder="Từ khóa tìm kiếm" aria-label="Search">

                        <button class="btn my-2 my-sm-0 p-0" type="submit"><img src="/web/images/icon-search.svg" alt="search icon" width="18" height="18"></button>

                    </form>

                </li>

                <li class="nav-item active d-none d-lg-block">
                    @if($url === '/casino-truc-tuyen-c4' || $url === '/nha-cai-uy-tin-c3')
                    <a class="nav-link" href="/">7M</a>
                    @else
                    <h2 class="mb-2"><a class="nav-link" href="/">7M</a></h2>
                    @endif
                </li>



                @if(!empty($mainMenuPc))

                    @foreach($mainMenuPc as $item)

                        <li class="nav-item d-none d-lg-block dropdown position-relative">
                            @if($url === '/casino-truc-tuyen-c4' || $url === '/nha-cai-uy-tin-c3')
                            <a class="nav-link text-uppercase px-2" title="{{$item['name']}}" href="{{$item['url']}}">{{$item['name']}}</a>
                            @else
                            <h2 class="mb-0"><a class="nav-link text-uppercase px-2" title="{{$item['name']}}" href="{{$item['url']}}">{{$item['name']}}</a></h2>
                            @endif
            
                            @if(!empty($item['children']))

                                <div class="dropdown-content position-absolute bg-green5">

                                    @foreach($item['children'] as $value)

                                        <a class="text-uppercase px-3 py-2 d-block nav-link" title="{{$value['name']}}" href="{{getFullUrl($value['url'])}}">{{$value['name']}}</a>

                                    @endforeach

                                </div>

                            @endif

                        </li>

                    @endforeach

                @endif



                @if(!empty($mainMenuMobile))

                    @foreach($mainMenuMobile as $item)

                    <li class="nav-item d-lg-none">

                        <a class="nav-link text-uppercase" title="{{$item['name']}}" href="{{getFullUrl($item['url'])}}">{{$item['name']}}</a>

                        @if(!empty($item['children']))

                            <div class="pl-3">

                                @foreach($item['children'] as $value)

                                    <a class="nav-link text-uppercase" title="{{$value['name']}}" href="{{getFullUrl($value['url'])}}">{{$value['name']}}</a>

                                @endforeach

                            </div>

                        @endif

                    </li>

                    @endforeach

                @endif

            </ul>

        </div>

    </nav>

</div>


