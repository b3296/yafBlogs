
<script>
$(function () {
    var $form = $('#form-comment');
    $form.submit(function (e) {
        e.preventDefault();
        $form.showFormError('');
        var content = $form.find('textarea').val().trim();
        if (content==='') {
            return $form.showFormError('请输入评论内容！');
        }
        data = {'content':content};
		$.ajax({
	        url: '/blogs/comment_add',
	        type: 'post',
	        data: data,
	        dataType: 'json',
	        success: function (d) {
	            if (d.code == 1) {
	                $('#verify').css('display', 'block');
	                 fn_pushMessage("错误提示",d.msg,"alert");
	            } else if (d.code == 2) {
	                location.href = "/blogs/content/id/"+d.data;
	            } else {
	                fn_pushMessage("错误提示",d.msg,"alert");
	                $('img').click();
	            }
	        }
	    });        
    });
	    
});
</script>


    <div class="uk-width-medium-3-4">
        <article class="uk-article">
            <h2><?php echo $blog['name'];?></h2>
            <p class="uk-article-meta">发表于<?php echo date('Y-m-d H:i:s',$blog['created_at']);?></p>
            <p><?php echo $blog['content'];?></p>
        </article>

        <hr class="uk-article-divider">

    <?php if(\Yaf\Session:: getInstance()->has('USER_NAME')):?>
        <h3>发表评论</h3>

        <article class="uk-comment">
            <header class="uk-comment-header">
                <img class="uk-comment-avatar uk-border-circle" width="50" height="50" src="/img/tx.jpg">
                <h4 class="uk-comment-title"><?php echo \Yaf\Session:: getInstance()->get('USER_NAME'); ?></h4>
            </header>
            <div class="uk-comment-body">
                <form id="form-comment" class="uk-form">
                    <div class="uk-alert uk-alert-danger uk-hidden"></div>
                    <div class="uk-form-row">
                        <textarea rows="6" placeholder="说点什么吧" style="width:100%;resize:none;"></textarea>
                    </div>
                    <div class="uk-form-row">
                        <button type="submit" class="uk-button uk-button-primary"><i class="uk-icon-comment"></i> 发表评论</button>
                    </div>
                </form>
            </div>
        </article>

        <hr class="uk-article-divider">
    <?php endif;?>

        <h3>最新评论</h3>

        <ul class="uk-comment-list">
            <?php 
            	if($comments != []):
            	foreach ($comments as  $comment) {
            	
            ?>
            <li>
                <article class="uk-comment">
                    <header class="uk-comment-header">
                        <img class="uk-comment-avatar uk-border-circle" width="50" height="50" src="/img/tx.jpg">
                        <h4 class="uk-comment-title"><?php echo $comment['user_name']; if($comment['user_id']==$blog['user_id']):  echo '(作者)'; endif; ?></h4>
                        <p class="uk-comment-meta"><?php echo date('Y-m-d H:i:s',$comment['created_at']); ?></p>
                    </header>
                    <div class="uk-comment-body">
                        <?php echo $comment['content'];?>
                    </div>
                </article>
            </li>
            <?php 
	        	} 
	            else: 
        	?>
            <p>还没有人评论...</p>
            <?php endif; ?>
        </ul>

    </div>