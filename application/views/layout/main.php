<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title> Awesome Yaf Webapp</title>
    <link href="/css/metro/metro.css" rel="stylesheet">
        <link href="/css/metro/metro-icons.css" rel="stylesheet">
        <link href="/css/metro/metro-responsive.css" rel="stylesheet">
        <link href="/css/metro/metro-schemes.css" rel="stylesheet">

        <link href="/css/app/main.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/uikit.min.css">
    <link rel="stylesheet" href="/css/uikit.gradient.min.css">
    <link rel="stylesheet" href="/css/awesome.css" />
    <script src="/js/jquery.min.js"></script>
    <script src="/js/sha1.min.js"></script>
    <script src="/js/uikit.min.js"></script>
    <script src="/js/sticky.min.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/awesome.js"></script>
    <script src="/js/laytpl.js"></script>
    
</head>
<body>
    <nav class="uk-navbar uk-navbar-attached uk-margin-bottom">
        <div class="uk-container uk-container-center">
            <a href="/blogs/list" class="uk-navbar-brand">Awesome</a>
            <ul class="uk-navbar-nav">
                <li data-url="blogs"><a href="/blogs/list"><i class="uk-icon-home"></i> 日志</a></li>
                <?php if(fn_isAdmin()):?>
                <li><a target="_blank" href="/loginlog/list"><i class="uk-icon-book"></i> 登录日志</a></li>
                <li><a target="_blank" href=""><i class="uk-icon-code"></i> 用户管理</a></li>
            <?php endif;?>
            </ul>
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav">
                <?php if(\Yaf\Session:: getInstance()->has('USER_NAME')):  ?>
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="#0"><i class="uk-icon-user"></i> <?php echo \Yaf\Session:: getInstance()->get('USER_NAME'); ?></a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                <li><a href="/user/logout"><i class="uk-icon-sign-out"></i> 登出</a></li>
                            </ul>
                        </div>
                    </li>
                <?php else:?>
                    <li><a href="/user/login"><i class="uk-icon-sign-in"></i> 登陆</a></li>
                    <li><a href="/user/register"><i class="uk-icon-edit"></i> 注册</a></li>
                <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="uk-container uk-container-center">
        <div class="uk-grid">
           <?php echo $_content_; ?>
        </div>
    </div>

    <div class="uk-margin-large-top" style="background-color:#eee; border-top:1px solid #ccc;">
        <div class="uk-container uk-container-center uk-text-center">
            <div class="uk-panel uk-margin-top uk-margin-bottom">
                <p>
                    <a target="_blank" href="http://weibo.com/liaoxuefeng" class="uk-icon-button uk-icon-weibo"></a>
                    <a target="_blank" href="https://github.com/michaelliao" class="uk-icon-button uk-icon-github"></a>
                    <a target="_blank" href="http://www.linkedin.com/in/liaoxuefeng" class="uk-icon-button uk-icon-linkedin-square"></a>
                    <a target="_blank" href="https://twitter.com/liaoxuefeng" class="uk-icon-button uk-icon-twitter"></a>
                </p>
                <p>Powered by <a href="http://awesome.liaoxuefeng.com">Awesome Python Webapp</a>. Copyright &copy; 2014. [<a href="/manage/" target="_blank">Manage</a>]</p>
                <p><a href="http://www.liaoxuefeng.com/" target="_blank">www.liaoxuefeng.com</a>. All rights reserved.</p>
                <a target="_blank" href="http://www.w3.org/TR/html5/"><i class="uk-icon-html5" style="font-size:64px; color: #444;"></i></a>
            </div>

        </div>
    </div>
</body>
</html>