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
        <h1 class='section-main-header'>Loft Conversion London Blog</h1>
        <?php if ($blogs): ?>
            <ul id="all_blogs">
                <div class="span9" style="margin: 0px;">

                    <?php foreach ($blogs as $blog): ?>
                        <div class="white-card recent-post clearfix">
                            <div class='row'>
        <!--                            <div class="span3 blog_date"><a href="<?php echo site_url('marketing/' . $blog->page_seo); ?>"><img src="<?php echo $blog->image != '' ? site_url('images/blog/small/' . $blog->image) : site_url('images/no-pic.jpg'); ?>"></a>
                                </div>-->
                                <div class="span9" style="padding-right: 20px;">
                                    <h5 class="recent-post-header"><a href="<?php echo site_url('marketing/' . $blog->page_seo); ?>"><?php echo ucfirst($blog->title); ?></a></h5>
                                    <div class="post-info clearfix">
                                        <div class="pull-left">
                                            <span class="post-date"><?php echo date('F j, Y', strtotime($blog->date)); ?></span>
                                            <a class="post-comments" href="#"><?php echo $this->common_lib->get_total_comment_num_by_id($blog->id); ?> Comment(s)</a>
                                        </div>
                                        <div class="pull-right" style="width:353px">
                                            <!-- AddThis Button BEGIN -->
                                            <div class="addthis_toolbox addthis_default_style ">
                                                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                                                <a class="addthis_button_tweet"></a>
                                                <a class="addthis_button_pinterest_pinit"></a>
                                                <a class="addthis_counter addthis_pill_style"></a>
                                            </div>
                                            <script type="text/javascript">var addthis_config = {"data_track_addressbar": true};</script>
                                            <!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51bb03f60578afeb"></script>-->
                                            <!-- AddThis Button END -->
                                        </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                    <p style="text-align: center;">
                                        <a href="<?php echo site_url('marketing/' . $blog->page_seo); ?>"><img src="<?php echo $blog->image != '' ? site_url('images/blog/small/' . $blog->image) : site_url('images/no-pic.jpg'); ?>"></a>
                                    </p>
                                    <div style="clear: both;"></div>
                                    <p class="section-paragraph"><?=$blog->description?></p>
                                    <!--<a href="<?php echo site_url('marketing/' . $blog->page_seo); ?>" class="btn read_more">read more &raquo;</a>-->
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>

                <div class="span3 main">
                     <?php $this->load->view('includes/blog_sidebar');?>
                </div>
            </ul>
            <div style="clear: both;"></div>
            <div class="pagination">
                <?php echo $links; ?>
            </div>
        <?php else: ?>
            <h3>No Blogs.</h3>
        <?php endif;?>
    </div>
</section>
<?php $this->load->view('includes/footer_view');?>
