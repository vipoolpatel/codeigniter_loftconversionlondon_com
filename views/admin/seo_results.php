<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
    </head>
    <body>
        <?php $this->load->view("admin/boxes/admin_header_view"); ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4>MANAGE SEO RESULTS</h4>

            <?php echo $this->session->flashdata('success') ? $this->session->flashdata('success') . "<br>" : ''; ?><br>
            <a href="<?php echo site_url('admin/results/add_result'); ?>" class="btn floatRight">ADD NEW SEO RESULT</a><br><br>
            <div class="clear"></div>
            <table id="header-navs" class="table no-margin table-striped table-bordered">
            	<?php if($result){?>
	                <?php foreach ($result as $t) { ?>
	                    <tr>
	                        <td>
	                            <div class="floatLeft leftTitle"><?php echo strtoupper($t->title); ?>
                            </td>
	                        <td width="35%">
	                            <a href="<?php echo site_url('admin/results/edit_result/' . $t->id); ?>" class="edit_but btn btn-success">Edit</a>
	                            <a href="<?php echo site_url('admin/results/delete_result/' . $t->id); ?>" class="del btn btn-danger" onclick="return confirm('Are You sure to delete?');">Delete</a>
	                        </td>
	                    <tr>
                    <?php }?>
                <?php }else{?>
                	<tr>
                		<td colspan="2">
                			There are no SEO Results added.
                		</td>
                	</tr>
                <?php }?>
            </table>

        </div>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
    </body>
</html>