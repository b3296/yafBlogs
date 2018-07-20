

<script>
function validateEmail(email) {
    var re = /^[a-z0-9\.\-\_]+\@[a-z0-9\-\_]+(\.[a-z0-9\-\_]+){1,4}$/;
    return re.test(email.toLowerCase());
}
$(function () {
    var vm = new Vue({
        el: '#vm',
        data: {
            name: '',
            email: '',
            password1: '',
            password2: ''
        },
        methods: {
            submit: function (event) {
                event.preventDefault();
                var $form = $('#vm');
                if (! this.name.trim()) {
                    return $form.showFormError('请输入名字');
                }
                if (! validateEmail(this.email.trim().toLowerCase())) {
                    return $form.showFormError('请输入正确的Email地址');
                }
                if (this.password1.length < 6) {
                    return $form.showFormError('口令长度至少为6个字符');
                }
                if (this.password1 !== this.password2) {
                    return $form.showFormError('两次输入的口令不一致');
                }
                var email = this.email.trim().toLowerCase();
                // $form.postJSON('registerDoit', {
                //     name: this.name.trim(),
                //     email: email,
                //     passwd: CryptoJS.SHA1(email + ':' + this.password1).toString()
                // }, function (err, r) {
                //     if (err) {
                //         console.log(err)
                //         return $form.showFormError(err);
                //     }
                //     return location.assign('/');
                // });
                data = {
                    name: this.name.trim(),
                    email: email,
                    passwd: this.password1.trim(),
                };
				$.ajax({
	                type:"post",
	                url:'registerDoit',
	                async:true,
	                dataType:"json",
	                data:data,
	                success: function (d) {
                        if (d.code == 1) {
                             fn_pushMessage("错误提示",d.msg,"alert");
                        } else if (d.code == 2) {
                            location.href = "/user/login";
                        } else {
                            fn_pushMessage("错误提示",d.msg,"alert");
                            $('img').click();
                        }
                    }
                    })
                function fn_pushMessage(type,content,format)
                {
                    if(format == 'alert'){
                        alert(type+':'+content);
                    }else{
                        console.log(type+':'+content);
                    }
                    
                }                
            }
        }
    });
    $('#vm').show();
});
</script>



    <div class="uk-width-2-3">
        <h1>欢迎注册！</h1>
        <form id="vm" v-on="submit: submit" class="uk-form uk-form-stacked">
            <div class="uk-alert uk-alert-danger uk-hidden"></div>
            <div class="uk-form-row">
                <label class="uk-form-label">名字:</label>
                <div class="uk-form-controls">
                    <input v-model="name" type="text" maxlength="50" placeholder="名字" class="uk-width-1-1">
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">电子邮件:</label>
                <div class="uk-form-controls">
                    <input v-model="email" type="text" maxlength="50" placeholder="your-name@example.com" class="uk-width-1-1">
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">输入口令:</label>
                <div class="uk-form-controls">
                    <input v-model="password1" type="password" maxlength="50" placeholder="输入口令" class="uk-width-1-1">
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">重复口令:</label>
                <div class="uk-form-controls">
                    <input v-model="password2" type="password" maxlength="50" placeholder="重复口令" class="uk-width-1-1">
                </div>
            </div>
            <div class="uk-form-row">
                <button type="submit" class="uk-button uk-button-primary"><i class="uk-icon-user"></i> 注册</button>
            </div>
        </form>
    </div>

