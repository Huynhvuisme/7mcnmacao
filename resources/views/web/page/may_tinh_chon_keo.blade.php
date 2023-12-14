@extends(TEMPLATE)
@section('content')
<div class="container p-0 px-md-3">
    <div class="d-block d-lg-flex justify-content-between">
        <link rel="stylesheet" href="/web/css/maytinhdudoan.css">
        <div class="main-content mt-2 mt-md-4 mr-md-4 p-2 p-md-0">
            @if(isset($breadCrumb) && !empty($breadCrumb))
                {!! getBreadcrumb($breadCrumb) !!}
            @endif
            @if($oneItem->description)
            <div class="cat_des border-bottom border-grey mb-3 py-2 font-14">
                {!! $oneItem->description !!}
            </div>
            @endif
            <div class="body-content-du-doan">
            {!!$dataCrawl->content ?? ''!!}
            </div>
            <article>
{{--                <div class="list-league-spin-match d-flex text-nowrap overflow-auto">--}}
{{--                    <a class="active" href="/may-tinh-chon-keo-ngoai-hang-anh.html" title="Dự đoán bóng đá Anh">Anh</a>--}}
{{--                    <a href="/may-tinh-chon-keo-phap.html" title="Dự đoán bóng đá Pháp">Pháp</a>--}}
{{--                    <a href="/may-tinh-chon-keo-duc.html" title="Dự đoán bóng đá Đức">Đức</a></li>--}}
{{--                    <a href="/may-tinh-chon-keo-tay-ban-nha.html" title="Dự đoán bóng đá Tây Ban Nha">Tây Ban Nha</a>--}}
{{--                    <a href="/may-tinh-chon-keo-italia.html" title="Dự đoán bóng đá Italia">Italia</a>--}}
{{--                    <a href="/may-tinh-chon-keo-cup-c1.html" title="Dự đoán bóng đá Việt Nam">Cúp C1</a>--}}
{{--                </div>--}}
                @foreach ($spin_match as $item)
                    @empty($item->id)
                        @continue
                    @else
                    <div class="p-md-3 border bg-white border-grey mb-4">
                        <div class="row py-2 py-md-0 mx-0">
                            <div class="col-4 d-flex flex-wrap align-items-center justify-content-center">
                                {!! genImage($item->team_home_logo, 70, 70, $item->team_home_name, 'img-fluid') !!}
                                <span class="w-100 text-center font-weight-bold">{{ $item->team_home_name }}</span>
                                <div class="predict-score">
                                    {{$item->home_score}}
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="bg-gray1 rounded py-2">
                                    <div class="font-14 mb-2 font-weight-bold">{{ $item->tournament }}</div>
                                    <div class="font-16 font-weight-bold text-title"><img class="clock" src="/web/images/icon-clock.png" alt="time icon" height="15"> {{ date('d-m-Y H:i', strtotime($item->scheduled)) }}</div>
                                </div>
                                <table class="w-100 table-spin-match mt-2">
                                    <tr>
                                        <td class="text-right">
                                            <div class="d-flex align-items-center justify-content-end">
                                                Chủ <input type="radio" hidden
                                                @if (isset($item->asia_predict) && $item->asia_predict == getComputerPredictType('HOME_ASIA_ID'))
                                                    checked
                                                @endif
                                                ><label class="ml-1" ></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td class="text-left">
                                            <div class="d-flex align-items-center">
                                                <input type="radio" hidden
                                                    @if (isset($item->asia_predict) && $item->asia_predict == getComputerPredictType('AWAY_ASIA_ID'))
                                                        checked
                                                    @endif
                                                ><label class="mr-1" ></label> Khách
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <div class="d-flex align-items-center justify-content-end">
                                                Tài <input type="radio" hidden
                                                @if (isset($item->even_odd_predict) && $item->even_odd_predict == getComputerPredictType('EVEN_ODD_MORE_THAN_ID'))
                                                    checked
                                                @endif
                                                ><label class="ml-1"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td class="text-left">
                                            <div class="d-flex align-items-center">
                                                <input type="radio" hidden
                                                @if (isset($item->even_odd_predict) && $item->even_odd_predict == getComputerPredictType('EVEN_ODD_LESS_THAN_ID'))
                                                    checked
                                                @endif
                                                ><label class="mr-1" ></label> Xỉu
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-4 d-flex flex-wrap align-items-center justify-content-center">
                                {!! genImage($item->team_away_logo, 70, 70, $item->team_away_name, 'img-fluid') !!}
                                <span class="w-100 text-center font-weight-bold">{{ $item->team_away_name }}</span>
                                <div class="predict-score">
                                    {{$item->away_score}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endempty
                @endforeach
            </article>
            @if (!empty($description))
            <div class="cat_des border-bottom border-grey my-3">{{ $description }}</div>
            @endif

            @if (!empty($lich_thi_dau))
            <div class="bg-dark p-2 text-hover font-18 mb-2">
                <div class="pl-3 p-1" style="background:url('/web/images/icon-title-hover.svg') no-repeat top left;">Lịch thi đấu bóng đá Anh</div>
            </div>
            <div class="ltd-vsk table-xs">
                @php
                    $content = str_replace('data-src','src',$lich_thi_dau->content);
                    $content = str_replace('<table','<table class="table table-bordered"',$content);
                    echo $content
                @endphp
            </div>
            @endif
            @if (!empty($oneItem->content))
            <div class="line-height-24 entry-content mt-5">
                {!! $oneItem->content !!}
            </div>
            @endif
        </div>
        @include('web.block._sidebar')
    </div>
</div>
    <style>
        .dudoan table {
            width: 100%;
            margin-bottom: 10px;
        }
        .dudoan thead {
            background: #4ca180;
        }
        .dudoan thead th {
            border-color: #fff;
            text-align: center;
            line-height: 30px;
            color: #fff;
        }
        .dudoan tbody tr {
            border-bottom: 1px solid #e1e1e1;
        }
        .dudoan tbody td {
            line-height: 25px;
            text-align: center;
            padding: 0 5px;
            width: 70px;
            border: none;
        }
        .dudoan tbody td p {
            margin-bottom: 0;
        }
        .dudoan .kq {
            font-weight: 700;
            color: #c63235;
        }
        .dudoan tbody td.match {
            text-align: left;
            color: #000;
            font-weight: 700;
        }
        .dudoan tbody td.league {
            background: #b2b2b2;
            line-height: 30px;
            padding: 0 10px;
            color: #000;
            font-weight: 600;
            text-align: left;
        }
    </style>
@endsection
