<?php if (!isset($details)) $details = ""; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo base_url('js/ajaxupload.3.6.js'); ?>"></script>

    </head>

    <body>

        <?php $this->load->view("admin/boxes/admin_header_view"); ?>

        <div class="row-fluid white-card extra-padding mt20">

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#frmEditContent').validate();
                    $('#frmEditContent').submit(function() {
                        var editorcontent = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '');

                        if (!editorcontent.length)
                        {
                            $('#display_error').html('<div class="error">CONTENT IS REQUIRED.</div>');
                            return false;
                        }
                        else
                        {
                            $('#display_error').html('');
                        }
                        return true;
                    });
                });
            </script>

            <div class="addNewContents">

                <h4>ADD/EDIT TESTIMONIALS</h4>
                <form method="post" name="frmEditContent" id="frmEditContent" action="" class="form-horizontal mt20">

                    <div class=" control-group">
                        <label class="control-label">NAME &amp; SURNAME *</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" class="required" value="<?php echo is_array($details) ? $details['name'] : '' ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">COMPANY *</label>
                        <div class="controls">
                            <input type="text" name="company" id="company" class="required"  value="<?php echo is_array($details) ? $details['company'] : '' ?>" />			</div>
                    </div>


                    <div class="control-group">
                        <label class="control-label">POSITION *</label>
                        <div class="controls">
                            <input type="text" name="position" id="position" class="required" value="<?php echo is_array($details) ? $details['position'] : '' ?>" />
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label">IMAGE</label>
                        <div class="image controls">
                            <div id="photo_preview">
                                <?php
                                if (is_array($details)) {
                                    $image = trim($details['image']);
                                    if (file_exists(BASEPATH . "../images/frontend/thumb/" . $image)) {
                                        ?>
                                        <img src="<?php echo site_url('images/frontend/thumb/' . $details['image']); ?>" />
                                    <?php } else { ?>
                                        <img src="<?php echo site_url('images/no_image.jpg'); ?>" />
                                    <?php
                                    }
                                } else {
                                    ?><img src="<?php echo site_url('images/no_image.jpg'); ?>" /><?php } ?>
                            </div>
                            <button id="upload_image" type="button" >Select Image</button><span id="msg"></span>
                            <input type="hidden" name="photo" id="photo" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">DESCRIPTION</label>
                        <div class="controls">
                            <textarea name="description" id="description"><?php echo is_array($details) ? $details['description'] : ''; ?></textarea>
<?php echo $this->ckeditor->replace("description"); ?>
                        </div>
                    </div>

                    <div id="display_error"></div>  

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <?php
                            if (is_array($details)) {
                                ?>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" onclick="$('#div_del').show()" class="btn btn-danger tuc">Delete</a>

                                    <?php
                                }
                                ?>         

                                <input type="submit" name="submit" value="Submit" class="btn btn-primary tuc"/>

                            </div>
                        </div>
                    </div>


                    <div id="div_del" style="display: none;" class="del-div alert alert-error"><p style="float:left; margin:0 10px 0 0;"> WARNING: This can not be undone. Are you sure you want to delete? </p>
                        <div class="btn-group">
                            <a href="javascript:void(0)" onclick="$('#div_del').hide()" class="btn btn-primary tuc btn-small" id="btnCancel">Cancel</a>
                            <a href="<?php echo site_url('admin/testimonial/delete/' . $this->uri->segment(4)) ?>" class="btn btn-danger tuc btn-small">Delete</a> 
                        </div>
                    </div>

                </form>
                <?php
                $message = $this->session->flashdata('message');
                if (isset($message)) {
                    ?>
                    <div class="<?php echo $message != '' ? 'messagesuccess' : '' ?>"><?php echo $message; ?></div>
                <?php }
                ?>
                <div class="clear"></div>
            </div>

        </div>

        <script type="text/javascript">

                $(document).ready(function() {

                    var button = $("#upload_image"), interval;
                    console.log(button);

                    var mestatus = $('#msg');
                    var files = $('#files');
                    new AjaxUpload(button, {
                        action: '<?php echo site_url('admin/testimonial/upload_image'); ?>',
                        name: 'image',
                        onSubmit: function(file, ext) {
                            if (!(ext && /^(jpg|jpeg|png|gif)$/.test(ext))) {
                                // extension is not allowed 
                                mestatus.text('Only Jpeg, png or gif files are allowed');
                                return false;
                            }
                            mestatus.html('<img src="<?php echo site_url('images/ajax-loader.gif') ?>">');
                            button.text("Uploading...");
                            this.disable();
                        },
                        onComplete: function(file, response) {
                            //alert(response);
                            //On completion clear the status
                            mestatus.html('');

                            //Add uploaded file to list
                            var response = eval("(" + response + ")");

                            var status = response.status;
                            status = String(status);
                            status = status.trim();
                            if (status == "success") {
                                $('#photo').val(response.filename);
                                $('#photo_preview').html('<img src="' + response.path + '/' + response.filename + '" alt=""/>');
                                mestatus.html("'" + response.original + "'");
                                //mestatus.fadeOut(4000);
                            } else {
                                mestatus.html(response.error_value);
                            }
                            //On completion clear the status
                            //mestatus.text(res[1]+':Photo Uploaded Sucessfully!');

                            button.text("Upload");
                            this.enable();

                        }
                    });

                });

        </script>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
