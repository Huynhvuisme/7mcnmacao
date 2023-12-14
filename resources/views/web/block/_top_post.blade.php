@php
    $firstPost = $posts[0];
    unset($posts[0]);
@endphp
<div class="post-cate col-sm-12 mb-3">
    <div class="first-post">
        <a href="{{getUrlPost($firstPost)}}">
            {!! genImage($firstPost->thumbnail, 1000, 600, $firstPost->title, 'img-fluid') !!}
        </a>
        <div class="first-post-content">
            <a href="{{getUrlPost($firstPost)}}">
                <div class="first-post-title"><h3 class="text-white">{{$firstPost->title ?? ''}}</h3></div>
                <div class="first-post-cate font-12">
                    <span>{{$firstPost->category ? $firstPost->category->title : ''}}</span> -
                    <span>{{$firstPost->displayed_time }}</span>
                </div>
            </a>
        </div>
    </div>
    @if (!empty($is_home))
    <div class="d-md-none my-2">
        <?php echo getBanner('home-center')?>
    </div>
    @endif
    @if (!IS_MOBILE)
        <div class="top-post-after">
            <div class="row">
                @foreach ($posts as $key => $post)
                    <div class="col-sm-3">
                        <a href="{{getUrlPost($post)}}">
                            {!! genImage($post->thumbnail, 400, 250, $firstPost->title, 'img-fluid')!!}
                        </a>
                        <div class="content">
                            <h3 class="line-height-22"><a class="text-dark font-16 font-weight-bold" href="{{getUrlPost($post)}}"> {{$post->title}} </a></h3>
                        </div>
                    </div>
                    @php
                        unset($posts[$key]);
                        if($loop->index >=3) break; // list 4 post
                    @endphp
                @endforeach
            </div>
        </div>
    @else
        @foreach($posts as $key => $item)
            <div class="py-3 border-bottom border-grey p-2">
                <div class="row">
                    <div class="col-6 col-lg-4">
                        <a href="{{ getUrlPost($item) }}">
                            {!! genImage($item->thumbnail, 500, 300, $item->title, 'img-fluid') !!}
                        </a>
                    </div>
                    <div class="col-6 col-lg-8 pl-0">
                        <h3><a class="font-weight-bold font-md-18 text-dark d-block mb-2 font-16 line-height-24" href="{{ getUrlPost($item) }}">{{ $item->title }}</a></h3>
                        <div class="cate font-12 text-red2">{{isset($item->category) ? $item->category->title : ''}}</div>
                        <p class="d-none d-lg-block line-height-24 font-14">{!!  get_limit_content($item->description, 400) !!}</p>
                    </div>
                </div>
            </div>
            @php
                unset($posts[$key]);
                if($loop->index >=3) break; // list 4 post
            @endphp
        @endforeach
    @endif
    @if (!empty($is_home))
        <div class="my-2 d-none d-md-block">
            <?php echo getBanner('home-center')?>
        </div>
    @endif
</div>
