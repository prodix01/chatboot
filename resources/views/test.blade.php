<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=chrome">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>crud</title>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- Bootstrap -->
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border:1px solid #ccc;
border-radius:5px;
margin-top:100px;


}

</style>
</head>
<body>


<div class="container box">
<h3 align="center">php Ajax Crud</h3>

<br/><br/>
<br/><br/>
<label>성을 입력하세요</label>
<input type="text"  id="user_name" class="form-control" />

<br/>
<label>이름을 입력하세요</label>
<input type="text"  id="last_name" class="form-control" />

<br/><br/>

<div align="center">
<button type="button" id="action" class="btn btn-warning">送信</button>
</div>

<br/><br/>


<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<div id="result" class="table-responsive">
</div>

</div>

</body>


<script>

$(document).ready(function(){

fetchUser();

function fetchUser()
{
var action = "select";
//[1] users 리스트를 select.php 에서 받아온다.
$.ajax({
// url:"select.php",
// method:"POST",
// data:{action:action},
// success:function(data){
// $('#first_name').val('');
// $('#last_name').val('');
// $('#action').text("추가");
// $('#result').html(data);
// }
})
}

//[2] 추가 버튼 클릭했을 때 작동되는 함수
$('#action').click(function(){

//각 엘리먼트들의 데이터 값을 받아온다.
var firstName = $('#user_name').val();
var lastName = $('#user_name').val();
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

//입력 후 리스트 다시 갱신
fetchUser();
}
});

}else{
alert('빈칸을 입력해 주세요');
}
});

});

</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../bootstrap/js/bootstrap.min.js"></script>

</html>