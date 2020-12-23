<?php $this->load->view('includes/header_view'); ?> 
<style>
.captcha-error p{
    color: red;
}
</style>
<section class='section-wrapper contact-page-w'>
    <div class='container'>
        <h3 class='section-header'>Contact Us</h3>
        <div class="row">
            <div class="span12 section-paragraph"><p>Thank you for taking the time to visit our website. If you would like any further information with regards to our services, please don't hesitate to contact us. Please fill the form and we will endeavour to get back to you as soon as possible.</p></div>
        </div>
        <div class='row row-separated margintop10'>
            <div class='span4'>
                <div class='blog-side-text-block widget-filled widget-yellow'>
                    <h3>Contact Information</h3>
                    <ul class="unstyled big-iconed-tips">
                        <!-- <li>
                            <i class='icon-map-marker'></i>
                            Space House Business Centre Suite 1, Park Royal, Space Business Park, Abbey Rd, Middlesex, London, NW10 7SU
                        </li> -->
                        <li>
                            <i class='icon-phone-sign'></i>
                            0843 837 2065
                        </li> 
                        <li>
                            <i class='icon-phone-sign'></i>
                            WhatsApp 07727 149067
                        </li> 
                        <li>
                            <i class='icon-envelope-alt'></i>
                            info@loftconversionlondon.com
                        </li>
                        <li>
                            <i class='icon-globe'></i>
                            www.loftconversionlondon.com
                        </li>
                       
                    </ul>

                </div>
            </div>
            <div class='span8'>
                <div class="white-card extra-padding" style="padding-bottom: 45px;">
                    <?php
                    $message = $this->session->flashdata('status');
                    if ($message != "" && $message == 'success') {
                        ?>
                        <div class='span12'>
                            Your message was sent successfully! Thank you for contacting Loft Conversion!
                        </div>
                    <?php } else {
                        ?>
                        
 <form class='form-transparent no-margin-bottom contact-form' id='form-add-comment'  method="post" action="">
<fieldset>
    <div class='row-fluid'>
        <div class='span12'>
            <legend>Complete the form to contact us</legend>
            <?php if ($message != "" && $message == 'failed') { ?>
                Your message could not be sent. Please Try Again!
            <?php } ?>
            <div class='controls controls-row'>
                <input class='search-input span6' name="first_name" placeholder='Your first name' type='text' value="<?php echo set_value('first_name','');?>">
                <input class='search-input span6' name="last_name" placeholder='Your last name' type='text' value="<?php echo set_value('last_name','');?>">
            </div>
            <div class='controls controls-row'>
                <input class='search-input span6' name="company" placeholder='Your company' type='text' value="<?php echo set_value('company','');?>">
                <input class='search-input span6' name="email" placeholder='Your email address' type='text' value="<?php echo set_value('email','');?>">
            </div>
            <div class='controls controls-row'>
                <input class='search-input span6' name="number" placeholder='Your number' type='text' value="<?php echo set_value('number','');?>">
                <input class='search-input span6' name="address" placeholder='Your address' type='text' value="<?php echo set_value('address','');?>">
            </div>
            
            <div class='controls controls-row'>
                <textarea class='span12' name="message" placeholder='Your message' rows='6'><?php echo set_value('message','');?></textarea>
            </div>
            <div class="clear"></div>
                <div class="controls controls-row">
                    <label>Verification Code*</label>
                    <?php
                        $fir_re = mt_rand(0,9);
                        $sec_re = mt_rand(0,9);
                    ?>
                    <label style="width: 100%;text-align: left;"><?=$fir_re?> + <?=$sec_re?> = ?</label>
                    <input type="hidden" value="<?=$fir_re + $sec_re?>" name="current_captcha">
                    <input type="text" class='search-input span6' id="captcha" name="captcha" required>
                </div>   
            <div class="clear"></div>
            
                <div class="error captcha-error"><?php echo form_error('current_captcha'); ?></div>
            


            <div class='form-actions'>
                <input class='btn btn-small' name="submit" type="submit" value="Submit Message" />
            </div>
        </div>
    </div>


    

</fieldset>
</form>
<?php } ?>
        </div>
    </div>
</div>
        <div class='row'>
            <div class='span12'>
                
                <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2481.9747575715533!2d-0.2767606845480826!3d51.532022816724115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x518e30f1fd0c13cc!2sLowcostseo!5e0!3m2!1sen!2snp!4v1464082015433" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
                
                
                <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=+&amp;q=2+Woodberry+Grove,+Finchley,+London+,+N12+0DR&amp;ie=UTF8&amp;hq=&amp;hnear=2+Woodberry+Grove,+London+N12+0DR,+United+Kingdom&amp;t=m&amp;z=14&amp;ll=51.610873,-0.17808&amp;output=embed"></iframe>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $('#form-add-comment').validate({
         rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true,
                email:true
            },
            message:{
                required:true,
            },
            captcha:{
                required:true,
            }
          
        },
        messages: {
            first_name: {
                required: "First Name is required."
            },
            last_name: {
                required: "Last Name is required."
            },
            email: {
                required: "Email is required."
            },
            message: {
                required: "Please enter your message."
            },
            captcha: {
                required: "Please enter captcha to verify that you are human!"
            },
            
        },
        errorPlacement:function(error,element){
            var name = $(element).attr('name');
            var options = {};
            if(name=='captcha'){
                options = { placement:'right'};
            }
            $(element).attr('data-original-title',$(error).text());
            $(element).tooltip(options);
        },
        success: function (label, element) {
            $(element).attr('data-original-title','');
            $(element).tooltip();
        },
        highlight: function(element) {
            $(element).addClass('msg-danger');
        },
        unhighlight: function(element) {
            $(element).removeClass('msg-danger');
        },
    });
    $('#captcha').on('keyup',function(){
        $('.captcha-error').hide(500,function(){
            $(this).remove();
        });
    });
    });

</script>
<?php $this->load->view('includes/footer_view'); ?>