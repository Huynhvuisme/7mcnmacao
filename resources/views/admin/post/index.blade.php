@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="card">
                    <div class="card-header">
                        Danh sách bài viết ({{$total}})
                        <div class="card-header-actions ml-3">
                            <a href="/admin/post/export-excel" id="export-excel" class="btn btn-block btn-primary btn-sm mr-3">Xuất file excel</a>
                        </div>
                        <div class="card-header-actions pr-1">
                            <a href="/admin/post/update"><button class="btn btn-block btn-primary btn-sm mr-3" type="button">Thêm mới</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="get" action="">
                            <div class="form-group row">
                                <div class="col-4">
                                    <input type="text" value="{{$_GET['keyword'] ?? ''}}" name="keyword" class="form-control" placeholder="Từ khóa">
                                </div>
                                <div class="col-3">
                                    <select name="category_id" class="form-control">
                                        <option value="">Chuyên mục</option>
                                        @foreach($categoryTree as $item)
                                            <option value="{{$item['id']}}" {{!empty($_GET['category_id']) && $item['id'] == $_GET['category_id'] ? 'selected': ''}}>{{$item['title']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="user_id" class="form-control">
                                        <option value="">Thành viên</option>
                                        @foreach($listUser as $item)
                                            <option value="{{$item['id']}}" {{!empty($_GET['user_id']) && $item['id'] == $_GET['user_id'] ? 'selected': ''}}>{{$item['username']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="status" value="{{$_GET['status'] ?? 1}}">
                                <div class="col-2">
                                    <input type="submit" class="btn btn-success" value="Tìm kiếm">
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                            <tr>
                                <th class="text-center w-5">ID</th>
                                <th>Tiêu đề</th>
                                <th class="text-center w-15">Chuyên mục</th>
                                <th class="text-center w-15">Tag</th>
                                <th class="text-center w-15">Ngày đăng bài</th>
                                <th class="text-center w-10">Link</th>
                                <th class="text-center w-15">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($listItem))
                                @foreach($listItem as $item)
                                <tr>
                                    <td class="text-center align-middle">{{$item->id}}</td>
                                    <td class="align-middle"><a target="_blank" rel="nofollow" href="{{getUrlPost($item)}}">{{$item->title}}</a></td>
                                    <td class="text-center align-middle">
                                        <ul class="list-unstyled mb-0">
                                        @foreach($item->categories as $cate)
                                            <li>{{ $cate->title }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center align-middle">
                                        <ul class="list-unstyled mb-0">
                                        @foreach($item->tags as $tag)
                                            <li><a href="{{getUrlTag($tag)}}">{{ $tag->title }}</a></li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center align-middle">{{date('d-m-Y H:i', strtotime($item->displayed_time))}}</td>
                                    <td class="text-center align-middle">
                                        <p>Link đi: <span class="font-weight-bold">{{$item->count_link_out}}</span></p>
                                        <p class="mb-0">Link về: <span class="font-weight-bold">{{$item->count_link_ve}}</span></p>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a class="btn btn-info" href="/admin/post/update/{{$item->id}}">
                                            <svg class="c-icon">
                                                <use xlink:href="/admin/images/icon-svg/free.svg#cil-pencil"></use>
                                            </svg>
                                        </a>
                                        <a class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"
                                           href="/admin/post/delete/{{$item->id}}">
                                            <svg class="c-icon">
                                                <use xlink:href="/admin/images/icon-svg/free.svg#cil-trash"></use>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        @php init_cms_pagination($page, $pagination) @endphp
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
<script type="text/javascript">
    window.onload = function () { 
        $('#export-excel').click(function (e) { 
            e.preventDefault();
            let param = window.location.search,
                href = $(this).attr('href');
            location.href = href+param;
        });
    }
</script>
@endpush
