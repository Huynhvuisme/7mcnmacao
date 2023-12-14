@extends('admin.layout')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <form method="post" action="" id="post-update">
                    <input type="hidden" name="user_id" value="{{!empty($oneItem)? $oneItem->user_id: $user_id}}">
                    <input type="hidden" name="id_match" value="{{!empty($oneItem)? $oneItem->id_match: ''}}">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header"><strong>{{!empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới'}} Bài viết</strong>{!!!empty($oneItem) ? ' - <a rel="nofollow" target="_blank" href="'.getUrlPost($oneItem).'">'.$oneItem->title.'</a>' : ''!!}</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tiêu đề</label>
                                                <input class="form-control" required name="title" value="{{!empty($oneItem->title) ? $oneItem->title : ''}}" type="text" placeholder="Tiêu đề">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Slug bài viết</label>
                                                <input class="form-control" name="slug" value="{{!empty($oneItem->slug) ? $oneItem->slug : ''}}" type="text" placeholder="Slug bài viết">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Mô tả</label>
                                                <textarea id="tiny-featured" class="form-control required-post" rows="4" name="description">{{!empty($oneItem->description) ? $oneItem->description : ''}}</textarea>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Nội dung</label>
                                                <textarea class="form-control context" name="content">{{!empty($oneItem->content) ? $oneItem->content : ''}}</textarea>
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded mb-3 bg-white">
                                <h6 class="rounded-top border-bottom px-4 py-3">
                                    <strong>Thông tin trận đấu</strong>
                                </h6>
                                <div class=" px-4 py-3">
                                    <div class="d-block d-md-flex justify-content-between border-bottom mb-3">
                                        <div class="form-group">
                                            <label>ID Bóng Đá Lu</label>
                                            <input type="text" name="id_bongdalu" class="form-control" placeholder="ID Bóng đá lu" value="{{!empty($oneItem->id_bongdalu) ? $oneItem->id_bongdalu : ''}}">
                                            <small class="form-text text-muted">Bỏ trống nếu không phải bài viết soi kèo</small>
                                            <div class="invalid-feedback"></div> 
                                        </div>
                                        <div class="form-group">
                                            <label>Thời gian thi đấu (tháng/ngày/năm, giờ:phút)</label>
                                            <input type="datetime-local" name="match[scheduled]" class="form-control" placeholder="Thời gian thi đấu" value="{{!empty($match->scheduled) ? date('Y-m-d\TH:i:s', strtotime($match->scheduled)) : '' }}">
                                            <small class="form-text text-muted">Cần nhập nếu là bài soi kèo</small>
                                            <div class="invalid-feedback"></div> 
                                        </div>
                                        <div class="form-group">
                                            <label>Giải đấu</label>
                                            <input type="text" name="match[tournament]" class="form-control" placeholder="Giải đấu" value="{!! !empty($match->tournament) ? $match->tournament : '' !!}">
                                            <div class="invalid-feedback"></div> 
                                        </div>
                                    </div>
                                    <div class="d-block d-md-flex justify-content-between">
                                        <div>
                                            <div class="form-group">
                                                <label>Logo Đội nhà</label>
                                                <input type="text" name="match[team_home_logo]" class="form-control" placeholder="Logo đội nhà" value="{{!empty($match->team_home_logo) ? $match->team_home_logo : ''}}">
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                            <div class="form-group">
                                                <label>Tên đội nhà</label>
                                                <input type="text" name="match[team_home_name]" class="form-control" placeholder="Tên đội nhà" value="{!! !empty($match->team_home_name) ? $match->team_home_name : '' !!}">
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                        </div>
                                        <div>
                                            <label>Tỷ lệ Kèo</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Châu Á</div>
                                                </div>
                                                <input type="text" name="match[hdc_asia]" class="form-control" id="inlineFormInputGroup" placeholder="Châu Á" value="{{!empty($match->hdc_asia) ? $match->hdc_asia : ''}}">
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Châu Âu</div>
                                                </div>
                                                <input type="text" name="match[hdc_eu]" class="form-control" id="inlineFormInputGroup" placeholder="Châu Âu" value="{{!empty($match->hdc_eu) ? $match->hdc_eu : ''}}">
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Tài Xỉu</div>
                                                </div>
                                                <input type="text" name="match[hdc_tx]" class="form-control" id="inlineFormInputGroup" placeholder="Tài Xỉu" value="{{!empty($match->hdc_tx) ? $match->hdc_tx : ''}}">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-group">
                                                <label>Logo đội khách</label>
                                                <input type="text" name="match[team_away_logo]" class="form-control" placeholder="Logo đội khách" value="{{!empty($match->team_away_logo) ? $match->team_away_logo : ''}}">
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                            <div class="form-group">
                                                <label>Tên đội nhà</label>
                                                <input type="text" name="match[team_away_name]" class="form-control" placeholder="Tên đội khách" value="{!! !empty($match->team_away_name) ? $match->team_away_name : '' !!}">
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card">
                                <div class="card-header"><strong>Máy tính dự đoán</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class=""><strong>Kèo châu á</strong></div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input" 
                                                            type="radio" 
                                                            name="computerPredict[asia_predict]" 
                                                            value="{{getComputerPredictType('HOME_ASIA_ID')}}" 
                                                        @if (isset($computerPredict->asia_predict) && 
                                                            $computerPredict->asia_predict == getComputerPredictType('HOME_ASIA_ID'))
                                                            checked
                                                        @endif  
                                                            >
                                                        Chủ
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input" 
                                                            type="radio" 
                                                            name="computerPredict[asia_predict]" 
                                                            value="{{getComputerPredictType('AWAY_ASIA_ID')}}"
                                                        @if (isset($computerPredict->asia_predict) && 
                                                            $computerPredict->asia_predict == getComputerPredictType('AWAY_ASIA_ID'))
                                                            checked
                                                        @endif  
                                                            >
                                                        Khách
                                                    </label>
                                                </div>
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class=""><strong>Kèo tài xỉu</strong></div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input" 
                                                            type="radio" 
                                                            name="computerPredict[even_odd_predict]" 
                                                            value="{{getComputerPredictType('EVEN_ODD_MORE_THAN_ID')}}" 
                                                            @if (isset($computerPredict->even_odd_predict) && 
                                                                $computerPredict->even_odd_predict == getComputerPredictType('EVEN_ODD_MORE_THAN_ID'))
                                                                checked
                                                            @endif        
                                                    >
                                                        Tài
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                    <input class="form-check-input" 
                                                            type="radio" 
                                                            name="computerPredict[even_odd_predict]" 
                                                            value="{{getComputerPredictType('EVEN_ODD_LESS_THAN_ID')}}" 
                                                        @if (isset($computerPredict->even_odd_predict) && 
                                                            $computerPredict->even_odd_predict == getComputerPredictType('EVEN_ODD_LESS_THAN_ID'))
                                                            checked
                                                        @endif
                                                    >
                                                        Xỉu
                                                    </label>
                                                </div>
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class=""><strong>Tỷ số</strong></div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="">Chủ</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input 
                                                        type="number" 
                                                        class="form-control form-control-sm" 
                                                        placeholder="Chủ" 
                                                        name="computerPredict[home_score]"
                                                        value="@if(isset($computerPredict->home_score)){{$computerPredict->home_score}}@endif"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="">khách</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="number" 
                                                                class="form-control form-control-sm" 
                                                                placeholder="Khách" 
                                                                name="computerPredict[away_score]"
                                                                value="@if(isset($computerPredict->away_score)){{$computerPredict->away_score}}@endif"
                                                                >
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback"></div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header"><strong>Thông tin khác</strong></div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Thumbnail</label>
                                        @if(!empty($oneItem->thumbnail))
                                            <img src="{{$oneItem->thumbnail}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @else
                                            <img src="{{url('admin/images/no-image.jpg')}}" id="lbl_img" class="img-fluid d-block" onclick="upload_file('chosefile','img')">
                                        @endif
                                        <input type="hidden" name="thumbnail" id="hd_img" value="{{!empty($oneItem->thumbnail)? $oneItem->thumbnail: ''}}" required>
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group">
                                        <label>Chuyên mục</label>
                                        <div id="select-multi-category" data-post-id="{{!empty($oneItem->id) ? $oneItem->id : 0}}"></div>
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                   <div class="form-group">
                                       <label>Tag</label>
                                       <div id="select-multi-tag" data-post-id="{{!empty($oneItem->id) ? $oneItem->id : 0}}"></div>
                                       <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Tiêu đề SEO
                                            <span class="text-danger" id="title-count-text">
                                                <span>Độ dài hiện tại: </span>
                                                <span id="title-count">0</span>px
                                            </span>
                                        </label>
                                        <input class="form-control" required name="meta_title" value="{{!empty($oneItem->meta_title) ? $oneItem->meta_title : ''}}" type="text" placeholder="Tiêu đề SEO">
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Mô tả SEO
                                            <span class="text-danger" id="description-count-text">
                                                <span>Độ dài hiện tại: </span>
                                                <span id="description-count">0</span>px
                                            </span>
                                        </label>
                                        <textarea class="form-control" required name="meta_description" rows="4" placeholder="Mô tả SEO">{{!empty($oneItem->meta_description) ? $oneItem->meta_description : ''}}</textarea>
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            Từ khóa SEO
                                            <span class="text-primary" id="keyword-count-text">
                                                <span>Từ khóa xuất hiện </span>
                                                <span id="keyword-count">0</span>
                                                lần -
                                                <span id="keyword-count-percent">0</span>%
                                            </span>
                                        </label>
                                        <input class="form-control" required name="meta_keyword" value="{{!empty($oneItem->meta_keyword) ? $oneItem->meta_keyword : ''}}" type="text" placeholder="Từ khóa SEO">
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select name="status" class="form-control">
                                            <option {{isset($oneItem->status) && $oneItem->status == 1 ? 'selected' : ''}} value="1">Công khai</option>
                                            <option {{isset($oneItem->status) && $oneItem->status == 0 ? 'selected' : ''}} value="0">Bản nháp</option>
                                        </select>
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group">
                                        <label>Meta robot</label>
                                        <select name="meta_robot" class="form-control">
                                            <option {{isset($oneItem->meta_robot) && $oneItem->meta_robot == 1 ? 'selected' : ''}} value="1">index</option>
                                            <option {{isset($oneItem->meta_robot) && $oneItem->meta_robot == 0 ? 'selected' : ''}} value="0">nofollow</option>
                                        </select>
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group">
                                        <label>Thời gian hiển thị</label>
                                        <input class="form-control" name="displayed_time" value="{{!empty($oneItem->displayed_time) ? date('Y-m-d\TH:i:s', strtotime($oneItem->displayed_time)) : date('Y-m-d\TH:i:s')}}" type="datetime-local">
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group">
                                        <label>Loại bài viết</label>
                                        <select name="type_post" class="form-control">
                                            <option {{isset($oneItem->type_post) && ($oneItem->type_post ?? 1) == 1 ? 'selected' : ''}} value="1">Soi kèo</option>
                                            <option {{isset($oneItem->type_post) && $oneItem->type_post == 2 ? 'selected' : ''}} value="2">Kèo tài xỉu</option>
                                            <option {{isset($oneItem->type_post) && $oneItem->type_post == 3 ? 'selected' : ''}} value="3">Kèo thẻ phạt</option>
                                            <option {{isset($oneItem->type_post) && $oneItem->type_post == 4 ? 'selected' : ''}} value="4">Kèo phạt góc</option>
                                        </select>
                                        <div class="invalid-feedback"></div> 
                                    </div>
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary">Lưu trữ</button>
                                        <div class="invalid-feedback"></div> 
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
<span style="font-family: arial, sans-serif;font-size: 18px!important;position:absolute;white-space:nowrap;visibility:hidden" id="title-sizer"></span>
<span style="font-family: arial, sans-serif;font-size: 18px!important;position:absolute;white-space:nowrap;visibility:hidden;" id="title-sizer-temp"></span>
<span style="font-family: arial, sans-serif;font-size:13px;position:absolute;visibility:hidden;white-space:nowrap;" id="description-sizer"></span>
<span style="font-family: arial, sans-serif;font-size:13px;position:absolute;visibility:hidden;white-space:nowrap;" id="description-sizer-temp"></span>
