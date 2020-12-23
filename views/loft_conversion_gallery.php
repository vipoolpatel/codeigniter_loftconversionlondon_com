<?php
   $this->load->view('includes/header_view');
   ?>
<link href="<?php echo site_url('css/custom.css'); ?>" rel="stylesheet">
<link href="<?php echo site_url('gallery/css/lightbox.min.css'); ?>" rel="stylesheet">
<style>
   .slider-header {
   color: #fff;
   max-width: 100% !important;
   float: none !important;
   text-align: center !important;
   text-shadow: 2px 2px 0px #09B0F3;
   border-bottom: none;
   }
   .slider-w .slider-sub-header {
   clear: both;
   display: block;
   width: 100%  !important;;
   max-width: 100%  !important;;
   float: none  !important;;
   text-align: center  !important;
   line-height: 1.5;
   padding-right: 10px;
   font-size: 19px;
   color: #bdd3d2;
   }
   .slider-w .item {
   height: auto !important;
   margin-bottom: 35px;
   }
   .slider-header strong {
   color: #FFECB0;
   }

.grid-img-view {
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(250px, 1fr) );

}


.col-grid {
  padding: 5px;
}
.col-grid img {
    border-radius: 8px;
    border: 1px solid #ddd;
}


</style>
<?php
   if (!empty($details->background_image)) {
       ?>
<div class="carousel slide over-something" id="homepage-carousel" style="background-image:url(images/background/<?=$details->background_image?>);background-size: cover;background-repeat: no-repeat;" >
<div class="carousel-inner slider-w" style="background: border-box;">
<?php
   } else {
       ?>
<div class="carousel slide over-something" id="homepage-carousel" style="background: #76a3a0;">
   <div class="carousel-inner slider-w" style="background-image: none;background: #76a3a0;">
      <?php }
         ?>
      <div class="active item">
         <div class="container">
            <h1 class="slider-header" style="border-bottom: 2px solid #58807d;"><?php echo $details->title; ?></h1>
            <h2 class="slider-sub-header"><?php echo $details->sub_title; ?></h2>
            <h2 id="custom_h2"><?php echo $details->main_title_1; ?></h2>
            <h2 id="custom_h2"><?php echo $details->main_title_2; ?></h2>
            <?php
               if (!empty($details->on_contact)) {
                   ?>
            <a style="margin-top: 40px!important;margin: 0 auto;text-align: center; float: none;" href="<?=base_url()?>contact-us" class="btn btn-warning text-center">Contact Us</a>
            <?php }
               ?>
         </div>
      </div>
   </div>
</div>


<?php
   if (!empty($getGallery)) {
       foreach ($getGallery as $value) {
           $getGalleryImage = $this->db->where('gallery_id', $value->id);
           $getGalleryImage = $this->db->get('tbl_gallery_image')->result();
       ?>
            <section class='section-wrapper about-page-w' style="padding-bottom: 20px;">
               <div class="container">
                  <h3 class="section-header" style="text-align: left;border-bottom: none;box-shadow: none;padding-left: 5px;"><?=$value->title?></h3>
                    <div class="grid-img-view">
                          <?php
                           foreach ($getGalleryImage as $img) {
                          ?>                          
                          <a class="example-image-link col-grid" href="<?php echo site_url('images/temp/full/' . $img->name); ?>" data-lightbox="example-set" data-title="<?=$value->title?>"><img style="width: 100%;height: 254px;" class="example-image" src="<?php echo site_url('images/temp/full/' . $img->name); ?>" /></a>
                          <?php }
                             ?>
                    </div>
               </div>
            </section>
<?php
   }
   }
   ?>




<section class='section-wrapper about-page-w' style="background: #fff;">
   <div class='container'>

      <div class='row row-separated'>
         <div class='span12'>
            <div class='section-paragraph'><?php echo $details->desc; ?></div>
         </div>
      </div>
   </div>
</section>
<div style="clear: both"></div>
<?php $this->load->view('contact_view_page');?>
<?php $this->load->view('includes/footer_view');?>
<script src="<?php echo site_url('gallery/js/lightbox-plus-jquery.min.js'); ?>" type="text/javascript"></script>
