@foreach($post as $key => $item)
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
@endforeach
