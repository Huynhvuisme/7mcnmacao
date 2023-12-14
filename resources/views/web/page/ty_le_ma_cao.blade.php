@extends(TEMPLATE)
@section('content')
<div class="container p-0 px-md-3">
    <div class="d-block d-lg-flex justify-content-between">
        <link rel="stylesheet" href="/web/css/tylekeo.css?v=0.6">
        <script defer src="/web/js/tylekeo.js?v=0.5"></script>
        <script defer src="/web/js/tylekeo1.js?v=0.5"></script>
        <div class="main-content mt-2 mt-md-4 mr-md-4 p-md-0">
            @if(isset($breadCrumb) && !empty($breadCrumb))
                {!! getBreadcrumb($breadCrumb) !!}
            @endif

            @if($oneItem->description)
            <div class="cat_des font-14 border-bottom border-grey mb-3 py-2">
                {!! $oneItem->description !!}
            </div>
            @endif

            <div class="box-filter">
                <div class="d-flex justify-content-between">
                    <div class="input-group">
                        <div class="form-outline d-flex">
                            <input type="search" id="form-search-club" class="form-control" placeholder="Tên câu lạc bộ" />
                            <button class="search-button bg-red1" type="button">
                                <img src="/web/images/icon-search.svg" alt="search icon" width="18" height="18">
                            </button>
                        </div>
                    </div>
                    <div class="position-relative">
                        <p id="open_filter" class="open_filter px-4 py-2 border rounded">Lọc</p>
                        <div id="filter_options" class="popup-list" style="overflow: hidden; display: none;">
                            <div class="d-flex mb-2">
                                <button id="filter-select-all" class="text-nowrap rounded px-3 py-2 mr-2">Chọn tất cả</button>
                                <button id="filter-clear" class="text-nowrap rounded px-3 py-2">Xóa filter</button>
                            </div>
                            <label class="filter_item d-block px-3 py-2">
                                <input type="checkbox" value="uefa champions league">Cúp C1 Châu Âu
                            </label>
                            <label class="filter_item d-block px-3 py-2">
                                <input type="checkbox" value="english premier league">Ngoại Hạng Anh
                            </label>
                            <label class="filter_item d-block px-3 py-2">
                                <input type="checkbox" value="italy serie a">VĐQG Ý
                            </label>
                            <label class="filter_item d-block px-3 py-2">
                                <input type="checkbox" value="la liga">VĐQG Tây Ban Nha
                            </label>
                            <label class="filter_item d-block px-3 py-2">
                                <input type="checkbox" value="france ligue 1">VĐQG Pháp
                            </label>
                            <label class="filter_item d-block px-3 py-2">
                                <input type="checkbox" value="germany bundesliga 1">VĐQG Đức
                            </label>
                        </div>
                    </div>
                </div>
                <div class="list-btn">
                    <?php
                    $date = date('m/d');
                    $next_1 = date('d/m', strtotime($date .' +1 day'));
                    $next_2 = date('d/m', strtotime($date .' +2 day'));
                    ?>
                    <button class="btn-keo-ngay" data-value="1" date="<?php echo date('d/m'); ?>">
                        <span style="display: inline-block;"></span>HÔM NAY
                    </button>

                    <button class="btn-keo-ngay" data-value="2" date="<?php echo $next_1; ?>">
                        <span></span><?php echo $next_1; ?>
                    </button>

                    <button class="btn-keo-ngay" data-value="3" date="<?php echo $next_2; ?>">
                        <span></span><?php echo $next_2; ?>
                    </button>
                </div>
            </div>

            <div class="w-100 mb-3 bg-white table-tyleweb">
                <table width="100%" class="table table-bordered d-none d-lg-table text-white mb-0" style="background: #6986AC;">
                    <tbody>
                    <tr>
                        <td rowspan="2" width="9%" class="text-center td-1a"><span>Giờ</span></td>
                        <td rowspan="2" width="27%" class="text-center td-2a"><span>Trận đấu</span></td>
                        <td colspan="3" width="32%" class="text-center td-1b"><span>Cả trận</span></td>
                        <td colspan="3" width="32%" class="text-center td-2b"><span>Hiệp 1</span></td>
                    </tr>
                    <tr>
                        <td width="12%" class="text-center td-1c"><span>Tỷ lệ</span></td>
                        <td width="12%" class="text-center td-2c"><span>Tài xỉu</span></td>
                        <td width="8%" class="text-center td-3c"><span>1x2</span></td>
                        <td width="12%" class="text-center td-1c"><span>Tỷ lệ</span></td>
                        <td width="12%" class="text-center td-2c"><span>Tài xỉu</span></td>
                        <td width="8%" class="text-center td-3c"><span>1x2</span></td>
                    </tr>
                    </tbody>
                </table>

                <table width="100%" class="table-header d-lg-none text-white mb-0" style="background: #6986AC;">
                    <tbody>
                    <tr>
                        <td width="12%">Giờ</td>
                        <td width="34%">Trận Đấu</td>
                        <td width="22%">Tỷ Lệ</td>
                        <td width="22%">Tài Xỉu</td>
                        <td width="10%">1x2</td>
                    </tr>
                    </tbody>
                </table>

                <?= closetags($data) ?>
            </div>

            @if (!empty($oneItem->content))
                <div class="line-height-24 entry-content">
                    {!! $oneItem->content !!}
                </div>
            @endif
        </div>
        @include('web.block._sidebar')
    </div>
</div>
@endsection
@push('scripts')
<script defer type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        if(is_mobile){
            $('.keo-search').each(function(i, e){
                let childs = $(e).children();
                childs[0].setAttribute('width', '12%')
                childs[1].setAttribute('width', '34%')
                childs[2].setAttribute('width', '22%')
                childs[3].setAttribute('width', '22%')
                childs[4].setAttribute('width', '10%')
                childs[5].remove()
                childs[6].remove()
                childs[7].remove()
            })
        }
    });
</script>
@endpush
