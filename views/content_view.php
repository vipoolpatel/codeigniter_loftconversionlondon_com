<?php
//Location: app/views/faqs_view.php

$this->load->view('includes/header_view');
?>
<link href="<?php echo site_url('css/owl.carousel.min.css'); ?>" rel="stylesheet">
<link href="<?php echo site_url('css/custom.css'); ?>" rel="stylesheet">
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

    .testimonial_study {
        display: grid;
        grid-template-columns: 32.66% 32.66% 32.66%;
        grid-gap: 1%;
    }

    .testimonial-link  {
        display: block;
        font-size: 20px;
        margin-bottom: 10px;
        cursor: pointer;
        text-decoration: none;
        color: #78A7A6;
    }

    .testimonial_study div {
        border: 1px solid #f1f1f1;
        border-radius: 7px;
    }

    .testimonial_study img {
        border-radius: 5px 5px 0px 0px;
        width: 100%;
        height: 253px;
    }
    .testimonial-button {
        background: #78A7A6;
        color: #fff;
        padding: 5px 15px;
        border-radius: 4px;
    }

    .testimonial-button:hover {
        color: #fff;
    }

    .content-type {
        display: grid;
        grid-gap: 3%;
        grid-template-columns: 31.33% 31.33% 31.33%;
        text-align: center;
    }

    .content-type img {
        display: block;
        width: 100%;
        height: 350px;
    }

    .content-type h2 {
        font-size: 20px;
        color: #02337a;
        margin-bottom: 0px;
    }

@media (max-width:767px) {
    .testimonial_study {
         grid-template-columns: 100%;
         margin-bottom: 100px;
    }
    .content-type {
        grid-template-columns: 100%;
        grid-gap: 0%;
        margin: 0px 20px;
    }
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
                <h1 class="slider-header" style="border-bottom: 2px solid #fff;"><?php echo $details->title; ?></h1>
                <h2 class="slider-sub-header" style="color: #fff;"><?php echo $details->sub_title; ?></h2>
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


<section class='section-wrapper about-page-w' style="background: #fff;">
    <div class='container'>

        <div class='row row-separated'>
            <div class='span12'>
                <div class='section-paragraph'><?php echo $details->desc; ?></div>
            </div>

        </div>

    </div>
</section>


<?php
if(!empty($getContentType))
{
?>

<section class='section-wrapper about-page-w' style="background: #fff;padding-bottom: 20px;">
    <div class='container'>
            <div class="content-type">
                <?php
                foreach ($getContentType as $value_type) {
                ?>
                    <div>
                        <?php
                        if(!empty($value_type->image_name))
                        { ?>
                            <img alt="<?=$value_type->title?>" title="<?=$value_type->title?>" src="<?=base_url()?>images/type/<?=$value_type->image_name?>">    
                        <?php }
                        else
                        { ?>
                            <img alt="<?=$value_type->title?>" title="<?=$value_type->title?>" src="<?=base_url()?>images/type/<?=$value_type->default_image?>">
                       <?php }
                        ?>
                        <h2><?=$value_type->title?></h2>
                        <p><?=$value_type->description?></p>
                    </div>
                <?php
                }
                ?>
                   
            </div>

    </div>
</section>

<?php }
?>



<?php
if(!empty($getContentQuestion))
{
?>

<section class="section-wrapper feature">
 
<?php
    $i = 1;
?>
<?php
foreach ($getContentQuestion as $value) {

    if(!empty($value->is_full_screen))
    {
        ?>

            <div class="block">
              <div class="container">
                 <div class="row">
                    <div class="span12 content">
                       <h3 class="section-header"><?php echo $value->title; ?></h3>
                       <span class="align-justify section-paragraph">
                          <p>
                             <span style="font-size:22px;"><?php echo $value->description; ?></span>
                          </p>


               <?php
                if(!empty($value->image_name)){
                ?>
               <img src="<?=base_url()?>upload/question/<?=$value->image_name?>" style="border-radius: 10px;">

                <?php
                 }
                ?>
                       </span>
                    </div>
                 </div>
              </div>
           </div>

        <?php
    }
    else
    {
        ?>

    <div class="block">
      <div class="container">
         <div class="row">
            <div class="span8 content <?php echo $i % 2 == 0 ? "pull-right" : "pull-left"; ?>">
               <h3 class="section-header"><?php echo $value->title; ?></h3>
               <span class="align-justify section-paragraph">
                  <p>
                     <span style="font-size:22px;"><?php echo $value->description; ?></span>
                  </p>
               </span>
            </div>
            <div class="span4 image <?php echo $i % 2 == 0 ? "pull-right" : "pull-left"; ?>">
               <?php
                if(!empty($value->image_name)){
                ?>
               <img src="<?=base_url()?>upload/question/<?=$value->image_name?>" style="border-radius: 10px;">

                <?php
                 }
                ?>

            </div>
         </div>
      </div>
   </div>

        <?php
         $i++;
    }
?>
  
      <?php
        
        }
      ?>

   
  
</section>

<?php
}
?>
















<?php
if(!empty($details->google_map_url))
{
?>

<section class='section-wrapper about-page-w' style="background: #fff;">
    <div class='container'>

        <div class='row row-separated'>
            <div class='span12'>
                <div class='section-paragraph'>
                    <iframe src="<?php echo $details->google_map_url; ?>" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
                    <br/>
            </div>

        </div>

    </div>
</section>

<?php
}
?>


<?php
if(!empty($getTestimonialStudy)) {
?>

<section style="background: #fff;padding: 10px;display: grid;">
    <div class='container'>
        <div class="testimonial_study">
            <?php
            foreach ($getTestimonialStudy as $study) {
            ?>

            <div>
                <img src="<?=base_url()?>upload/testimonial/<?=$study->image_name?>" alt="">
                <div style="padding: 10px 10px 15px 10px;">
                    <a href="<?=base_url()?><?=$study->page_seo?>" class="testimonial-link"><?=$study->title?></a>   
                    <p><?=$study->description?></p> 
                    <a class="testimonial-button" href="<?=base_url()?><?=$study->page_seo?>">Read More</a>
                </div>
            </div>   

                <?php
            }
            ?>
           
        </div>
    </div>
</section>

<?php
}
?>



<?php
if (!empty($getImageGallery)) {
    ?>

<section class='section-wrapper about-page-w' style="background: #fff;padding-bottom: 30px;">
    <div class="container">
        <div  class="owl-carousel owl-theme gallery-slider">
            <?php
foreach ($getImageGallery as $value) {
        ?>
            <div class="item"><img class="owl-lazy" data-src="<?php echo site_url('images/temp/full/' . $value->name); ?>" alt="<?=$value->title?>"></div>
            <?php }
    ?>
        </div>
    </div>
</section>
<?php
}
?>

<div style="clear: both">
</div>
<?php $this->load->view('home_city');?>
<?php $this->load->view('contact_view_page');?>
<?php $this->load->view('includes/footer_view');?>
<script src="<?php echo site_url('js/owl.carousel.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">

    $(".gallery-slider").owlCarousel({
        autoplay: true,
        loop: true,
        margin: 10,
        nav: false,
        lazyLoad: true,
        responsive: {
            0: {
                items: 1
            },
            420: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    });

</script>