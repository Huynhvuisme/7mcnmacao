@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-md-3">
        <div class="d-block d-lg-flex justify-content-between">
            <div class="main-content mt-2 mt-md-4 mr-md-4 p-0 p-md-0">
                <div class="heading-home-page text-center">
                    <h1 class="font-22 font-weight-bold mb-0 text-title box-news">{!!getSiteSetting('site_title')!!}</h1>
                </div>
                @if(!empty($url7M))
                <div class="ty-so-7m">
                    <iframe class="w-100 h-2000 iframe-scroll" src='{{ $url7M ?? "" }}'></iframe>
                </div>
                @endif
                <div class="my-2 d-none d-lg-block">
                    <?php echo getBanner('center-pc')?>
                </div>

            </div>
            @include('web.block._sidebar')
        </div>
        <div class="mt-3 main-content post-content mx-2 mx-lg-0">
            @php
                $siteContent = getSiteSetting('site_content');
            @endphp
            {!! $siteContent !!}
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    let status = true,
        btnLoadSite = document.getElementsByClassName('load-site-content')[0],
        siteContent = document.getElementsByClassName('site-content')[0];

        btnLoadSite.addEventListener('click', function(){
            if(status){
                siteContent.classList.remove('text-limit')
            }else{
                siteContent.classList.add('text-limit')
            }
            status = (!status);
        });
</script>
@endpush
