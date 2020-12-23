<?php
//Location: app/views/faqs_view.php
$this->load->view('includes/header_view');
?>
<style>
.blog-page .recent h2, .blog-page .archive h2 {
    font-size: 25px;
}
.blog-page .recent ul {
    list-style: none;
    margin-bottom: 30px;
}
.blog-page ul {
    margin-left: 0;
}
.blog-page .recent ul li a {
    font-size: 16px;
    font-family: "Abel","Helvetica Neue",Helvetica,Arial,sans-serif;
    color: #000;
    padding: 10px 0;
    display: block;
    border-bottom: 1px dashed #999;
}
.white-card
{
    -webkit-box-shadow: 0px 0px 0px 0px #b4b6a9, 0px 0px 0px 0px white inset;
}
</style>
<section class='section-wrapper about-page-w blog-page'>
    <div class='container'>
        <h1 class='section-main-header'><?php echo $blog->title; ?></h1>
        <a href="<?php echo site_url('blog'); ?>">&laquo; Back to blog</a><br><br>
        <?php if ($blog): ?>
   <div class="span9" style="margin: 0px;">
            <div class="post-info clearfix">
                <div class="pull-left">
                    <span class="post-date"><?php echo date('F j, Y', strtotime($blog->date)); ?></span>
                    <a class="post-comments" href="#"><?php echo $this->common_lib->get_total_comment_num_by_id($blog->id);?> Comment(s)</a>
                </div>
                <div class="pull-right" style="width:353px">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_button_pinterest_pinit"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <script type="text/javascript">var addthis_config = {"data_track_addressbar": false};</script>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51bb03f60578afeb"></script>
                    <!-- AddThis Button END -->
                </div>
            </div>
            <div class="row">
                <div class="span9" style="text-align: center;margin-bottom: 20px;margin-top: 20px;"><img src="<?php echo site_url('images/blog/medium/' . $blog->image); ?>"></div>


                <div class="span9"><p class="section-paragraph"><?php echo $blog->description; ?></p></div>

            </div>
   </div>
        <div class="span3 main">
                     <?php $this->load->view('includes/blog_sidebar');?>
                </div>

        <div style="clear:both"></div>
        <hr />
        <div style="clear:both"></div>


            
            <h3>Comments</h3>
            <?php if ($comments): ?>

                <?php foreach ($comments as $comment): ?>
                    
                        <div class="row">
                            <div class="span12">
                                <div class="white-card clearfix">
                                    <strong><?php echo date('F j Y', strtotime( $comment->date )); ?>,  <?php echo $comment->author != '' ? $comment->author : "Anonymous"; ?></strong>
                                    <br><br>
                                <p class="section-paragraph"><?php echo $comment->comment; ?></p>
                               
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            <?php else: ?>
                <h5>No comments</h5>
            <?php endif; ?>
            <h3>Leave Comment</h3>
            <form class="form-horizontal" method="post" action="" style="width:60%">
                <div class="control-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls">
                        <input type="text" id="inputEmail" name="name" style="width:100%" placeholder="Name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input type="email" id="email" name="email" style="width:100%" placeholder="Email">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Comment</label>
                    <div class="controls">
                        <textarea id="comment" class="required" name="comment" style="width:100%"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <!--<label class="checkbox">
                            <input type="checkbox"> Remember me
                        </label>-->
                        <input type="submit" class="btn" value="Post Message">
                    </div>
                </div>
            </form>
            <p class="section-paragraph"><?php echo isset($msg) ? $msg : ''; ?></p>
        <?php endif; ?>
    </div>
</div>
</section>
<script>
    $('.form-horizontal').validate();
</script>
<?php $this->load->view('includes/footer_view'); ?>
