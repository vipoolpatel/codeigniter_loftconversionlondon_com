<?php $this->load->library('common_lib'); 
$typeArr = array('home-features','seo-package-features','seo-service-features');?>
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
        </style>

    </head>

    <body>

        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4>MANAGE <?php echo ($type==0?'HOME':($type==1?'SEO PACKAGE':'SEO SERVICES'));?> FEATURES</h4> 

            <?php echo $this->session->flashdata('success') ? $this->session->flashdata('success') . "<br>" : ''; ?><br>
            <a href="<?php echo site_url('admin/'.(isset($typeArr[$type])?$typeArr[$type]:'service').'/add'); ?>" class="btn floatRight">ADD NEW FEATURE</a><br><br>
            <div class="clear"></div>
            <table id="header-navs" class="table no-margin table-striped table-bordered">
                <?php
                if($features){
	                foreach ($features as $t) {
	                    ?>
	                    <tr>
	                        <td>
	                            <div class="floatLeft leftTitle"><?php echo strtoupper($t->title); ?></td>
	                        <td width="35%">
	                            <a href="<?php echo site_url('admin/'.(isset($typeArr[$type])?$typeArr[$type]:'service').'/edit/' . $t->id); ?>" class="edit_but btn btn-success">Edit</a>
	                            <a href="<?php echo site_url('admin/'.(isset($typeArr[$type])?$typeArr[$type]:'service').'/delete/' . $t->id); ?>" class="del btn btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</a>
	                        </td>

	                    <tr>

	                    <?php }
	            }else{?>
	            	<tr><td colspan="2">No features found!</td></tr>
             	<?php }?>
            </table>

        </div>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
    </body>
</html>