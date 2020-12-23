<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.validate.js') ?>"></script>
        <script type="text/javascript">

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
            <h4><?php echo $footer_logo? "EDIT" : "ADD"; ?> FOOTER LOGO</h4>
            <div class="addNewContents">
                <form method="post" name="frmEditContent" id="frmEditContent" enctype="multipart/form-data" action="<?php if ($footer_logo) {echo site_url('admin/footer_logo/edit/' . $footer_logo->id);} ?>">
                    <div class="addnewpagetitletxtbox margintop10">
                        <div class="span2"><div class="pull-right">Name: </div></div>
                        <div class="span9">
                            <input type="text" style="width: 100%" name="name" id="name" required value="<?php if ($footer_logo != "") echo $footer_logo->name; ?>" placeholder="Name" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                     <div class="addnewpagetitletxtbox margintop10">
                        <div class="span2"><div class="pull-right">URL: </div></div>
                        <div class="span9">
                            <input type="text" style="width: 100%" name="url" id="url" required value="<?php if ($footer_logo != "") echo $footer_logo->url; ?>" placeholder="URL" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr/>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Logo:</div></div>
                        <div class="span9">
                            <input type="file" name="logo"><br>
                            
                            <?php
                            if(!empty($footer_logo->logo))
                            { ?>
                            <img style="height: 100px;" src="<?=base_url()?>images/<?=$footer_logo->logo?>">  
                            <?php }
                            ?>
                            
                        </div>
                    </div>
               
                   
                    <div class="clearfix"></div>

                    <br>
                    
                    <div class="clearfix"></div>
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
