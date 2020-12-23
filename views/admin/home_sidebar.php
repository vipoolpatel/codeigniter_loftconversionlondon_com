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
            <h4>MANAGE HOME SIDEBAR</h4>

            <?php echo $this->session->flashdata('success') ? $this->session->flashdata('success') . "<br>" : ''; ?><br>
            <a href="<?php echo site_url('admin/home_sidebar/add'); ?>" class="btn floatRight">ADD NEW LINK</a><br><br>
            <div class="clear"></div>
            <table id="header-navs" class="table no-margin table-striped table-bordered">
                <?php
                $i = 1;
                foreach ($home_sidebar as $t) {
                    ?>
                    <tr>
                        <td style="width: 4%;"><?=$t->id?></td>
                        <td>
                            <div class="floatLeft leftTitle"><?=$t->title?></div>
                        </td>
                        <td width="35%">
                            <a href="<?php echo site_url('admin/home_sidebar/edit/' . $t->id); ?>" class="edit_but btn btn-success">Edit</a>
                            <a href="<?php echo site_url('admin/home_sidebar/delete/' . $t->id); ?>" class="edit_but btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php 
                    $i++;
                }
                    ?>
            </table>

        </div>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
    </body>
</html>