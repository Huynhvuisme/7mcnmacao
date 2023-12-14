<footer class="text-grey font-13 w-100 px-0" style="background: #1d1547">

    <div class="ft-content py-3 pt-lg-5 pb-lg-3 px-md-3 container">
        <div class="d-flex flex-wrap  justify-content-lg-center justify-content-start pb-3" style="border-bottom: 1px solid #e0e0e0;">
            <a rel="nofollow" target="_blank" href="https://www.facebook.com/7mcnmacao11" class="btn btn-sm text-white mr-3">
                <img loading="lazy" src="/web/images/icon/facebook.svg" alt="" width="20" height="20"><span class="text-white ml-2">Facebook</span>
            </a>
            <a rel="nofollow" target="_blank" href="https://twitter.com/7mcnmacao" class="btn btn-sm text-white mr-3">
                <img loading="lazy" src="/web/images/icon/twitter.png" alt="" width="20" height="20"><span class="text-white  ml-2">Twitter</span>
            </a>
            <a rel="nofollow" target="_blank" href="https://lotus.vn/w/profile/158128554660078412.htm" class="btn btn-sm text-white  mr-3">
                <img loading="lazy" src="/web/images/icon/lotus.png" alt="" width="20" height="20"><span class="text-white  ml-2">Lotus</span>
            </a>
            <a rel="nofollow" target="_blank" href="https://www.pinterest.com/7mcnmacao/" class="btn btn-sm text-white mr-3">
                <img loading="lazy" src="/web/images/icon/pinterest-icon.png" alt="" width="20" height="20"><span class="text-white  ml-2">Pinterest</span>
            </a>
            <a rel="nofollow" target="_blank" href="https://biztime.com.vn/7MCNMACAO" class="btn btn-sm text-white mr-3">
                <img loading="lazy" src="/web/images/icon/bitztime.png" alt="" width="20" height="20"><span class="text-white  ml-2">Bitztime</span>
            </a>
            <a rel="nofollow" target="_blank" href="https://www.hahalolo.com/p/7mcnmacao~7MCNMACAO" class="btn btn-sm text-white mr-3">
                <img loading="lazy" src="/web/images/icon/hahalolo.png" alt="" width="20" height="20"><span class="text-white  ml-2">Hahalolo</span>
            </a>
            <a rel="nofollow" target="_blank" href="https://www.flickr.com/photos/199656619@N03/" class="btn btn-sm text-white mr-3">
                <img loading="lazy" src="/web/images/icon/flickr-icon.png" alt="" width="20" height="20"><span class="text-white  ml-2">Flickr</span>
            </a>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4 d-flex flex-wrap align-items-center" style="border-right: 1px solid #e0e0e0;">
                <h3 class="text-uppercase text-white font-weight-bold w-100 mt-3">về chúng tôi</h3>
                <div class="m-0 font-weight-lighter text-white about-footer" style="line-height: 20px;">
                    {!! getSiteSetting('site_content_footer') !!}
                </div>
            </div>
            <div class="col-12 col-lg-4" style="border-right: 1px solid #e0e0e0;">
                <h3 class="text-uppercase text-white font-weight-bold w-100 mt-3">Danh mục chính</h3>
                <ul class="list-unstyled w-100 about-footer">
                    @if(!empty($danhMucChinh))
                        @foreach($danhMucChinh as $item)
                            <li class="font-12 my-2 mr-3 mr-lg-0">
                                <a rel="nofollow" href="{{getFullUrl($item['url'])}}" title="{{$item['name']}}" class="text-gray2">{{$item['name']}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-12 col-lg-4 font-weight-lighter about-footer">
                <h3 class="text-uppercase text-white font-weight-bold mt-3">Liên kết hữu ích</h3>
                <ul class="list-unstyled w-100">
                    @if(!empty($menuFooter))
                        @foreach($menuFooter as $item)
                            <li class="font-12 my-2 mr-3 mr-lg-0">
                                <a rel="nofollow" href="{{getFullUrl($item['url'])}}" title="{{$item['name']}}" class="text-gray2">{{$item['name']}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-12 text-center mt-3">
                BẢN QUYỀN THUỘC VỀ ⭐️ 7MCNMACAO.COM
            </div>
        </div>
    </div>
</footer>

<!--back to top-->

<div class="back-top d-none d-block position-fixed">

    <div class="btn p-0">

        <p class="text-red3 font-weight-bold mb-0 font-16 text-center">TOP</p>

        <p class="text-center">

            <img src="/web/images/icon/back-to-top.png" width="39" height="56" alt="Backtotop">

        </p>

    </div>

</div>

