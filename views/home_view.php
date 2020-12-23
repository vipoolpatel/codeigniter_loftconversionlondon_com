<?php $this->load->view('includes/header_view'); ?>
<link href="<?php echo site_url('css/owl.theme.default.min.css'); ?>" rel="stylesheet">  
<link href="<?php echo site_url('css/custom.css'); ?>" rel="stylesheet">
<link href="<?php echo site_url('css/owl.carousel.min.css'); ?>" rel="stylesheet">

<style type="text/css">
    .subfooter-column {
        padding-left: 15px;padding-right: 15px;
    }

    .subfooter-column h2 {
        font-size: 21px;
        color: #fff;
        margin-top: 27px;
    }

   .subfooter-column a {
        color: #fff;
        line-height: normal;
        font-size: 14px;
    }

    .subfooter-column p {
        margin-top: 5px;
    }
    .footer-img {
        width: 50px;
        height: 50px;
    }
</style>


<div class='carousel slide over-something' id='homepage-carousel' style="background: none;padding-top: 0px;">
    <div class='carousel-inner slider-w' style="padding-top: 60px;background-size: inherit;">
        <div class='active item'>
            <div class='container'>

                <h1 class='slider-header changeheaderclass' style="float: none;text-align: center;max-width: 100%;border-bottom: 2px solid #5c8a87;">
                    <?php echo $home_section ? $home_section->main_title : ""; ?>
                </h1>

                <?php if ($home_section && $home_section->main_sub_title) { ?>
                    <h2 class='slider-sub-header' style="float: none;text-align: center;max-width: 100%;margin-top: 44px;">
                        <?php echo $home_section->main_sub_title; ?></h2>
                <?php } ?>

                <div style="clear: both;"></div>				
                <a href="<?php echo base_url('contact-us'); ?>" class="contactheader btn btn-warning text-center"><?php echo $home_section && $home_section->main_caption ? $home_section->main_caption : 'Request a Quote'; ?></a>
            </div>
        </div>
    </div>
    <div class="banner-text">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h2><?= !empty($home_section->middle_title) ? $home_section->middle_title : "low cost internet marketing solutions</strong>"; ?></h2>
                    <p>
                        <?= !empty($home_section->middle_sub_title) ? $home_section->middle_sub_title : 'We guarantee that your marketing campaign will experience a positive ROI from using our SEO Services. With our expert optimization,we will ensure no penny is wasted. Most of our clients see a 35% to 45% increase in ROI over a 12 month period.' ?>
                    </p>
                    <a href="<?php echo base_url('contact-us'); ?>" class="btn btn-warning text-center"><?= !empty($home_section->middle_caption) ? $home_section->middle_caption : 'Request a Quote' ?></a>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /banner-text -->
    <?php if ($services->num_rows() > 0) {
        $all_services = $services->result();
        ?>
        <div class='sub-slider-features'>
            <div class='container'>
                <div class='row'>
                    <div class="span12">
                        <h2 style="margin-bottom: 10px;">Why Choose Loft Conversion London? </h2>
                    </div>
                    <div class="span12">
                        <p style="font-size: 25px;line-height: 1.5;text-align: center;padding: 28px 10px;color: #999;max-width: 850px;margin: 0 auto;">
                            We are the loft conversion specialists around the London area and No1 ranked Loft conversion company in Google. We are by your side throughout the process, from getting planning permission to the final installation phase.
                        </p>
                    </div>
                    <?php $i = 0;
                    foreach ($all_services as $key => $service) {
                        ?>

                        <div class='span4'>
                            <div class='info-bullet'> <!-- <i class='icon-bar-chart'></i> -->
                                <div class="info-img">
                                    <?php if ($service->image && file_exists(BASEPATH . '../images/frontend/main/' . $service->image)) { ?>
                                        <img src="<?php echo site_url('/images/frontend/main/' . $service->image); ?>">
        <?php } else { ?>
        <?php } ?>
                                </div>
                                <h5><?php echo $service->title; ?></h5>
                                <p><?php echo $service->description; ?></p>
                            </div>
                        </div>
                        <?php
                        if($i == 2)
                        { ?>
                         <div style="clear:both"></div>
                    <?php }
                        ?>
        <?php $i++;
    }
    ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
<?php } ?>


    <section class="section-wrapper desc home-desc">
        <div class="container ">
            <div class="row">
                <div class="span7 best-desc">
