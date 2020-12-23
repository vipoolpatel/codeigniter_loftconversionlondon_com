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
            <h4>ADD UPLOAD IMAGE</h4>
            <hr />
            <div class="addNewContents">
                <form method="post"  enctype="multipart/form-data" action="">
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Image</label>
                        <input type="file" name="picture"  placeholder="Title" style="width:100%;" />
                    </div>
                
                    <hr>

                    <div style="float:left;">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary large"/>
                    </div>
                    <div class="clear"></div>
                </form>
               
            </div>
        </div>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
    </body>
</html>

