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

.search-input {
  padding: 10px !important;
}
.error p {
  color: red;
}

.alert-success {
  color: #3c763d;
  background-color: #dff0d8;
  border-color: #d6e9c6;
}

.alert {
  padding: 15px;
  padding-right: 15px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 4px;
  box-shadow: none;
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

<section style="background: #fff;" class="contact-page-w">
   <div class="container">

      <?php 
      if(!empty($this->session->flashdata('success')))
      { 
      ?>

          <div class="alert alert-success">
             <?=$this->session->flashdata('success')?>
          </div>

          
      <?php 
      }
      ?>

      
         
            <div class="white-card extra-padding" style="padding: 0px;">
               <form action="" class="form-transparent no-margin-bottom contact-form" id="form-add-comment" method="post" >
                  <fieldset>
                     <div class="row-fluid">
                        <div class="span12">
                            <div class="controls controls-row">
                              <input class="search-input span6 " name="first_name" required placeholder="Your first name" type="text" value="<?=set_value('first_name')?>">
                              <input class="search-input span6 " name="last_name" required placeholder="Your last name" type="text"  value="<?=set_value('last_name')?>">
                           </div>
                            
                           <div class="controls controls-row">
                               <input class="search-input span6" name="company" required placeholder="Your company" type="text" value="<?=set_value('company')?>"> 
                              <input class="search-input span6" name="email" required placeholder="Your email address" type="email" value="<?=set_value('email')?>">
                              
                           </div>
                            <div class="controls controls-row">
                              <input class="search-input span6" name="number" required placeholder="Your number" type="text" value="<?=set_value('number')?>">
                              <input class="search-input span6" name="address" required placeholder="Your address" type="text" value="<?=set_value('address')?>">
                           </div>
                           <div class="controls controls-row">
                              <textarea class="search-input span12" name="message" required placeholder="Your message" rows="6"><?=set_value('message')?></textarea>
                              <div style="color:red;"><?php echo form_error('message') ?></div>
                           </div>
                            <div class="controls controls-row">
                              <label>Verification Code*</label>
                              <div class="captcha-image" style="margin-bottom: 10px;">

                              <?php
                                $firstNumber_acc = mt_rand(0, 9);
                                $SecondNumber_acc = mt_rand(0, 9);
                              ?>
                              <?=$firstNumber_acc?> + <?=$SecondNumber_acc?> = ?
                              </div>
                              <input type="hidden"  name="currentcaptcha"  value="<?=$firstNumber_acc + $SecondNumber_acc?>">
                              <input type="text" class="search-input span6 required" name="captcha"  id="captcha" placeholder="Verification Code" autocomplete="off">
                              <div class="clear"></div>
                              <div class="error"><?php echo form_error('captcha') ?></div>
                              
                           </div>
                           <div class="form-actions">
                              <br />
                              <input class="btn btn-small" name="submit" type="submit" value="Submit Message">
                           </div>
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
        
     
 
   </div>
</section>








<div style="clear: both"></div>

<?php $this->load->view('includes/footer_view');?>
<script src="<?php echo site_url('gallery/js/lightbox-plus-jquery.min.js'); ?>" type="text/javascript"></script>
