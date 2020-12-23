<?php $this->load->library('common_lib');?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

        <link rel="stylesheet" href="<?php echo site_url('css/ui-lightness/jquery-ui-1.8.11.custom.css') ?>" type="text/css" media="all" />

        <script type="text/javascript" src="<?php echo site_url('js/jquery-ui-1.7.1.custom.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>





        <script type="text/javascript">

            $(document).ready(function()

            {

                //alert('here');

                $('#frmEditContent').validate({
                    rules: {
                        title: {required: true}

                    },
                    messages: {
                        title: {required: 'CONTENT TITLE IS REQUIRED.'}

                    }

                });

                $('#frmEditContent').submit(function() {

                    var editorcontent = CKEDITOR.instances['txtPageDes'].getData().replace(/<[^>]*>/gi, '');



                    if (!editorcontent.length)

                    {

                        $('#display_error').html('<div class="error">CONTENT DESCRIPTION IS REQUIRED.</div>');

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

        <style>

            textarea {

                width:550px;

                height:60px;

            }

        </style>

    </head>

    <body>

        <?php
$this->load->view("admin/boxes/admin_header_view");
?>

        <div class="row-fluid white-card mt20 extra-padding">

            <h4>EDIT CONTENT PAGE</h4>

            <div class="addNewContents">

                <form method="post" name="frmEditContent" id="frmEditContent" action="" enctype="multipart/form-data">



                    <div  class="addnewpagetitletxtbox margintop10">
                        <input type="text" name="title" id="title" style="width: 70%;" value="<?php echo $details['title']; ?>" />
                    </div>

                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Sub title</label>
                        <input type="text" name="sub_title" style="width: 70%;" value="<?php echo $details['sub_title']; ?>" />
                    </div>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Main title 1</label>
                        <input type="text" name="main_title_1" style="width: 70%;" value="<?php echo $details['main_title_1']; ?>" />
                    </div>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Main title 2 </label>
                        <input type="text" name="main_title_2" style="width: 70%;" value="<?php echo $details['main_title_2']; ?>" />
                    </div>

                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Page SEO</label>
                        <input type="text" name="page_seo" style="width: 70%;" value="<?php echo $details['page_seo']; ?>" />
                    </div>

                    <div class="seperator"></div>

                    <div class="paddingleft15">
                        <textarea name="txtPageDes" id="txtPageDes"><?php echo $details['desc']; ?></textarea>
                        <?php echo $this->ckeditor->replace("txtPageDes"); ?>
                        <div id="display_error"></div>

                    </div>

                    <div class="paddingleft15">
                        <textarea name="more_info" id="more_info"><?php echo $details['desc_more']; ?></textarea>
                        <?php echo $this->ckeditor->replace("more_info"); ?>
                        <div id="display_error"></div>
                    </div>


                     <div  class="addnewpagetitletxtbox margintop10">
                        <label>Google Map URL</label>
                        <input type="text" name="google_map_url" style="width: 70%;" value="<?php echo $details['google_map_url']; ?>" />
                    </div>


                    <hr />

                    <div class="paddingleft15">
                        <label>Background Image</label>
                        <input type="file" name="background_image">
                        <br />
                        <?php
if (!empty($details['background_image'])) {
	?>
    <img src="<?=base_url()?>images/background/<?=$details['background_image']?>" style="height:100px;">
    <a class="btn btn-danger" href="<?=base_url()?>admin/content/delete_background_image/<?=$details['id']?>">Delete</a>
 <?php }
?>
<input type="hidden" value="<?=$details['background_image']?>" name="old_background_image">
                    </div>
                    <hr />



                    <div class="seo_packs">

                        <h5 class="mt20">SEO TAGS (optional)</h5>

                        <ul>
                            <li><h6>TITLE </h6>
                                <textarea name="meta_title" id="meta_title"><?php
if ($details['meta_title'] == "") {
	echo $details['title'];
} else {
	echo $details['meta_title'];
}
?>
                                </textarea>
                            </li>
                            <li>
                                <h6>DESCRIPTION</h6>
                                <textarea name="meta_desc" id="meta_desc"><?php
if ($details['meta_desc'] == "") {
	echo substr(trim(strip_tags($details['meta_desc'])), 0, 160);
} else {
	echo $details['meta_desc'];
}
?>
                                </textarea>
                            </li>
                            <li>
                                <h6>PAGE KEYWORDS</h6>
                                <textarea name="meta_tags" id="meta_tags"><?php echo $details['meta_keywords']; ?></textarea>
                            </li>

                            <div class="paddingleft15 margintop10">
                        <div id="show_image" class="show_images-investor" style="width:100px;height:100px;background: #CCC;position: relative;" >
                            <?php if ($details['image_name'] != "") {?>
                                    <img src="<?php echo site_url('images/temp/thumb/' . $details['image_name']); ?>" class="img-centered"/>
                            <?php }?>
                        </div>
                        <input type="hidden" name="image_name" id="pic" value="<?=$details['image_name']?>" /><br>
                        <input type="button" name="image" id="picture" class="btn"  value="Upload Image" />
                    </div>





                            <?php
if (isset($details['status']) && $details['status'] == '1') {
	$checked = ' checked=checked ';
} else {
	$checked = '';
}

?>
                            <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                <input type="checkbox" name="page_status" <?php echo $checked ?> id="page_status" value="1"  />
                                <h6>PAGE IS VISIBLE AND DISPLAYS LIVE</h6> </label>
                            </li>
                            <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                <input type="checkbox" name="on_footer" <?=!empty($details['on_footer']) ? 'checked' : ''?>   />
                                <h6 style="text-transform: uppercase;">Page Display in footer</h6> </label>
                            </li>

                            <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                <input type="checkbox" name="gallery" <?=!empty($details['gallery']) ? 'checked' : ''?>   />
                                <h6 style="text-transform: uppercase;">Gallery</h6> </label>
                            </li>




                             <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                <input type="checkbox" name="on_contact"  <?=!empty($details['on_contact']) ? 'checked' : ''?> />
                                <h6 style="text-transform: uppercase;">Contact Button</h6> </label>
                            </li>
                        </ul>
                    </div>

                    <div class="seperator"></div>

                    <div style="float:right;">

                        <input type="submit" name="submit" value="Submit" class="btn primary large"/>

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
            action: "<?php echo site_url('admin/content/upload_photo'); ?>",
            name: 'image',
            enctype: 'multipart/form-data',
            onSubmit: function(file, ext) {
                $('#show_image').empty();
                $('#show_image').html('<img src="<?php echo base_url() . "images/big-ajax-loader.gif"; ?>"  class="img-centered">');
                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                    mestatus.text('Only JPG, PNG or GIF files are allowed');
                    return false;
                }
            },
            onComplete: function(file, response) {
                var response = eval('(' + response + ')');
                if (response.status == "success") {
                    mestatus.html("");
                    var img = "<span  id='preview'><div class='upload'><img   src='" + response.path + "/" + response.thumb + "'  class='img-centered'></div><span>";
                    $('#show_image').html(img);
                    $('#pic').val(response.thumb);
                } else {
                    mestatus.html(response.error);
                }


                this.enable();
            }

        });

    });
</script>
