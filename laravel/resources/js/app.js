import './bootstrap';

$(document).ready(function () {
    $('.like-btn').click(function () {
        var post_id = $(this).data('id');
        $clicked_btn = $(this);

        if ($clicked_btn.hasClass('far')) {
            action = 'like';
        } else if ($clicked_btn.hasClass('fas')) {
            action = 'dislike';
        }

        $.ajax({
            url: '/like',
            type: 'POST',
            data: {
                action: action,
                post_id: post_id
            },
            success: function (data) {
                console.log(data);
                if (action == "like") {
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fas');
                } else if (action == "dislike") {
                    $clicked_btn.removeClass('fas');
                    $clicked_btn.addClass('far');
                }

                // 투표 결과 업데이트
                $clicked_btn.siblings('span.likes').text(data.likes);
                $clicked_btn.siblings('span.dislikes').text(data.dislikes);

                // 버튼 활성/비활성화 설정
                $clicked_btn.siblings('i.fas').removeClass('fas').addClass('far');
            }
        });
    });
});