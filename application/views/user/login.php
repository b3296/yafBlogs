<!DOCTYPE html>
<html class="uk-height-1-1">
<head>
    <meta charset="utf-8" />
    <title>登录 - Awesome Yaf Webapp</title>
    <link rel="stylesheet" href="/css/uikit.min.css">
    <link rel="stylesheet" href="/css/uikit.gradient.min.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/sha1.min.js"></script>
    <script src="/js/uikit.min.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/awesome.js"></script>
    <script>
$(function() {
    var vmAuth = new Vue({
        el: '#vm',
        data: {
            email: '',
            passwd: ''
        },
        methods: {
            submit: function(event) {
                 event.preventDefault();
                // var
                //     $form = $('#vm'),
                //     email = this.email.trim().toLowerCase(),
                //     data = {
                //         email: email,
                //         passwd: this.passwd==='' ? '' : CryptoJS.SHA1(email + ':' + this.passwd).toString()
                //     };
                // $form.postJSON('/user/loginDoit', data, function(err, result) {
                //     if (! err) {
                //         location.assign('/');
                //     }
                // });
                var data = {};
                var email = this.email.trim().toLowerCase();
                var testBox = $('#verify').css('display');
                if (testBox == "none") {
                    data = {"email": email, "passwd": this.passwd}
                } else {
                    var testCode = $('#code').val();
                    data = {"email": email, "passwd": this.passwd, "vcode": testCode}
                }  
                $.ajax({
                    url: '/user/loginDoit',
                    type: 'post',
                    data: data,
                    dataType: 'json',
                    success: function (d) {
                        if (d.code == 1) {
                            $('#verify').css('display', 'block');
                             fn_pushMessage("错误提示",d.msg,"alert");
                        } else if (d.code == 2) {
                            location.href = "/blogs/list";
                        } else {
                            fn_pushMessage("错误提示",d.msg,"alert");
                            $('img').click();
                        }
                    }
                });                              
                //按回车键自动登录
                $("body").keydown(function () {
                    if (event.keyCode == "13") {
                        $(".primary").click();
                    }
                });
            }
            
        }
    });
    function fn_pushMessage(type,content,format)
    {
        if(format == 'alert'){
            alert(type+':'+content);
        }else{
            console.log(type+':'+content);
        }                
    }    
});
    </script>
</head>
<body class="uk-height-1-1">
    <div class="uk-vertical-align uk-text-center uk-height-1-1">
        <div class="uk-vertical-align-middle" style="width: 320px">
            <p><a href="/" class="uk-icon-button"><i class="uk-icon-html5"></i></a> <a href="/">Awesome Yaf Webapp</a></p>
            <form id="vm" v-on="submit: submit" class="uk-panel uk-panel-box uk-form">
                <div class="uk-alert uk-alert-danger uk-hidden"></div>
                <div class="uk-form-row">
                    <div class="uk-form-icon uk-width-1-1">
                        <i class="uk-icon-envelope-o"></i>
                        <input v-model="email" name="email" type="text" placeholder="电子邮件" maxlength="50" class="uk-width-1-1 uk-form-large">
                    </div>
                </div>
                <div class="uk-form-row">
                    <div class="uk-form-icon uk-width-1-1">
                        <i class="uk-icon-lock"></i>
                        <input v-model="passwd" name="passwd" type="password" placeholder="口令" maxlength="50" class="uk-width-1-1 uk-form-large">
                    </div>
                </div>
                <div style="display: none;margin-top:10px;" id="verify" class="uk-form-row" >
                    <div class="uk-form-icon uk-width-1-1 data-role="input" >
                        <label for="user_password">验证码:</label>
                        <input type="text" name="vcode" id="code" style="padding-right: 33px;">
                    </div>
                    <div style="text-align: left;">
                        <img src="/user/vcode" style="cursor:pointer;width:120px;height:60px;" onclick="this.src = '/user/vcode/rands/' + Math.random()"/>
                    </div>
                </div>                
                <div class="uk-form-row">
                    <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large"><i class="uk-icon-sign-in"></i> 登录</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>