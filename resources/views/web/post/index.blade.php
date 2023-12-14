@extends(TEMPLATE)
@section('content')
    @include('web.block._schema_post')
    <div class="container p-0 px-md-3">
        <div class="d-block d-lg-flex justify-content-between">
        <div class="main-content mt-2 mt-md-4 mr-md-4 p-3 p-md-0">
            @if(isset($breadcrumb) && !empty($breadcrumb))
                {!! getBreadcrumb($breadcrumb) !!}
            @endif
            <div class="row">
                <div class="col-12 col-md-11">
                    <div class="single-header">
                        <h1 class="font-30 font-weight-bold">{{$oneItem->title}}</h1>
                        <div class="font-13 d-flex text-gray3 mb-3">
                        <img class="mr-2" src="/web/images/icon-time.svg" alt="time icon">
                        {{ date('d/m/Y H:i',strtotime($oneItem->displayed_time)) }}
                        <b class="ml-2 mb-0 fw-bold" style="color:black;">Tác giả: Trịnh Tuấn</b>
                        </div>
                        <div class="font-weight-bold mb-3 font-16">{!! $oneItem->description !!}</div>
                    </div>
                    @if(!empty($match))
                        <div class="border d-none d-lg-flex flex-wrap mb-3">
                            <div class="col-5 border-right d-flex flex-wrap px-0 text-center">
                                <div class="col-6 py-3">
                                    {!! genImage($match->team_home_logo, 70, 70, $match->team_home_name, 'img-fluid') !!}
                                    <span class="font-weight-bold font-14 d-block">{!! $match->team_home_name !!}</span>
                                </div>
                                <div class="col-6 py-3">
                                    {!! genImage($match->team_away_logo, 70, 70, $match->team_away_name, 'img-fluid') !!}
                                    <span class="font-weight-bold font-14 d-block">{!! $match->team_away_name !!}</span>
                                </div>
                            </div>
                            <div class="col-7 d-flex flex-wrap px-0">
                                <div class="col-6 d-flex pr-0">
                                    <div class="bg-gray1 rounded p-3 align-self-center">
                                        <span class="font-weight-bold d-block mb-2">{!! $match->tournament !!}</span>
                                        <span class="font-weight-bold d-block font-14">
                                            <img class="mr-1" src="/web/images/icon-time.svg" alt="time icon" width="18" height="18">
                                            {{ date('H:i | d/m/Y',strtotime($match->scheduled)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6 text-right d-flex flex-column justify-content-center">
                                    <span class="mb-2 font-14"><b>{{ $match->hdc_asia }}</b> (Châu Á)</span>
                                    <span class="mb-2 font-14"><b>{{ $match->hdc_eu }}</b> (Châu Âu)</span>
                                    <span class="font-14"><b>{{ $match->hdc_tx }}</b> (Tài xỉu)</span>
                                </div>
                            </div>
                        </div>
                        <div class="border d-flex d-lg-none flex-wrap mb-3 p-2">
                            <div class="col-3 p-2 text-center">
                                <img class="mb-2" src="{{ $match->team_home_logo }}" width="50" height="50">
                                <span class="font-weight-bold font-14 d-block overflow-hidden">{!! $match->team_home_name !!}</span>
                            </div>
                            <div class="font-14 col-6 px-0 text-center d-flex flex-column justify-content-center">
                                <span class="mb-1"><b>{{ $match->hdc_asia }}</b> (Châu Á)</span>
                                <span class="mb-1"><b>{{ $match->hdc_eu }}</b> (Châu Âu)</span>
                                <span><b>{{ $match->hdc_tx }}</b> (Tài xỉu)</span>
                            </div>
                            <div class="col-3 p-2 text-center">
                                <img class="mb-2" src="{{ $match->team_away_logo }}" width="50" height="50">
                                <span class="font-weight-bold font-14 d-block overflow-hidden">{!! $match->team_away_name !!}</span>
                            </div>
                            <div class="col-12 bg-gray1 d-flex justify-content-between py-2">
                                <span class="font-weight-bold">{!! $match->tournament !!}</span>
                                <span class="font-weight-bold font-16">
                                    <img class="mr-1" src="/web/images/icon-time.svg" alt="time icon" width="18" height="18">
                                    {{ date('H:i | d/m/Y',strtotime($match->scheduled)) }}
                                </span>
                            </div>
                        </div>
                    @endif
                    @if(!empty($extra_post_after) || !empty($extra_post_before))
                        <ul class="bg-gray1 py-2">
                            @if(!empty($extra_post_before))
                                @foreach($extra_post_before as $value)
                                    <li>
                                        <a href="{{ getUrlPost($value) }}" title="{!! $value->title !!}">{!! $value->title !!}</a>
                                    </li>
                                @endforeach
                            @endif
                            @if(!empty($extra_post_after))
                                @foreach($extra_post_after as $value)
                                    <li>
                                        <a href="{{ getUrlPost($value) }}" title="{!! $value->title !!}">{!! $value->title !!}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endif

                    <div class="line-height-24 entry-content">
                        @if(request()->has('lich-su-doi-dau'))
                            {!! tableOfContent(preg_replace('#<strong>(.*?)Lịch sử đối đầu(.*?)</strong>#',
                                                            '<strong id="lich-su-doi-dau">Lịch sử đối đầu:</strong>',
                                                            $oneItem->content)) !!}
                        @else
                            {!! tableOfContent($oneItem->content) !!}
                        @endif
                    </div>
                    <div class="tag col-sm-12 border-bottom py-3">
                        <strong>Tag:</strong>
                        @foreach ($oneItem->tags as $tag)
                            <span><a href="{{getUrlTag($tag)}}">{{$tag->title}} </a> </span>
                        @endforeach
                    </div>
                     <div class="fb-comments" data-href="{{getUrlPost($oneItem)}}" data-width="100%" data-numposts="5"></div>
                    <!-- lst news -->
                    {{-- <div class="font-18 font-weight-bold mt-4 d-flex align-items-center text-green5">
                        <span class="square-blue mr-2"></span>
                        TIN CÙNG CHUYÊN MỤC
                    </div> --}}

                    {{-- @if(!empty($related_post))
                        @foreach($related_post as $item)
                            <div class="py-3">
                                <div class="row">
                                    <div class="col-5 pr-0">
                                        <a href="{{getUrlPost($item)}}">
                                            {!! genImage($item->thumbnail, 300, 200, $item->title, 'img-fluid') !!}
                                        </a>
                                    </div>
                                    <div class="col-7">
                                        <a class="font-weight-bold font-18 text-dark d-block mb-2" href="{{getUrlPost($item)}}">{{$item->title}}</a>
                                        <p class="font-13 mb-1 d-flex">
                                        </p>
                                        <p class="line-height-24 d-none d-md-block">{!!  get_limit_content($item->description, 200) !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif --}}
                </div>
            </div>
        </div>
        @include('web.block._sidebar')
        </div>
    </div>
@endsection

