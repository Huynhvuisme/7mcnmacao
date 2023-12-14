@php $ver = '0.311' @endphp

<!DOCTYPE html>

<html lang="vi-VN">

<head>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="robots" content="{{$seo_data['index'] ?? ''}}">

    <title>{{$seo_data['meta_title'] ?? ''}}</title>

    @if(!empty($seo_data['meta_keyword']))

        <meta name="keywords" content="{{$seo_data['meta_keyword']}}">

    @endif

    <meta name="description" content="{{$seo_data['meta_description'] ?? ''}}">

    <link rel="canonical" href="{{$seo_data['canonical'] ?? ''}}" />

    <meta property="og:title" content="{{$seo_data['meta_title'] ?? ''}}">

    @if(!empty($seo_data['site_image']))

        <meta property="og:image" content="{{env('APP_URL').$seo_data['site_image']}}">

    @endif

    <meta property="og:site_name" content="7mcn88">

    <meta property="og:description" content="{{$seo_data['meta_description'] ?? ''}}">

    @if(!empty($seo_data['published_time']))

        <meta property="article:published_time" content="{{$seo_data['published_time']}}" />

    @endif

    @if(!empty($seo_data['modified_time']))

        <meta property="article:modified_time" content="{{$seo_data['modified_time']}}" />

    @endif

    @if(!empty($seo_data['updated_time']))

        <meta property="article:updated_time" content="{{$seo_data['updated_time']}}" />

    @endif
    <meta name="twitter:card" content="summary" />

    <meta name="twitter:title" content="{{$seo_data['meta_title'] ?? ''}}" />

    <meta name="twitter:description" content="{{$seo_data['meta_description'] ?? ''}}" />

    @if(!empty($seo_data['site_image']))

        <meta name="twitter:image" content="{{url($seo_data['site_image'])}}" />

    @endif
    @if (!empty(getSiteSetting('site_ma_head')))
    {!! getSiteSetting('site_ma_head') !!}
    @endif
    <meta name='dmca-site-verification' content='eFJMTGE4cXk0b1FQcFpYcnEyVW04QT090' />



    <link rel="shortcut icon" href="{{url('/web/images/favicon.png?21')}}" />

    <link rel="apple-touch-icon" href="{{url('/web/images/favicon.png?21')}}" />



    <script defer src="/web/js/jquery.min.js"></script>

    <script defer src="/web/js/non-critical.js?0.01"></script>

    <script defer src="/web/js/custom.js?8"></script>

    <script defer src="/web/js/banner.js?2.01"></script>
    <style>
        {!!file_get_contents('web/css/critical.css').file_get_contents('web/css/non-critical.css');!!}
    </style>

    @stack('styles')



    <div id="fb-root"></div>

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1736376983343298&autoLogAppEvents=1" nonce="olYu4Sd0"></script>

</head>

<body>

@include('web.header')

@yield('content')

@include('web.footer')

@stack('scripts')



</body>

</html>

