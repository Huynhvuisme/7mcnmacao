@extends(TEMPLATE)
@section('content')
    <div class="container p-0 px-md-3">
        <div class="d-block d-lg-flex justify-content-between">
            <div class="main-content mt-2 mt-md-4 mr-md-4 p-2 p-md-0">
                @if(isset($breadCrumb) && !empty($breadCrumb))
                    {!! getBreadcrumb($breadCrumb) !!}
                @endif
                <div class="row">
                    <div class="col-12 col-md-11">
                        <div class="single-header">
                            <div class="font-weight-bold mb-3">{!! $oneItem->description !!}</div>
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
