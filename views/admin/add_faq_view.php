<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

    </head>

    <body>

        <?php $this->load->view("admin/boxes/admin_header_view"); ?>

        <div class="row-fluid white-card extra-padding mt20">

            <h4><?php echo $mode; ?> FAQ</h4>

            <p class="error"> <?php echo $this->session->flashdata('info'); ?></p>

            <form method="post" name="frmFAQ" id="frmFAQ" action="" class="form-horizontal">

                <input type="hidden" name="mode" value="<?php echo $mode; ?>">

                    <div class="control-group">
                        <label class="control-label">Question</label>
                        <div class="controls">
                            <textarea name="question" id="question" class="required span7" ><?php echo ($mode == "Edit") ? $faq->question : ""; ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Answer  </label>
                        <div class="controls">
                            <textarea name="answer" id="answer" class="required span7" style="height:100px" ><?php echo ($mode == "Edit") ? $faq->answer : ""; ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                        </div>
                    </div>

            </form>



        </div>            <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>




        <script>

            $(document).ready(function() {

                $('#frmFAQ').validate();

            });

        </script>

