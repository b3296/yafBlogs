<style>
    table tr{
            line-height: 26px;
    }
</style>
<ul class="breadcrumbs mini  fixed-top " style=" color: red; margin-top: 35px; cursor:pointer;z-index:-1;">
    <li><a href="/"><span class="icon mif-folder"></span></a></li>
    <li class="Dir_list">登录日志</li>
</ul>
<table class="table striped border bordered hovered" id="main_table_demo">
    <thead>
        <tr>
            <th>用户名</th>
            <th>登录时间</th>
            <th>登录IP</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<script type="text/html" id = "list_load">
    <tr>
        <td>{{d.userTrueName}}</td>
        <td>{{d.loginTime}}</td>
        <td>{{d.loginIp}}</td>
    </tr>
</script>
<div class="_pagination  place-right ">
</div>
<script>
    $(function(){
        var data = {'page':1};
        function ajaxLoad(url){  //加载列表
            $.ajax({
                type:"get",
                url:url,
                async:true,
                dataType:"json",
                data:data,
                success:function(d){
                    var table_obj = $("#main_table_demo tbody");
                    table_obj.html('');
                    if(d.code === 0){
                        var tpl = $('#list_load').html();
                        $.each(d.data.log, function (k, v) {
                            laytpl(tpl).render(v, function (string) {
                                table_obj.append(string);
                            });
                        });
                        var pagination = d.data.page;
                        $("._pagination").html(pagination);
                    }
                }
            })
        }

        //  记录页码
        var loc_href = window.location.href;
        if(loc_href.split("?")[1]) {
            data.page = loc_href[loc_href.length-1];
        }
        ajaxLoad("/loginlog/list");
        $("._pagination").on('click', 'a', function () {
            var p = $(this).html();
            if (p == "下一页" || p == "上一页"){
                p = $(this).data("page");
                if (!p){
                    return false;
                }
            }
            data.page = p
            var href = "/loginlog/list?page=" + data.page;
            if (history.pushState) {
                var state = ({
                    url: href, title: ""
                });
                window.history.pushState(state, "", href);
                ajaxLoad("/loginlog/list");
            } else {
                window.location.href = href;
            } // 如果不支持，使用旧的解决方案
        });

    })
</script>
