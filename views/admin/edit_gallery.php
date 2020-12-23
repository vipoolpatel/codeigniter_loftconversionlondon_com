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
            <h4>EDIT GALLERY</h4>
            <div class="addNewContents">
                <form method="post" name="frmEditContent" id="frmEditContent" action="">
                    <div  class="addnewpagetitletxtbox margintop10">
                        <input type="text" name="title" id="title" value="<?=$gallery->title?>" style="width:100%;" />
                        <input type="hidden" name="id" id="title" value="<?=$gallery->id?>" style="width:100%;" />
                    </div>
                    <div class="seperator"></div>
                   
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
