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
        </style>

    </head>

    <body>

        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4>MANAGE SERVICES</h4>

            <?php echo $this->session->flashdata('success') ? $this->session->flashdata('success') . "<br>" : ''; ?><br>
            <a href="<?php echo site_url('admin/services/add'); ?>" class="btn floatRight">ADD NEW SERVICE</a><br><br>
            <div class="clear"></div>
            <table id="header-navs" class="table no-margin table-striped table-bordered">
                <?php
                if($services->num_rows()>0){
	                foreach ($services->result() as $t) {
	                    ?>
	                    <tr>
	                        <td>
	                            <div class="floatLeft leftTitle"><?php echo strtoupper($t->title); ?></td>
	                        <td width="35%">
	                            <a href="<?php echo site_url('admin/services/edit/' . $t->id); ?>" class="edit_but btn btn-success">Edit</a>
	                            <a href="<?php echo site_url('admin/services/delete/' . $t->id); ?>" class="del btn btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</a>
	                        </td>

	                    <tr>

	                    <?php }
	            }else{?>
	            	<tr><td colspan="2">No services found!</td></tr>
             	<?php }?>
            </table>

        </div>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
    </body>
</html>