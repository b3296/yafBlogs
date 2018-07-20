 <div id="main_table_demo" class="uk-width-medium-3-4"></div>
 <script type="text/html" id = "list_load">
 	
        <article class="uk-article">
            <h2><a href="/blogs/content/id/{{d.id}}">{{d.name}}</a></h2>
            <p class="uk-article-meta">发表于{{d.created_at}}</p>
            <p>{{d.summary}}</p>
            <p><a href="/blogs/content/id/{{d.id}}">继续阅读 <i class="uk-icon-angle-double-right"></i></a></p>
        </article>
        <hr class="uk-article-divider">
   
</script>    
<div class="_pagination  uk-width-medium-3-4 ">

</div>

<script>
$(function(){
        var data = {'page':1};
        function ajaxLoad(url){ //  加载操作日志
            $.ajax({
                type:"get",
                url:url,
                async:true,
                dataType:"json",
                data:data,
                success:function(d){
                    var table_obj = $("#main_table_demo ");
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

        //  记录页面页码
        var loc_href = window.location.href;
        if(loc_href.split("?")[1]) {
            data.page = loc_href[loc_href.length-1];
        }
        ajaxLoad("/blogs/list");
        $("._pagination").on('click', 'a', function () {
            var p = $(this).html();
            if (p == "下一页" || p == "上一页"){
                p = $(this).data("page");
                if (!p){
                    return false;
                }
            }
            data.page = p
            var href = "/blogs/list?page=" + data.page;
            if (history.pushState) {
                var state = ({
                    url: href, title: ""
                });
                window.history.pushState(state, "", href);
                ajaxLoad("/blogs/list");
            } else {
                window.location.href = href;
            } // 如果不支持，使用旧的解决方案
        });

        
    })	
</script>



