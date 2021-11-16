$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.action-follow').click(function (e) {
        // e.preventDefault();
        var user_id = $(this).data('id');
        var cObj = $(this);
        var c = $(this).parent("button").find(".tl-follower").text();

        $.ajax({
            type: 'POST',
            url: '/follow',
            data: {
                user_id: user_id
            },
            success: function (data) {
                console.log(data.success);
                // if (jQuery.isEmptyObject(data.success.attached)) {
                //     // console.log(jQuery.isEmptyObject(data.success.attached));
                //     cObj.find("strong").text("Follow");
                //     cObj.find(".tl-follower").text(parseInt(c) - 1);
                // } else {
                //     // console.log(data.success);
                //     cObj.find("strong").text("UnFollow");
                //     cObj.parent("div").find(".tl-follower").text(parseInt(c) + 1);
                // }
                if (data.success === 'followed') {
                    cObj.find("strong").text("UnFollow");
                    cObj.parent("button").find(".tl-follower").text(parseInt(c) - 1);
                } else {
                    cObj.find("strong").text("Follow");
                    cObj.parent("button").find(".tl-follower").text(parseInt(c) + 1);
                }
            }
        });
    });
});
