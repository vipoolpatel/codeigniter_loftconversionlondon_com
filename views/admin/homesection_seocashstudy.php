<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
       
        <style>
            .btn-remove {
                margin: 0 0 10px 5px;
            }
            .text-success{
                color: #3c763d;
                margin:10px 0;
            }
        </style>

    </head>

    <body>
        <?php 
			$points = ""; $t = "";
			if ($homesection)
			{
				$t = $homesection;
			}
        ?>
        <?php
			$this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4>Home Section (SEO Case Study)</h4>
            <div class="text-success">
                <?php echo $this->session->flashdata('success');?>
            </div>
            <div class="addNewContents"><br>
                <form method="post" name="frmEditContent" id="frmEditContent" action="" enctype="multipart/form-data">
                    <div class="span5">
                        <!-- <h5>Section 1</h5> -->
                        <div  class="addnewpagetitletxtbox margintop10">
                            <label>Title</label>
                            <input type="text" name="case_study_title" class="span5"  value="<?php if ($t != "") echo htmlspecialchars($t->case_study_title); ?>" style="width:100%" />
                        </div>
						
                        <div  class="addnewpagetitletxtbox margintop10">
                            <label>Button Name</label>
                            <input type="text" name="case_study_button_name" class="span5"  value="<?php if ($t != "") echo htmlspecialchars($t->case_study_button_name); ?>" style="width:100%" />
                        </div>
						
                        <div  class="addnewpagetitletxtbox margintop10">
                            <label>Description</label>
                            <textarea type="text" name="case_study_description" class="span5" id="home_description1" style="width:100%"><?php if ($t != "") echo $t->case_study_description; ?></textarea>
                            <?php echo $this->ckeditor->replace("home_description1"); ?>
                        </div>
						
                        <div  class="addnewpagetitletxtbox margintop10">
							<label>Image</label>
							<div id="show_image" class="show_images-investor" style="width:100px;height:100px;background: #EEE;position: relative;" >
								<img id="previewimage" src="<?php echo site_url('images/study/' . $t->case_study_image); ?>"  style="width:100px;height:100px;" alt="" class="img-centered"/>
							</div>
							<input type="file" name="case_study_image" id="uploadFile" value="" style="display: none;" /><br>
							<input type="button" name="image" onclick="$('#uploadFile').click();" id="picture" class="btn"  value="Upload Image" />
							<input type="hidden" name="old_case_study_image"   value="<?=!empty($t->case_study_image)?$t->case_study_image:'';?>" />
                        </div>
						
						
                    </div>
                   
                    <div class="clearfix"></div>
                    <hr>
                    <div style="float:left;">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary large"/>
                    </div>
                    <div class="clear"></div>
                </form>
                <?php
                if (isset($message)) {
                    ?>
                    <div class="<?php echo $message != '' ? 'messagesuccess' : '' ?>"><?php echo $message; ?></div>
                <?php }
                ?>
            </div>
        </div>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
		
		<script>
			function previewImage(input) {
				if (input.files && input.files[0]) {
							var reader = new FileReader();

							reader.onload = function (e) {
									$('#previewimage').attr('src', e.target.result);
							}
							reader.readAsDataURL(input.files[0]);
				}
			}
			$("#uploadFile").change(function(){
				previewImage(this);
			});
		</script>
    </body>
</html>