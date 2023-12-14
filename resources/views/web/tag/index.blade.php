@extends(TEMPLATE)
@section('content')
<div class="container p-0 px-md-3">
    <div class="d-block d-lg-flex justify-content-between">
        <div class="main-content mt-2 mt-md-4 mr-md-4 p-2 p-md-0">
            @if(isset($breadCrumb) && !empty($breadCrumb))
                {!! getBreadcrumb($breadCrumb) !!}
            @endif
            <div class="col-sm-12 font-16">
                {!!$tag->description!!}
            </div>
            <div class="list-more-posts">
                @include('web.block._load_more_post', ['post' => $post])
            </div>
            <div class="my-3">
                <a href="#" data-tagid="{{$tag->id ?? null}}" data-page="{{$page ?? null}}" class="btn-cat-load-more d-block bg-grey text-dark p-2 text-center">
                    Tải thêm bài viết
                </a>
            </div>
            @if(!empty($tag->content))
                <div class="cat_des text-justify mb-3">
                    {!! $tag->content !!}
                </div>
            @endif
        </div>
        @include('web.block._sidebar')
    </div>
</div>
@endsection
