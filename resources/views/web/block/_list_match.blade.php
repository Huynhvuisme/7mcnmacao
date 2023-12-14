{{--
<div class="font-20 py-2 pr-3 pl-0 font-weight-bold text-uppercase d-flex align-items-center">
    <span class="ml-2 square-blue mr-2"></span>
        <h2 class="font-20 font-weight-bold mb-0 text-title box-news">soi kèo trực tiếp hôm nay và ngày mai</h2>
</div>
@php
    $betnow = getSiteSetting('site_betnow');
    $live = getSiteSetting('site_live');
@endphp
@foreach($soikeo_today as $value)
    <div class="border d-none d-lg-flex flex-wrap mb-3">
        <div class="col-5 border-right d-flex flex-wrap px-0 text-center">
            <div class="col-6 py-3">
                {!! genImage($value->team_home_logo, 70, 70, $value->team_home_name, 'img-fluid') !!}
                <span class="font-weight-bold font-14 d-block">{!! $value->team_home_name !!}</span>
            </div>
            <div class="col-6 py-3">
                {!! genImage($value->team_away_logo, 70, 70, $value->team_away_name, 'img-fluid') !!}
                <span class="font-weight-bold font-14 d-block">{!! $value->team_away_name !!}</span>
            </div>
        </div>
        <div class="col-7 d-flex flex-wrap px-0">
            <div class="col-6 d-flex pr-0">
                <div class="bg-gray1 rounded p-3 align-self-center my-2">
                    <span class="font-weight-bold d-block mb-2">{!! $value->tournament !!}</span>
                    <span class="font-weight-bold d-block font-16">
                        <img class="mr-1" src="/web/images/icon-time.svg" alt="time icon" width="18" height="18">
                        {{ date('H:i | d/m/Y',strtotime($value->scheduled)) }}
                    </span>
                </div>
            </div>
            <div class="col-6 text-right d-flex flex-column justify-content-center">
                <span class="mb-2"><b>{{ $value->hdc_asia }}</b> (Châu Á)</span>
                <span class="mb-2"><b>{{ $value->hdc_eu }}</b> (Châu Âu)</span>
                <span><b>{{ $value->hdc_tx }}</b> (Tài xỉu)</span>
            </div>
            <div class="col-12 py-3 px-0 mb-1 d-flex flex-wrap justify-content-between text-center btn-group font-13">
                @if($value->type_post == 2)
                    <a class="bg-brown1 text-white col py-2 mx-1" href="{{ getUrlPost($value) }}">Kèo tài xỉu</a>
                @elseif($value->type_post == 3)
                    <a class="bg-red9 text-white col py-2 mx-1" href="{{ getUrlPost($value) }}">Kèo thẻ phạt </a>
                @elseif($value->type_post == 4)
                    <a class="bg-purple text-white col py-2 mx-1" href="{{ getUrlPost($value) }}">Kèo Phạt góc</a>
                @else
                    <a class="bg-primary text-white col py-2 mx-1" href="{{ getUrlPost($value) }}">Soi kèo </a>
                @endif
                @if($betnow)
                    <a rel="nofollow" href="{{$betnow}}" target="_blank" class="bg-danger text-white col py-2 mx-1" >Cược Ngay</a>
                @else
                    <div class="bg-danger text-white col py-2 mx-1">Cược Ngay</div>
                @endif
                <a class="bg-success text-white col py-2 mx-1" href="{{ getUrlPost($value)}}#{{ $value->predict_score ?? ''}}">Dự đoán kèo</a>
                @if($live)
                    <a rel="nofollow" href="{{$live}}" target="_blank" class="bg-warning text-white col py-2 mx-1 px-1" >Xem Live</a>
                @else
                    <div class="bg-warning text-white col py-2 mx-1 px-1" >Xem Live</div>
                @endif
            </div>
        </div>
    </div>
    <div class="border d-flex d-lg-none flex-wrap mb-3 p-2">
        <div class="col-3 p-2 text-center">
                {!! genImage($value->team_home_logo, 70, 70, $value->team_home_name, 'img-fluid') !!}
            <span class="font-weight-bold font-14 d-block overflow-hidden">{!! $value->team_home_name !!}</span>
        </div>
        <div class="col-6 px-0 text-center d-flex flex-column justify-content-center font-14">
            <span class="mb-1"><b>{{ $value->hdc_asia }}</b> (Châu Á)</span>
            <span class="mb-1"><b>{{ $value->hdc_eu }}</b> (Châu Âu)</span>
            <span><b>{{ $value->hdc_tx }}</b> (Tài xỉu)</span>
        </div>
        <div class="col-3 p-2 text-center">
                {!! genImage($value->team_away_logo, 70, 70, $value->team_away_name, 'img-fluid') !!}
            <span class="font-weight-bold font-14 d-block overflow-hidden">{!! $value->team_away_name !!}</span>
        </div>
        <div class="col-12 bg-gray1 d-flex justify-content-between py-2 mt-2">
            <span class="font-weight-bold">{!! $value->tournament !!}</span>
            <span class="font-weight-bold font-16">
                <img class="mr-1" src="/web/images/icon-time.svg" alt="time icon" width="18" height="18">
                {{ date('H:i | d/m/Y',strtotime($value->scheduled)) }}
            </span>
        </div>
        <div class="col-12 px-0 pt-3 mb-0 d-flex flex-wrap justify-content-between text-center btn-group font-13">
            @if($value->type_post == 2)
                <a class="bg-brown1 text-white col py-2 mx-1" href="{{ getUrlPost($value) }}">Kèo tài xỉu</a>
            @elseif($value->type_post == 3)
                <a class="bg-red9 text-white col py-2 mx-1" href="{{ getUrlPost($value) }}">Kèo thẻ phạt </a>
            @elseif($value->type_post == 4)
                <a class="bg-purple text-white col py-2 mx-1 px-2" href="{{ getUrlPost($value) }}">Kèo Phạt góc</a>
            @else
                <a class="bg-primary text-white col py-2 mx-1" href="{{ getUrlPost($value) }}">Soi kèo </a>
            @endif
            @if($betnow)
                <a rel="nofollow" href="{{$betnow}}" target="_blank" class="bg-danger text-white col py-2 mx-1 px-1" >Cược Ngay</a>
            @else
                <div class="bg-danger text-white col py-2 mx-1 px-1">Cược Ngay</div>
            @endif
            <a class="bg-success text-white col py-2 mx-1 px-1" href="{{getUrlPost($value)}}#{{ $value->predict_score ?? ''}}">Dự đoán kèo</a>
            @if($live)
                <a rel="nofollow" href="{{$live}}" target="_blank" class="bg-warning text-white col py-2 mx-1 px-1" >Xem Live</a>
            @else
                <div class="bg-warning text-white col py-2 mx-1 px-1" >Xem Live</div>
            @endif
        </div>
    </div>
@endforeach --}}

