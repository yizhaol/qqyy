<?php
    error_reporting(0);
    $key = '8888';//
    if($_GET['url']) {
        $url = str_replace('[key]', $key, $_GET['url']);
        exit(file_get_contents($url));
    }
?>

<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>刷QQ音乐时长</title>
    <meta name="keywords" content="刷QQ音乐时长" />
    <meta name="description" content="刷QQ音乐时长" />
    <link href="https://www.layuicdn.com/layui-v2.5.6/css/layui.css" rel="stylesheet" />
    <script src="https://cdn.bootcdn.net/ajax/libs/layui/2.6.8/layui.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/layer/3.3.0/layer.js"></script>
    <link rel="icon"
        href="https://tse1-mm.cn.bing.net/th/id/OIP-C.FpoCAsORxnx5oNKw3nr_agHaH6?w=158&h=180&c=7&r=0&o=5&pid=1.7"
        type="image/ico">
    <link href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        th {
            border: 1px solid black;
            padding: 5px;
        }

        td {
            border: 1px solid black;
            padding: 5px;
        }
        .bg {
            margin-top: 10px;
            border-radius: 10px;
        }

        #img {
            transition: all 2.0s;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
            <div class="panel panel-primary" style="margin-top: 30px;">
                <div class="panel-heading" style="text-align: center;">
                    <h3 class="panel-title">
                    刷QQ音乐时长
                    </h3>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <div class="list-group">
                        <div class="list-group-item">
                              <img
                                src="https://tse1-mm.cn.bing.net/th/id/OIP-C.FpoCAsORxnx5oNKw3nr_agHaH6?w=158&h=180&c=7&r=0&o=5&pid=1.7"
                                width="120px" title="二维码" id="img">
                              <div style="margin-top:5px;color: red;" id="wb"></div>
                              <button type="button"  onclick="ksdl()" class="btn btn-primary btn-block">快速登录</button>
                        </div>
                        <div id="login" class="list-group-item">
                            <button type="button"  onclick="yjssc()" class="btn btn-primary btn-block">一键刷时长</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    layer.alert("二维码需要使用TIM扫码登录~或者手机快捷登录",{title:"温馨提示",icon:1})
    var uin = "";
    var skey = "";
    var pskey = "";
    let dlurl  = '';
    const filename = 'index.php'
//获取二维码
$(document).ready(function () {
	$url = './'+filename+'?url=http%3A%2F%2Fqqdh.rjk66.cn%2Findex%2Findex%2Fqqlogin%3Fdo%3Dgetqrpic%26r%3D0.3405512094850953'
	//获取base的值
	$.getJSON($url, function (json) {
		var data = json['data'];
		var qrsig = json['qrsig'];
        dlurl = json['url'];
		$("#qrsig").val(json['qrsig']);
		//获取图片
		$("#img").attr("src", "data:image/png;base64," + data);
		//判断图片的实效性
		var myVar =setInterval(function () {
			$url1 = './'+filename+'?url=http%3A%2F%2Fqqdh.rjk66.cn%2Findex%2Findex%2Fqqlogin%3Fdo%3Dqrlogin%26qrsig%3D' + qrsig;
			$.getJSON($url1, function (json1) {
				if (json1['saveOK'] == 2) {
					$("#wb").html("二维码未失效~");
				} else if (json1['saveOK'] == 3) {
					$("#wb").text("二维码扫取中~");
				} else if (json1['saveOK'] == 0) {
				    clearInterval(myVar);
				    $("#img").attr("style","border-radius: 80px")
				    uin = json1['uin'];
                    skey = json1['skey'];
                    pskey = json1['pskey'];
					$("#wb").text("你好【" + json1['uin'] + "】,已经登录成功~");
					$("#img").attr("src", "http://q.qlogo.cn/headimg_dl?dst_uin=" + json1['uin'] + "&spec=640&img_type=jpg");
				}
			});
		}, 3000);
	});
})

function ksdl() {
    var schemacallback = '';
                        var ua = window.navigator.userAgent.toLowerCase();
                        	var is_ios = ua.indexOf('iphone')>-1 || ua.indexOf('ipad')>-1;
                        	var schemacallback = '';
                        	if(is_ios){
                        		schemacallback = 'weixin://';
                        	}else if(ua.indexOf('ucbrowser')>-1){
                        		schemacallback = 'ucweb://';
                        	}else if(ua.indexOf('meizu')>-1){
                        		schemacallback = 'mzbrowser://';
                        	}else if(ua.indexOf('liebaofast')>-1){
                        		schemacallback = 'lb://';
                        	}else if(ua.indexOf('baidubrowser')>-1){
                        		schemacallback = 'bdbrowser://';
                        	}else if(ua.indexOf('baiduboxapp')>-1){
                        		schemacallback = 'bdapp://';
                        	}else if(ua.indexOf('mqqbrowser')>-1){
                        		schemacallback = 'mqqbrowser://';
                        	}else if(ua.indexOf('qihoobrowser')>-1){
                        		schemacallback = 'qihoobrowser://';
                        	}else if(ua.indexOf('chrome')>-1){
                        		schemacallback = 'googlechrome://';
                        	}else if(ua.indexOf('sogoumobilebrowser')>-1){
                        		schemacallback = 'SogouMSE://';
                        	}else if(ua.indexOf('xiaomi')>-1){
                        		schemacallback = 'miuibrowser://';
                        	}else{
                        		schemacallback = 'googlechrome://';
                        	}
                        if(is_ios){
                        		layer.alert('登录完请手动返回');
                        		window.open('wtloginmqq3://ptlogin/qlogin?qrcode='+encodeURIComponent(dlurl)+'&schemacallback='+schemacallback);
                        	}else{
                                layer.alert('登录完请手动返回');
                        		window.open('wtloginmqq://ptlogin/qlogin?qrcode='+encodeURIComponent(dlurl)+'&schemacallback='+schemacallback);
                        	}
}

//调用api
function yjssc(){
         if(uin != ""){
           var index = layer.load(2, { shade: [0.5, '#fff'] }); //添加加载动画
            $.ajax({
                url: './'+filename+'?url=https%3A%2F%2Ffkapi.rjk66.cn%2Fqqsc%2Fqqsc.php%3Fuin%3D'+uin,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    layer.close(index); //清除加载
                    layer.confirm(data.msg, {
                        btn: ['前往查看时长','取消'] //按钮
                    }, function(){
                        window.open('https://y.qq.com/m/client/vipexchange/index.html');
                    }, function(){
                    });
                }
            })
       }else{
        layer.alert("请先扫码登录")   
       }  
}
    </script>
</body>

</html>