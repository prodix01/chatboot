$(function() {
    const MESSAGE_TYPE_AI = 1;
    const MESSAGE_TYPE_USER = 2;

    // 会話ログ表示
    var talk = function(messageType, message) {
        let div = $('<div>');
        let p = $('<p>');
        if(messageType == MESSAGE_TYPE_USER) {
            $(p).addClass('user');
        } else {
            $(p).addClass('ai');
        }
        $(p).text(message);
        $(div).append(p);
        $('#talk_history').append(div);

        $('#talk_history').scrollTop($('#talk_history')[0].scrollHeight);
    };
    

    // チャット送信
    var sendChat = function(message) {
        $.ajax({
            url: "talk.php",
            type: "POST",
            data: {
                "message": message
            }
        }).then(
            (data) => {
                var aiText = data.message;

                talk(MESSAGE_TYPE_AI, aiText);
            },
            (error) => {
            },
        );
    };

    // 送信ボタン押下時
    $('input[type="submit"]').on('click', function(e) {
        console.log("push");
        var obj = $('input[name=chat_text]');
        var chatText = $.trim(obj.val());
        if(0 < chatText.length) {
            talk(MESSAGE_TYPE_USER, chatText);

            sendChat(chatText);

            $('input[name=chat_text]').focus();
        }

        obj.val('');
    });

    // 起動時の会話
    setTimeout(function() {
        var startMessage = "何かお話しませんか？";
        talk(MESSAGE_TYPE_AI, startMessage);
    }, 0.4 * 1000);

    $('input[name=chat_text]').focus();
});