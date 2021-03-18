<html lang="ja">
    <head>
        <title>KIM Chat-Bot</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=chrome">
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://kit.fontawesome.com/54e7bb2a5a.js" crossorigin="anonymous"></script>
        <link rel='stylesheet' href='css/app.css' />
        
    </head>
    <body>
        <div><button id="actions"type="button" >リセット</button></div>    
        <div class="wrapper">
            <div class="title">金　チャットボット</div>
            
            <!-- log領域 -->
            <div class="form" id="form"> 
                <div id="talk_history">
                    <div class="msg-header">
                        <div id="result" class="table-responsive">
                        </div>
                        
                    </div>
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
    
    {{-- 받아오기 --}}
    <script>

        $(function(){
        
        fetchUser();
        
        function fetchUser()
        {
        var action = "select";
        //[1] users 리스트를 select.php 에서 받아온다.
        }
        
        //[2] 추가 버튼 클릭했을 때 작동되는 함수
        $('#action').click(function(){
            
        
        //각 엘리먼트들의 데이터 값을 받아온다.

        //user
        var firstName = $('#textb').val();

        //bot
        var lastName = $('#textb').val();

        var action = $('#action').text();
        
        //성과 이름이 올바르게 입력이 되면
        if(firstName !='' && lastName != ''){
        
        $.ajax({
        //insert page로 위에서 받은 데이터를 넣어준다.
        url:"action.php",
        method:"POST",
        data:{firstName:firstName,lastName:lastName,action:action },
        success:function(data){
        
        //성공하면 action.php 에서 출력된 데이터가 넘어온다.
        alert(data);
        
        }
        });
        
        }else{
        alert('빈칸을 입력해 주세요');
        

        }
        });
        
        });
        
    </script>
    {{-- API 받아오기 --}}
    <script>
        $(document).ready(function() {

            
            const MESSAGE_TYPE_AI = 1;
            const MESSAGE_TYPE_USER = 2;

            // 会話ログ表示
            var talk = function(messageType, message) {
                let div = $('<div>');
                let div_b = $('<div>');
                let div_u = $('<div>');
                let div_i = $('<div>');
                let i = $('<i>');
                let p = $('<p>');
                if(messageType == MESSAGE_TYPE_AI) {
                    $(p).addClass('ai');
                    $(p).attr('id','ai');
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
                
                $('#form').scrollTop($('#form')[0].scrollHeight);
                
            };

            
            // チャット送信
            var sendChat = function(message) {

                console.log("aipush");

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
                //엔터키 입력 시 작업할 내용
                console.log("push");
                var obj = $('input[name=chat_text]');
                var chatText = $.trim(obj.val());
                if(0 < chatText.length) {
                    talk(MESSAGE_TYPE_USER, chatText);

                    sendChat(chatText);

                    $('input[name=chat_text]').focus();
                }

                obj.val('');

                }

            });


            // 起動時の会話
            setTimeout(function() {
                var startMessage = "何でも聞いて下さい！";
                talk(MESSAGE_TYPE_AI, startMessage);
            }, 0.4 * 1000);

            $('input[name=chat_text]').focus();
        });
        

    </script>
    {{-- 불러오기 --}}
    <script>
        $(document).ready(function(){

            fetchUser();
            function fetchUser()
            {
                var action = "select";
                //users 리스트를 select.php 에서 받아온다.
                $.ajax({
                    url:"select.php",
                    method:"POST",
                    data:{action:action},
                    success:function(data){
                        //alert(data);
                        $('#first_name').val('');
                        $('#last_name').val('');
                        //$('#action').text("");
                        $('#result').html(data);
                    }
                })

            }

        });

    </script>
    {{-- 삭제하기 --}}
    <script>
        $(document).ready(function(){
        
        fetchUser();
        
        function fetchUser()
        {
        var action = "select";
        
        }
        
        //[2] 추가 버튼 클릭했을 때 작동되는 함수
        $('#actions').click(function(){
        
        //각 엘리먼트들의 데이터 값을 받아온다.
        var actions = $('#actions').text();
        
        //성과 이름이 올바르게 입력이 되면
        
        
        $.ajax({
        url:"delete.php",
        method:"POST",
        data:{actions:actions},
        success:function(data){
        
        alert(data);
        
        //입력 후 리스트 다시 갱신
        fetchUser();
        }
        });
        
        });
        
        });



    </script>
</html>