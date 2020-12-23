<?php $this->load->library('common_lib'); ?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

        <link rel="stylesheet" href="<?php echo site_url('css/ui-lightness/jquery-ui-1.8.11.custom.css') ?>" type="text/css" media="all" />

        <script type="text/javascript" src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo site_url('js/jquery-ui-1.7.1.custom.min.js') ?>"></script>

        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>

        <script type="text/javascript">

            $(document).ready(function() {

                $('#Form').validate();

            });

        </script>

    </head>

    <body>

        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>



        <div class="row-fluid white-card extra-padding mt20">

            <h4>ADMIN EMAIL LIST</h4>



            <?php echo $this->session->flashdata('msg'); ?>

            <?php
            if ($list->num_rows() > 0)
                $list = $list->row();



            if ($count == 0) {

                echo "<p class='error aligncenter'>No admin email is listed.</p>";
            }
            ?>



            <form action="" method="POST" id="Form" class="form-horizontal" >

                <div class="control-group">
                    <label class="control-label">Email 1:</label>
                    <div class="controls"><input type="text" name="email1" value="<?php if ($count == 1) echo $list->email1; ?>" class="required email"  /></div>

                </div>




                <div class="control-group">
                    <label class="control-label">Email 2:</label>
                    <div class="controls"><input type="text" name="email2" value="<?php if ($count == 1) echo $list->email2; ?>" class="email"  /></div>
                </div>



                <div class="control-group">
                    <label class="control-label">Email 3:</label>

                    <div class="controls"><input type="text" name="email3" value="<?php if ($count == 1) echo $list->email3; ?>" class="email"  /></div>

                </div>



                <div class="control-group">
                    <label class="control-label">Email 4:</label>

                    <div class="controls"><input type="text" name="email4" value="<?php if ($count == 1) echo $list->email4; ?>" class="email"  /></div>

                </div>



                <div class="control-group">
                    <label class="control-label">Email 5:</label>
                    <div class="controls"><input type="text" name="email5" value="<?php if ($count == 1) echo $list->email5; ?>" class="email"  /></div>
                </div>



                <div class="control-group">
                    <label class="control-label"></label>

                    <div class="controls"> <input type="submit" name="btnsubmit" value="Update Emails" class="btn btn-primary" /> </div>



            </form>



        </div>



    </div>

    <?php
    $this->load->view("admin/boxes/admin_footer_view");
    ?>

</body>

</html>