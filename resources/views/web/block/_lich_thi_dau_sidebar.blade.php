@php $lich_thi_dau = getLichThiDau() @endphp
<div class="mb-2" id="box-calendar-fb-widget">
    <div class="p-10 mb-20 box_latest_news box-calencar">
        <div class="d-flex head-title font-18 font-bold position-relative pl-3">
            LỊCH BÓNG ĐÁ
        </div>
        <div class="content-block-identify d-flex flex-wrap">
            <section class="d-flex mt-10 fb_box-hot-league">
            </section>
            <section class="d-flex clearfix fb_box_date bg-white">
                <div class="justify-content-end fb-sub-menu overflow-x-auto">
                    <ul class="d-flex list-unstyled mb-0 list-date-ltd">
                        @for ($i = 0; $i < 6; $i++)
                        <li class="mr-1 @if ($i == 0) sub-menu-active @endif">
                            <a class="text-center btn-load-widget-calendar btn-show-ltd" href="#" data-date="{{ date('Y-m-d', strtotime('+'.$i.' day')) }}">
                                <span class="font-10 date-word">{{ $i == 0 ? 'Hôm nay' : ($i == 1 ? 'Ngày mai' : getDay(date('Y-m-d', strtotime('+'.$i.' day')), 4)) }}</span>
                                <br>
                                <span class="font-10 font-bold">{{ date('d/m', strtotime('+'.$i.' day')) }}</span>
                            </a>
                        </li>
                        @endfor
                    </ul>
                </div>
            </section>
            <div class="mt-10 pt-0 content-football">
                <section class="clearfix content_box_home">
                    <div class="b_gameweek">
                        <div class="w-100 table-bordered list-schedule-all ajax-content-ltd">
                            {!! $lich_thi_dau !!}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
