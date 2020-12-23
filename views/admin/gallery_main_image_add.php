<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>

    </head>

    <body>
      
        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4>ADD IMAGE GALLERY</h4>
            <div class="addNewContents">
                <form method="post" name="frmEditContent" id="frmEditContent" action="">
                    <div  class="addnewpagetitletxtbox margintop10">
                        <input type="text" name="title" id="title" value="" placeholder="Title" style="width:100%;" />
                    </div>
                    <div class="seperator"></div>
                    <div class="paddingleft15 margintop10">
                        <div id="show_image" class="show_images-investor" style="width:100px;height:100px;background: #CCC;position: relative;" >
                        </div>
                        <input type="hidden" name="name" id="pic" value="" /><br>
                        <input type="button" name="image" id="picture" class="btn"  value="Upload Image" />
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
            action: "<?php echo site_url('admin/gallery/upload_photo'); ?>",
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

