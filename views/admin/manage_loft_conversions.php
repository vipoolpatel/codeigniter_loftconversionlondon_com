<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
        <script type="text/javascript">
             $(document).ready(function()
            {
                $('#frmEditContent').validate({
                    rules: {
                        title: {required: true},
                        description: {required: true}
                    },
                    messages: {
                        title: {required: 'TITLE IS REQUIRED.'},
                        description: {required: 'DESCRIPTION IS REQUIRED.'}
                    }
                });
                
            });
        </script>

        <style>
            textarea {
                width:550px;
                height:60px;
            }
            .img-centered{
            	position: absolute; 
            	left: 50%;
            	top:50%;
            	transform: translate(-50%, -50%);
            }
        </style>

    </head>

    <body>
        <?php
        if ($tot > 0)
            $t = $service->row();
        else
            $t = "";

        $c = "";
        if ($t != "") {
            if ($t->is_active == '1')
                $c = "checked='checked'";
        }
        ?>
        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4 style="text-transform: uppercase;"><?php echo $t != "" ? "EDIT" : "ADD";?> Loft Conversions Typ</h4>
            <div class="addNewContents">
                <form method="post" name="frmEditContent" id="frmEditContent" action="<?php if ($t != "") echo site_url('admin/loft_conversions/edit/' . $t->id); ?>">
                    <div  class="addnewpagetitletxtbox margintop10">
                        <input type="text" style="width:100%;" name="title" id="title" value="<?php if ($t != "") echo $t->title; ?>" />
                    </div>
                    <div class="seperator"></div>
                    <div class="paddingleft15">
                        <textarea name="description" style="width:100%;" id="txtPageDes"><?php if ($t != "") echo $t->description; ?></textarea>
                        <div id="display_error"></div>
                    </div>
                    <br>
                    <div class="paddingleft15 margintop10">
                        <div id="show_image" class="show_images-investor" style="width:100px;height:100px;background: #CCC;position: relative;" >
                        	<?php if ($t != "")  {?> 
                        		<img src="<?php echo site_url('images/frontend/thumb/' . $t->image); ?>" class="img-centered"/>
                        	<?php } ?>
                        </div>
                        <input type="hidden" name="picture" id="pic" value="<?php if ($t != ""){ echo $t->image; }?>" /><br>
                        <input type="button" name="image" id="picture" class="btn"  value="Upload Image" />
                    </div>
                    <div class="seo_packs">
                        <ul>
                            <?php /* <li><h6>TITLE </h6>
                                <textarea name="meta_title" id="meta_title"><?php if ($t != ""){ echo $t->meta_title; }?></textarea>
                            </li>
                            <li>
                                <h6>DESCRIPTION</h6>
                                <textarea name="meta_desc" id="meta_desc"><?php if ($t != ""){ echo $t->meta_desc;} ?></textarea>
                            </li>
                            <li><h6>PAGE KEYWORDS</h6>
                                <textarea name="meta_tags" id="meta_tags"><?php if ($t != ""){ echo $t->meta_keywords; }?></textarea>
                            </li>*/?>
                            <?php
                            if ((isset($t->is_active) && $t->is_active == '1') || !isset($t->is_active))
                                $checked = ' checked=checked ';
                            else
                                $checked = '';
                            ?>
                            <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                    <input type="checkbox" name="is_active" <?php echo $checked; ?> id="status" value="1"  />
                                    <h6>VISIBLE AND DISPLAYS LIVE</h6> </label>
                            </li>
                        </ul>
                    </div>
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
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
        var mestatus = $('#mestatus');

        new AjaxUpload("#picture", {
            action: "<?php echo site_url('admin/loft_conversions/upload_photo'); ?>",
            name: 'image',
            enctype: 'multipart/form-data',
            onSubmit: function(file, ext) {
                $('#show_image').empty();
                $('#show_image').html('<img src="<?php echo base_url() . "images/big-ajax-loader.gif"; ?>"  class="img-centered">');

                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                    // extension is not allowed
                    mestatus.text('Only JPG, PNG or GIF files are allowed');
                    return false;
                }
                //mestatus.html('loading...');
                //$("#picture_button").text("Uploading");
                //this.disable();
            },
            onComplete: function(file, response) {

            	console.log(response);
                //alert(response);
                //alert(response);
                //mestatus.html(response);
                //Add uploaded file to list
                var response = eval('(' + response + ')');

                if (response.status == "success") {

                    //var file=res[1].split(" ");""
                    mestatus.html("");
                    var img = "<span  id='preview'><div class='upload'><img   src='" + response.path + "/" + response.thumb + "'  class='img-centered'></div><span>";
                    //var img_field = "<input type='hidden' name='picture' value='" + response.thumb + "'>";
                    $('#show_image').html(img);
                    $('#pic').val(response.thumb);
                    //$("#preview_"+id).attr('src',response.path+"/"+response.thumb);
                    //$("#picture_"+id).val(response.thumb);
                } else {
                    mestatus.html(response.error);
                }


                this.enable();
            }

        });

    });
</script>