@if (!IS_MOBILE)
    <div class="text-nowrap table-list-match-container">
        <table class="table table-list-match">
            <thead class="text-center">
                <tr>
                    <th>Thời gian</th>
                    <th>Trận đấu</th>
                    <th>Giải</th>
                    <th>Thông tin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soikeo_today as $match)
                    <tr>
                        <td><span class="schedule-match fonwt text-green3">{{date('H:i | d/m', strtotime($match->scheduled))}}</span></td>
                        <td>{{$match->team_home_name}} vs {{$match->team_away_name}}</td>
                        <td>{{$match->tournament}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ getUrlPost($match) }}" class="bg-blue4 p-2 text-white rounded-0">Soi kèo</a>
                                <a class="btn-danger p-2 text-white mx-1 rounded-0">Chơi ngay</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="mx-3 rounded px-3 border">
    @foreach($soikeo_today as $key => $match)
        <div class="row text-center align-items-center {{ $key % 2 == 1 ? 'bg-gray1' : '' }}">
            <div class="col-sm-2 col-12 py-2"><span class="schedule-match text-green3 font-weight-bold font-14">{{date('H:i | d/m/Y', strtotime($match->scheduled))}}</span> - <span class="font-14">{{$match->tournament}}</span></div>
            <div class="col-sm-8 col-12 font-weight-bold font-13 py-2">
                <div class="row align-items-center py-2">
                    <div class="col-5 team-home-name">{{$match->team_home_name}}</div>
                    <div class="col-2 p-0">VS</div>
                    <div class="col-5 team-away-name">{{$match->team_away_name}}</div>
                </div>
            </div>
            <div class="col-sm-2 col-12 py-2">
                <div class="btn-group">
                    <a href="{{ getUrlPost($match) }}" class="bg-blue4 p-2 text-white rounded-0">Soi kèo</a>
                    <a class="btn-danger p-2 text-white mx-1 rounded-0">Chơi ngay</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endif
