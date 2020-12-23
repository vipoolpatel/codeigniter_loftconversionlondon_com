<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

    </head>

    <body>

        <?php $this->load->view("admin/boxes/admin_header_view"); ?>

        <div class="row-fluid white-card extra-padding mt20">


            <h4 class="left">FAQS</h4>

            <a class="btn btn-primary right" href="<?php echo site_url('admin/faqs/add'); ?>" class="btn info">Add FAQ</a>
            <div class="clear"></div>

            <?php echo $this->session->flashdata('info'); ?>



            <?php
            if (!empty($all_faqs)) {
                ?>


                <table class="table no-margin table-striped table-bordered">

                    <?php
                    foreach ($all_faqs as $faq) {
                        ?>

                        <tr>

                            <td>
                                <?php echo $faq->question; ?></td>

                            <td class="span2"> 
                                <div class="btn-group">
                                    <a href="<?php echo site_url('admin/faqs/edit/' . $faq->id); ?>" class="edit_but btn btn-primary btn-small tuc">Edit</a>

                                    <a href="<?php echo site_url('admin/content/delete_faq/' . $faq->id); ?>" onclick="return confirm('Are you sure you want to delete this FAQ?');" title="Delete" class="del_but btn btn-primary btn-small tuc">Delete</a></div></td>

                        </tr>

                        <?php
                    }
                    ?>

                </table>

            </div> 



            <?php
            //echo $links;
        } else {

            echo "There are no faqs.";
        }
        ?>



        </div>

        </div>
        <script type="text/javascript">

                                        $(document).ready(function() {

                                            $('#Form').validate();

                                        });

        </script>



        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>

    </body>

</html>



