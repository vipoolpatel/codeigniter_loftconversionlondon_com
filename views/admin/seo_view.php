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
            <h4>MANAGE SEO</h4>

            <?php echo $this->session->flashdata('success') ? $this->session->flashdata('success') . "<br>" : ''; ?><br>
            <a href="<?php echo site_url('admin/seo/add'); ?>" class="btn floatRight">ADD NEW SEO</a><br><br>
            <div class="clear"></div>
            <table id="header-navs" class="table no-margin table-striped table-bordered">
                <?php
                if($seos){
	                foreach ($seos as $seo) {
	                    ?>
	                    <tr>
	                        <td>
	                            <div class="floatLeft leftTitle"><?php echo strtoupper($seo->page); ?></td>
	                        <td width="35%">
	                            <a href="<?php echo site_url('admin/seo/edit/' . $seo->id); ?>" class="edit_but btn btn-success">Edit</a>
	                            <a href="<?php echo site_url('admin/seo/delete/' . $seo->id); ?>" class="del btn btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</a>
	                        </td>

	                    <tr>

	                    <?php }
	            }else{?>
	            	<tr><td colspan="2">No seo found!</td></tr>
             	<?php }?>
            </table>

        </div>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
    </body>
</html>