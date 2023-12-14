@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($author) ? 'Chỉnh sửa' : 'Thêm mới'}} tác giả chuyên mục</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tên tác giả</label>
                                                <input class="form-control" required name="name" value="{{ $author->name ?? ''}}" type="text" placeholder="Tên tác giả">
                                            </div>
                                            <div class="form-group">
                                                <label>Ngày sinh</label>
                                                <input type="text" class="form-control" value="{{ $author->date_of_birth ?? ''}}" name="date_of_birth" placeholder="Ngày sinh">
                                            </div>
                                            <div class="form-group">
                                                <label>Chức vụ</label>
                                                <input type="text" class="form-control" value="{{ $author->position ?? ''}}" name="position" placeholder="Chức vụ">
                                            </div>
                                            <div class="form-group">
                                                <label>Link</label>
                                                <input type="text" class="form-control" value="{{ $author->link ?? ''}}" name="link" placeholder="Link">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header"><strong>Thông tin khác</strong></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Avatar</label>
                                        <img src="{{ isset($author->avatar_image) ? url($author->avatar_image) : url('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        <input type="hidden" name="avatar_image" id="hd_img" value="{{ $author->avatar_image ?? '' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Chuyên mục</label>
                                        <div id="select-multi-category-author" data-author-id="{{ $author->id ?? 0}}">

                                        </div>
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary">Lưu trữ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
