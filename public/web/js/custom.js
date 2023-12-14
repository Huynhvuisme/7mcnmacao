$(document).on('change', '.loadMoreDate', function () {
    let date = $(this).val();
    $.ajax({
        data: {date: date},
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            res = $(res);
            $('.ajax_content').html(res.find('.ajax_content'));
        }
    })
});
$(document).on('change', '.loadMoreRound', function () {
    let round = $(this).val();
    $.ajax({
        data: {round: round},
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            res = $(res);
            $('.ajax_content').html(res.find('.ajax_content'));
        }
    })
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 500) {
        $('#menu').addClass('scroll-active');
        $(".back-top").addClass('d-block');
    } else {
        $('#menu').removeClass('scroll-active');
        $(".back-top").removeClass('d-block');
    }
});

$('.back-top div').on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({scrollTop: 0}, 500, 'linear');
});

if($('.summary-title') && $('.list-unstyled')){
    $('.summary-title').on('click', function(){
        $(this).parent().find('.list-unstyled').slideToggle();
    })
}

$('.collapsible').on('click', function (e) {
    e.preventDefault();
    $(this).toggleClass('active');
});

if($('.btn-cat-load-more'))
{
    $('.btn-cat-load-more').on('click', function (e) {
        e.preventDefault();
        var _this = $(this),
            category_id = _this.data('catid'),
            page = _this.data('page'),
            keyWord = _this.data('keyword'),
            tag_id = _this.data('tagid'),
            url = "";
        if(typeof keyWord != 'undefined') {
            console.log(keyWord)
            url = "/search/load-more-posts?keyword=" + keyWord + '&page='+  page;
        }
        if(typeof category_id != 'undefined')
        {
            url = "/load-more-posts/" + category_id + "/" + page;
        }
        if(typeof tag_id != 'undefined')
        {
            url = "/tag/load-more-posts/" + tag_id + "/" + page;
        }
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                if (response.status == 204) {
                    _this.text('Không còn bài viết phù hợp');
                }else if(response.status == 200){
                    $('.list-more-posts').append(response.data);
                    _this.data('page', page+1);
                    _this.text('Tải thêm bài viết');
                }
            },
            beforeSend: function() {
                _this.text('Đang tải thêm tin tức...');
             },

        });
    });
}

document.addEventListener('DOMContentLoaded', function(){
    var url = location.href;
    if(url.indexOf("#") > 0)
    {
        let position = url.substring(url.indexOf("#")+1);
        scrollToPosition(position);
    }

    if($('#lich-su-doi-dau').length > 0){
        scrollToPosition('lich-su-doi-dau');
    }

    function scrollToPosition(id){
            let target = document.getElementById(id);
            let targetRect = target.getBoundingClientRect();
            let bodyRect = document.body.getBoundingClientRect();
            $("html,body").animate({scrollTop: targetRect.top - bodyRect.top - 50}, "slow");
    }
});

$('.btn-show-ltd').click(function (e) {
    e.preventDefault();
    let _this = $(this);
    let date = _this.data('date');
    $('.list-date-ltd li').removeClass('sub-menu-active');
    _this.parent().addClass('sub-menu-active');
    $.ajax({
        url: '/ajax_get_ltd/' + date,
        type: 'GET',
        dataType: 'html',
        success: function (res) {
            if (res) {
                $('.ajax-content-ltd').html(res);
            }
        }
    });
});