<?= $home_content->desc ?>
                </div>
                <div class="span5 best-desc">
                    <div class="com-md-12" style="padding: 0px 22px 22px;background-color: rgba(229, 131, 37, 0.65);opacity: 1;border-radius: 5px;" >

                        <div class="com-md-12"><h2 style="color: #fff;padding-top: 30px;">FREE SITE SURVEY</h2></div>
                        <div class="com-md-12">
                            <p style="color: #fff;"> For a free site survey please fill out the form below and we’ll get back to you as soon as we can. </p>
                        </div>
                        <br />
                        <div class="com-md-12" style="background: #ffffff;padding: 20px;border-radius: 5px;">
                            <form action="" method="post" id="SendContactInfo">  
                                <div class="com-md-12">
                                    <label style="text-align: left;">Name <span class="required">*</span></label>
                                    <input style="width: 96%;" type="text" placeholder="Name" required="" name="name" class="form-control clearform">
                                </div>
                                <br />
                                <div class="com-md-12">
                                    <label style="text-align: left;"> Address <span class="required">*</span></label>
                                    <input style="width: 96%;" type="text" placeholder="Address" required="" name="address" class="form-control clearform">
                                </div>
                                <br />
                                <div class="com-md-12">
                                    <label style="text-align: left;">Email <span class="required">*</span></label>
                                    <input style="width: 96%;" type="email" placeholder="Email" required="" name="email" class="form-control clearform">
                                </div>
                                <br />
                                <div class="com-md-12">
                                    <label style="text-align: left;">Telephone  <span class="required">*</span></label>
                                    <input style="width: 96%;" type="text" placeholder="Telephone" required="" name="telephone" class="form-control clearform">
                                </div>
                                <br />
                                <div class="com-md-12">
                                    <label style="text-align: left;">Enquiry Details </label>
                                    <input style="width: 96%;" type="text" placeholder="Enquiry Details" name="enquiry_details" class="form-control clearform">
                                </div>
                                <br />


                                <div class="com-md-12">
                                    <label style="text-align: left;">Property Type </label>
                                    <select  style="width: 100%;" name="your_property_type" class="form-control clearform">
                                        <option value="">Select</option>
                                        <option value="Bungalow">Bungalow</option>
                                        <option value="Cottage">Cottage</option>
                                        <option value="Detached">Detached</option>
                                        <option value="Flat">Flat</option>
                                        <option value="Semi-detached">Semi-detached</option>
                                        <option value="Terrace">Terrace</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <br />
                                <div class="com-md-12">
                                    <label style="text-align: left;"> How should we contact you? <span class="required">*</span></label>
                                    <label style="text-align: left;">
                                        <input type="radio" required="" value="Call me" name="contact_type" style="margin-top: -3px;"> Call me
                                        <input type="radio" required="" value="Email me" name="contact_type" style="margin-top: -3px;margin-left: 12px;"> Email me
                                    </label>
                                </div>
                                <br />
                                <div class="com-md-12">
                                    <label style="text-align: left;">Please use this box to provide any further information you feel may be helpful to your consultation  <span class="required">*</span></label>
                                    <textarea class="form-control clearform" name="message"  required="" style="width: 96%"></textarea>
                                </div>
                                <br />
                                <div class="com-md-12" style="text-align: left;">
                                    <input id="saveForm" class="btn btn-primary" type="submit" value="Submit" >
                                </div>
                            </form>
                        </div>
                    </div>
                    <div style="clear: both;"></div>

                </div>
            </div>
        </div>
    </section>
    

    
