@extends(TEMPLATE)

@section('content')

<link rel="stylesheet" href="/web/css/maytinhdudoan.css">

    <div class="container p-0 px-md-3">

        <div class="d-block d-lg-flex justify-content-between">

            <div class="main-content mt-2 mt-md-4 mr-md-4 p-2 p-md-0">

                @if(isset($breadCrumb) && !empty($breadCrumb))

                    {!! getBreadcrumb($breadCrumb) !!}

                @endif



                @if(!empty($oneItem->description))

                    <div class="cat_des text-justify font-16 mb-3">

                        {!! $oneItem->description !!}

                    </div>

                @endif



                @if(isset($category_menu))

                    <div class="list-tournament mb-3">

                        @foreach ($category_menu as $cate)

                            <a href="{{$cate->url}}" target="_blank" class="@if(strpos(request()->url(), $cate->url)) active @endif btn btn-sm bg-gray cate-tuarnament">{{$cate->name}}</a>

                        @endforeach

                    </div>

                @endif

                {{-- <div class="body-content-du-doan">

                {!!$dataCrawl->content ?? ''!!}

                </div> --}}



                @php

                    $titleChidren = json_decode($oneItem->title_children);

                @endphp



                @if(!$post->isEmpty())

                    <div class="ft-news mb-3 p-2">

                        @include('web.block._top_post', ['posts' => $post])

                    </div>

                @endif



                @if(!empty($totalConner))

                    @push('styles')

                        <style>

                            {!! file_get_contents('web/css/totalcorner.css') !!}

                        </style>

                    @endpush

                    <div class="total-conner">

                        @include('web.block._total_conner', ['tbody' => $totalConner->content])

                    </div>

                @endif

                @if(!empty($post))

                <div class="list-more-posts">

                    @include('web.block._load_more_post', ['posts' => $post])

                </div>

                @endif

                <!-- <div class="my-3">

                    <a href="#" data-catid="{{$oneItem->id ?? 0}}" data-page="{{$page ?? null}}" class="btn-cat-load-more d-block bg-grey text-dark p-2 text-center">

                        Tải thêm bài viết

                    </a>

                </div> -->



                @if(!empty($oneItem->content))

                    <div class="cat_des text-justify mb-3 mt-5">

                        {!! $oneItem->content !!}

                    </div>

                @endif

            </div>

            @include('web.block._sidebar')

        </div>

    </div>

@endsection

