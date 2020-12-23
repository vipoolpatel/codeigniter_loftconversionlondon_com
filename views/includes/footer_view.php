<footer>
    <div class='pre-footer'>
        <div class='container'>
            <div class='row'>
                <div class='span8'>
                    <h5 class='footer-header'>Latest From the Blog</h5>
                    <div class="row">
                        <?php if ($latest_from_blog = $this->common_lib->get_latest_from_blog()):
	foreach ($latest_from_blog as $post):
	?>
																													                            <div class="span4">
																													                            <h4><a href="<?php echo site_url('marketing/' . $post->page_seo); ?>"><?php echo ucfirst($post->title); ?></a></h4>
																													                            <p class="section-paragraph"><?php echo $this->common_lib->content_limiter(strip_tags($post->description), 350, '...'); ?></p>
																													                            <a href="<?php echo site_url('marketing/' . $post->page_seo); ?>">Read Full Story &raquo;</a>
																													                            </div>
																													                        <?php
endforeach;
else: ?>
                        </div>
                        <ul>
                            <li>There are no posts.</li>
                        </ul>
                        <?php endif;?>
                    </div>
                </div>

                <div class='span4'>
                    <h5 class='footer-header'>Connect with us</h5>
                    <ul class='footer-img-list thumbnails'>
                        <li class='span1'>
                            <a class='thumbnail' href="https://twitter.com/dental_seo">
                               <i class="fa fa-twitter"></i>
                            </a>
                        </li>

                        <li class='span1'>
                            <a class='thumbnail' href="<?php echo base_url() . 'marketing'; ?>">
                               <i class="fa fa-rss"></i>
                            </a>
                        </li>
                        <li class='span1'>
                            <a class='thumbnail' href="<?php echo base_url() . 'contact-us'; ?>">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class='deep-footer'>
        <div class='container'>
            <div class='row'>
                <div class='span6'>
                    <div class='copyright'>Copyright &copy; <?php echo date('Y'); ?> Loft Conversion London. All rights reserved.</div>
                </div>
                <div class='span6'>
                    <ul class='footer-links'>
                        <li><a href="<?php echo site_url('terms-and-conditions'); ?>">Terms & conditions</a></li>
                        <li><a href="<?php echo site_url('sitemap.xml'); ?>">XML Sitemap</a></li>
                        <li><a href="<?php echo site_url('sitemap.html'); ?>">HTML Sitemap</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>



<div id="box-boxzilla-hide" class="boxzilla boxzilla-bottom-right boxzilla-sample-box" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-color: rgb(0, 0, 0); border-width: 2px; border-style: solid;">
      <div class="container">
         <section class="box-content">
         <p style="font-size: 18px;line-height: 1.5;">
             Looking for a Loft Conversion Quote? Contact our team today on 0843 837 2065 , email us on info@loftconversionlondon.com or <a href="<?=base_url()?>contact-us"><strong>fill in this form</strong></a>. We promise to reply back quickly and arrange a convenient time to view your house and provide a quote.
         </p>
         </section>
         <aside  class="box-sidebar"><a style="float: right; background: #5f9ea0; color: #ffffff; padding: 13px;margin-top: 10px;" href="<?=base_url()?>contact-us">Enquire Now</a></aside>
      </div>
   <span class="boxzilla-close-icon">×</span>
</div>


<script type="text/javascript">
$(".boxzilla-close-icon").click(function(){
    $("#box-boxzilla-hide").hide(1000);
  });
</script>




</body></html>