<?php
if(!empty($home_gallery)){
?>    
<section class="section-wrapper" >
   <div class="container "> 
         <div class="portfolio">
            <div class="container">
               <h3 class="section-header" style="text-align: center;margin-bottom: 40px;">Take a look at our recent work</h3>
                
               <div class="span12">
                   <?php
                   foreach ($home_gallery as $value_gallery) {
                   ?>
                  <div class="column column-fit span4">
                     <div class="portfolio-item dark ">
                         <a class="portfolio-item-link" href="<?=base_url()?><?=$value_gallery->page_seo?>"></a>
                        <div class="portfolio-item-overlay primary-color-bg"></div>
                        <h3 class="portfolio-item-title">
                           <?=$value_gallery->title?>
                        </h3>
                        <img src="<?php echo site_url('images/temp/full/' . $value_gallery->image_name); ?>" style="width: 100%;" alt="  <?=$value_gallery->title?>" title="<?=$value_gallery->title?>" >
                     </div>
                  </div>
                <?php }
                ?>
               </div>
            </div>
         </div>
   </div>
</section>
<?php 
}
?>

    


    <style>
        .content-page .recent ul li a {font-size: 16px;font-family: "Abel","Helvetica Neue",Helvetica,Arial,sans-serif;padding: 10px 0;display: block;border-bottom: 1px dashed #999;}
    </style>
    <section class="section-wrapper desc home-desc content-page" style="padding-top: 40px;margin-top: 0px;">
        <div class="container ">
            <div class="span9" style="margin: 0px;">
                <div class="best-desc">
<?= $home_content->desc_more ?>
                </div>
            </div>
            <div class="span3 spanipad3" style="margin: 0px;">
                <div class="recent">
                    <h3 class="section-header">Loft Conversion</h3>
                    <ul style="list-style: none;margin: 0pc;padding-left: 10px;">
                        <?php
                        foreach ($home_sidebar as $value_sidebar) {
                            ?>
                            <li><a style="color: #78A7A6;" target="_blank" href="<?= $value_sidebar->url ?>"><?= $value_sidebar->title ?></a></li>
<?php }
?>
                    </ul>
                </div>
            </div>
        </div>
    </section>



 <?php
 if(!empty($loft_conversions_type->num_rows() > 0)){
 ?>
<section class="section-wrapper about-page-w" >
   <div class="section-paragraph">
      <div class="container">
         <h3 class="section-header" style="text-align: center;">
            Types of loft conversions
         </h3>
         <div class="blocks services">
            <div class="row block-columns">
               <div class="row block-columns">
                   <?php
                    foreach ($loft_conversions_type->result() as $value_type) {
                   ?>
                  <div class="span3">
                     <a class="content" >
                        <h4><?=$value_type->title?></h4>
                        <p ><?=$value_type->description?></p>
                        <?php
                        if(!empty($value_type->image))
                        {
                        ?>
                        <img src="<?php echo site_url('/images/frontend/main/' . $value_type->image); ?>">
                        <?php }
                        ?>
                     </a>
                  </div>
                    <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
 <?php }
 ?>

    <section class="section-wrapper feature">
        <?php if ($features) {
            $i = 1; ?>
    <?php foreach ($features as $feature) { ?>
                <div class="block">
                    <div class="container">
                        <div class="row">
                            <div class="span8 content <?php echo $i % 2 == 0 ? "pull-right" : "pull-left"; ?>">
                                <h3 class="section-header"><?php echo $feature->title; ?></h3>
                                <span class="align-justify section-paragraph"><?php echo $feature->description; ?></span>
                            </div>
                            <div class="span4 image <?php echo $i % 2 == 0 ? "pull-left" : "pull-right"; ?>">
                                <?php
                                if ($feature->image && file_exists(BASEPATH . '../images/frontend/main/' . $feature->image)) {
                                    ?>
                                    <img src="<?php echo site_url('/images/frontend/main/' . $feature->image); ?>" alt="<?php echo $feature->title; ?>">
        <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
<?php } ?>
    </section>

<?php $this->load->view('home_city'); ?>

<?php if (!empty($testimonials)) { ?>   
<section class='section-wrapper about-page-w' style="background: #fff;padding-bottom: 50px;">
    <div class="container">
        <h3 class="section-header" style="text-align: center;">Testimonials</h3>
        <div  class="owl-carousel owl-theme gallery-slider">
            <?php
            foreach ($testimonials as $test) {
            ?>
            <div class="item" style="text-align: center;">
                <p><?php echo $test->description; ?> </p>
                <p style="margin-top: 20px;"><?php echo $test->name . ", " . $test->company; ?></p>
            </div>
            <?php }
            ?>
        </div>
    </div>
</section>  
<?php }
?>      
<?php $this->load->view('contact_view_page'); ?>
    <section class="contact-wrapper">
        <div class="container">
            <div class="row">
                <div class="span4">
                    <div class="content">
                        <h2 style="margin-top: 0px;"><?php echo $home_section ? $home_section->bottom_title : "Low cost SEO solutions to help your site rank higher on Google ..."; ?></h2>
                            <?php if ($home_section && !empty($home_section->points)) { ?>
                            <ul>
                                <?php foreach ($home_section->points as $pt) { ?>
                                    <li><?php echo $pt; ?></li>
                            <?php } ?>
                            </ul>
                            <?php } ?>
                        <button class="btn complete-form-btn" type="button"><?php echo $home_section ? $home_section->bottom_button_caption : "Complete the form ... "; ?> </button>
                    </div>
                </div>



               <div class="span4">
                    <div class="subfooter-column">
                        <h2>Loft Conversion Construction Group</h2>
                         <?php
                            foreach ($footer_logo as $footer_logo_value) {
                        ?>
                        <img class="footer-img" src="<?=base_url()?>images/<?=$footer_logo_value->logo?>">
                        <?php
                        }
                        ?>
                      
                        <p>
                            <?php
                            foreach ($footer_logo as $footer_logo_value_name) {
                            ?>
                              <a href="<?=$footer_logo_value_name->url?>" target="_blank"><u><?=$footer_logo_value_name->name?></u></a>,
                            <?php
                                }
                            ?>

                          
                        </p>
                        <img src="<?=base_url()?>images/footer-warranty.png">
                    </div>
                </div> 

                 <div class="span4">
                    <div class="subfooter-column">
                        <h2>Why you can trust us</h2>
                        <img src="<?=base_url()?>images/footer-logos-2020.png">
                        <img src="<?=base_url()?>images/nappy_valley_logo.png">
                    </div>
                </div> 



            </div>
        </div>
    </section>
    
<?php $this->load->view('includes/footer_view'); ?>
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
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });   


        $('#SendContactInfo').submit(function (e) {
            e.preventDefault();
            var formData = new FormData();
            var contact = $(this).serializeArray();
            $.each(contact, function (key, input) {
                formData.append(input.name, input.value);
            });

            $.ajax({
                type: 'POST',
                url: "<?= base_url(); ?>home/SendEmailContact",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success: function (data) {
                    if (data.success)
                    {
                        $('.clearform').val('');
                        alert('Your information successfully sent!');
                    } else
                    {
                        alert('Due to some error please try again!');
                    }

                }
            });
        });
    </script>