@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-md-3">
        <div class="d-block d-lg-flex justify-content-between">
            <div class="main-content mt-2 mt-md-4 mr-md-4 p-2 p-md-0">
                @if(isset($breadCrumb) && !empty($breadCrumb))
                    {!! getBreadcrumb($breadCrumb) !!}
                @endif
                @if(isset($page_menu))
                    <div class="list-tournament mb-3">
                        @foreach ($page_menu as $menu)
                            <a href="{{$menu->url}}" target="_blank" class="@if(strpos(request()->url(), $menu->url)) active @endif btn btn-sm bg-gray cate-tuarnament">{{$menu->name}}</a>
                        @endforeach
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 ">
                        <h1 class="text-center font-weight-bold">{!! $oneItem->title ?? '' !!}</h1>
                        {!!$dataCrawl->content ?? ''!!}
                        <div class="single-header">
                            <div class="font-weight-bold mb-3">{!! $oneItem->description ?? '' !!}</div>
                        </div>
                        <div class="line-height-24 entry-content">
                            {!! $oneItem->content !!}
                        </div>
                    </div>
                </div>
            </div>
            @include('web.block._sidebar')
        </div>
    </div>
@endsection
