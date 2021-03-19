<html lang="ja">
    <head>
        <title>KIM Chat-Bot</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=chrome">
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://kit.fontawesome.com/54e7bb2a5a.js" crossorigin="anonymous"></script>
        <link rel='stylesheet' href='css/app.css'/>
    </head>

    <body>
        <div><button class="fun-btn" id="actions"type="button" onClick="window.location.reload()">リセット</button></div>    
        <br/>
        <div class="wrapper">
            <div class="title">KIM CHAT BOT</div>
            
            <!-- log領域 -->
            <div class="form" id="form">     
                {{-- DBからもらったチャットデータ --}}
                <div id="result"></div>

                <div id="talk_history">
                    <div class="msg-header"></div>
                </div>
            </div>
            <!-- 入力領域 -->
            <div class="typing-field">
                <div class="input-data" >
                    <input id="textb" type="text" name="chat_text" value="" placeholder="テキスト" {{-- required --}}/>
                    <button id="action"type="button" >送信</button>
                </div>
            </div>  
            </div>
        </div>
    </body>
    
    {{-- DBにチャットデータをPOST --}}
    <script>
        $(function(){
        
            //actionボタン
            $('#action').click(function(){
                
                //データを持ってくる場所を指定。
                //user
                var lastName = $('#textb').val();
                //bot
                var firstName = $('p').last().text();
                var action = $('#action').text();
                
                //UserとBotの入力が全部入っていたら
                if(firstName !='' && lastName != ''){
              
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{firstName:firstName,lastName:lastName,action:action },
                        success:function(data){
                            //データPOSTが成功したら
                            //alert(data);
                        }
                    });                
                } else {
                    alert('テキストを入力して下さい。');
                }
            }); 
        });
    </script>

    {{-- API 接続、チャット機能 --}}
    <script>
        $(document).ready(function() {

            const MESSAGE_TYPE_AI = 1;
            const MESSAGE_TYPE_USER = 2;

            // チャット表示
            var talk = function(messageType, message) {
                let div = $('<div>');
                let div_b = $('<div>');
                let div_u = $('<div>');
                let div_i = $('<div>');
                let i = $('<i>');
                let p = $('<p>');
                let input = $('<input/>');
                if(messageType == MESSAGE_TYPE_AI) {
                    $(p).addClass('aii');
                    $(p).attr('id','aii');
                    $(input).attr('type', 'text');
                    $(input).attr('id','ai');
                    $(div).addClass('msg-header');
                    $(div_b).addClass('bot-inbox inbox');
                    $(div_i).addClass('icon');
                    $(i).addClass('fas fa-robot');
                    
                } else {
                    $(p).addClass('user');
                    $(p).attr('id','user');
                    $(div).addClass('msg-header');
                    $(div_u).addClass('user-inbox inbox');
                }
                $(input).text(message);
                $(p).text(message);
                $(div).append(p);
                $(div_i).append(i);
                
                if(messageType == MESSAGE_TYPE_AI){
                    $(div_b).append(div_i);
                    $(div_b).append(div);
                    $('#talk_history').append(div_b);
                } else {
                    $(div_u).append(div);
                    $('#talk_history').append(div_u);
                }

                //スクロールを下に移動する。
                $('#form').scrollTop($('#form')[0].scrollHeight);

                console.log("kaiwa");
                      
            };

            
            // チャット送信
            var sendChat = function(message) {

                console.log("sousin");

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


            // 送信ボタン
            $('button[type="button"]').on('click', function(e) {

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

            
            //エンターキー
            $("#textb").keydown(function(key) {

                if (key.keyCode == 13) {
                //エンターキー入力時,ボタンを押す。
                $('#action').click();
                }

            });


            // 起動時のチャット
            setTimeout(function() {
                console.log("kidou");
                var startMessage = "何でも聞いて下さい！";
                talk(MESSAGE_TYPE_AI, startMessage);
            }, 0.4 * 1000);

            $('input[name=chat_text]').focus();
        });
        
    </script>

    {{-- チャットデータ読み込み --}}
    <script>
        $(document).ready(function(){

            //チャットデータを読み込み関数を呼び出す
            loadChatLog();

            function loadChatLog()
            {
                var action = "select";
                //チャットデータを select.php からもらう。
                $.ajax({
                    url:"select.php",
                    method:"POST",
                    data:{action:action},
                    success:function(data){
                        //alert(data);
                
                        //データをhtmlでもらう。
                        $('#result').html(data);
                    }
                })
            }

        });
    </script>

    {{-- 削除機能 --}}
    <script>
        $(document).ready(function(){
            //[2] actionsが押された時、
            $('#actions').click(function(){

                var actions = $('#actions').text(); 

                $.ajax({
                    url:"delete.php",
                    method:"POST",
                    data:{actions:actions},
                    success:function(data){        
                        //alert(data);
                    }
                });
            });
        });
    </script>
</html>