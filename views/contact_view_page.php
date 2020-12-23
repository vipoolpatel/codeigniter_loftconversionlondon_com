<section class='section-wrapper' style="padding-bottom: 34px;">
    <div class='container'>
        <div class='row home_page_content '>
			 
			
			<form action="<?php echo base_url('home/send_project');?>" class="form-transparent no-margin-bottom contact-form" id="contact-project-form" method="post">
				<div class="span12" style="text-align: center;margin-bottom: 20px;">
					<h3 class="section-header">Tell us about your Loft Conversion Requirements</h3>
					
				</div>
				  <?php
                    $message = $this->session->flashdata('status');
                    if ($message != "" && $message == 'success') {?>
                        <div class='controls status-msg'>
                            <h3>ALL DONE.
                                <span>WHAT HAPPENS NEXT?</span>
                            </h3> 
                            <p>
                                Our customer service team will examine your query and get back to you as soon as possible. 
                                <strong>Thank you
                                <br />Loft Conversion London 
                                </strong>
                             </p>
                        </div>
                    <?php }else {?>
			<div class='span6' style="text-align: right;">
				<div class="controls ">
                                    <input type="text" class="" style="height: 40px !important;padding: 0 15px;margin-bottom: 5px;width: 65.3%;" placeholder="Full Name" name="full_name" required >
				</div>
			</div>
			<div class='span6 '>
				<div class="controls ">
					<input type="text" class="" style="height: 40px !important;padding: 0 15px;margin-bottom: 5px;width: 65.3%;" placeholder="Email Address"  name="email" required>
				</div>
			</div>
				<div style="clear: both"></div>
			<div class='span6 ' style="text-align: right;">
				<div class="controls ">
					  <input type="text" class="" style="height: 40px !important;padding: 0 15px;margin-bottom: 5px;width: 65.3%;" placeholder="Telephone No."  name="telephone" required>
				</div>
			</div>
			<div class='span6 ' >
				<div class="controls ">
					  <input type="text" class="" style="height: 40px !important;padding: 0 15px;margin-bottom: 5px;width: 65.3%;" placeholder="Your address" name="address" required>
				</div>
			</div>
				<div style="clear: both"></div>
			<div class='span6 ' style="text-align: right;">
				<div class="controls ">
					  <input type="text"  style="height: 40px !important;padding: 0 15px;margin-bottom: 5px;width: 65.3%;" placeholder="Message" name="message" required>
				</div>
			</div>
			<div class='span6 '>
				
					<div class="controls">
                         <select required  name="your_property_type" style="height: 40px !important;padding: 0 15px;margin-bottom: 5px;width: 71%;">
                                    <option value="">Property Type </option>
                                    <option value="Bungalow">Bungalow</option>
                                    <option value="Cottage">Cottage</option>
                                    <option value="Detached">Detached</option>
                                    <option value="Flat">Flat</option>
                                    <option value="Semi-detached">Semi-detached</option>
                                    <option value="Terrace">Terrace</option>
                                    <option value="Other">Other</option>
                                </select>
                        </div>
				
			</div>
			
			
			 <div style="clear: both"></div>
                            <div class='span12' style="text-align: center;margin-top: 13px;" >
                                <div class="controls">
                                       Verification Code *
                                </div>
                            </div>
                        
                            <div style="clear: both"></div>
                            <div class='span12' style="text-align: center;margin-top: 13px;" >
                                <div class="controls">
                                       <?php
                                       $firstNumber = mt_rand(0,9);
                                       $SecondNumber = mt_rand(0,9);
                                       ?>
                                    <?=$firstNumber?> + <?=$SecondNumber?>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                            <div class='span12' style="text-align: center;margin-top: 13px;" >
                                    <div class="controls">
                                        <input type="text" required="" id="captcha" autocomplete="off" name="captcha" style="height: 40px !important;padding: 0 15px;margin-bottom: 5px;"  value="">
                                        <input type="hidden"  name="current_captcha"  value="<?=$firstNumber + $SecondNumber?>">
                                    </div>
                            </div>
                        
                            <div style="clear: both"></div>
                            <div class='span12' style="text-align: center;margin-top: 13px;color: red;" >
                                <div class="controls">
                                    <?php
                                    if(!empty($this->session->flashdata('captcha_message')))
                                    {
                                    ?>
                                       <?=$this->session->flashdata('captcha_message');?>
                                    <?php }
                                    ?>
                                </div>
                            </div>
			
			<div style="clear: both"></div>
				<div class='span12' style="text-align: center;margin-top: 13px;" >
					<div class="controls">
						<input type="submit" class="btn btn-success btn-large" name="submit" value="Send">
					</div>
				</div>
			<?php }?>
			  </form>
					
		</div>
	</div>
</section>


<script>
    $(document).ready(function() {
        $('.complete-form-btn').click(function(){
            console.log('here');
            $('html,body').animate({
                scrollTop:($('#contact-project-form').offset().top - 100)
            },800);
        });
    });</script>