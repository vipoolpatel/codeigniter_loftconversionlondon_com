<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->load->view("boxes/head_element") ?>
    </head>
    <body>
        <?php
        $this->load->view("boxes/admin_header_view");
        ?>
        <?php
        if ($this->session->userdata('user_id')) {
            $this->load->view('admin/boxes/admin_sidebar_view');
        }
        ?>
        <div class="row-fluid">
            <h4><?php echo $content; ?></h4>
            <div class="clear"></div>
            <div class="bord_block"></div>
        </div>
        <?php
        $this->load->view("boxes/admin_footer_view");
        ?>
    </body>
</html>