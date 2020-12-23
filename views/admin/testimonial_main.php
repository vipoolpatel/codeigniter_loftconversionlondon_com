<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

    </head>

    <body>

        <?php $this->load->view("admin/boxes/admin_header_view"); ?>

        <div class="row-fluid white-card extra-padding mt20">

            <h4 class="left">MANAGE TESTIMONIALS</h4><a class="btn btn-primary right" href="<?php echo site_url('admin/testimonial/add') ?>" >+ ADD</a>
            <div class="clear"></div>
            <table id="testimonials-list">
                <?php
                if (is_array($testimonials)) {
                    ?>
                    <table id="t-list" class="table no-margin table-striped table-bordered">
                        <?php
                        foreach ($testimonials as $n) {
                            ?>


                            <tr>
                                <td><?php echo ucwords($n['name']) ?></strong>&nbsp;-&nbsp;
                                    <i><?php echo ucwords($n['company']); ?></i></td>

                                <td class="span2"><a href="<?php echo site_url('admin/testimonial/edit/' . $n['id']); ?>" class="btn btn-primary btn-small tuc">Edit</a></td>

                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                } else {
                    ?>
                    There are no testimonials!
                <?php }
                ?>
        </div>
        <div id="showmsg"></div>
        <?php
        $message = $this->session->flashdata('message');
        if ($message) {
            ?> 
            <div class="<?php echo ($message != '') ? 'messagesuccess' : '' ?> "><?php echo $message; ?></div>
        <?php }
        ?>
        </div>



        </div>


        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>

    </body>

</html>
<script language="javascript">
    $(document).ready(function() {
        $('#testimonials-list ul').sortable({
            items: "li:not(.ui-state-disabled)",
            update: function(event, ui) {
                list = ui.item.parent().attr('id');
                var order = [];// array to hold the id of all the first level child li of header-navs
                if (list == 't-list')
                {
                    $('#t-list').children().each(function(index) {
                        var item = $(this).attr('id').split('_');
                        var val = item[1];
                        order.push(val);
                    });
                    var itemList = "list=" + order;
                    $("#showmsg").load("<?php echo site_url('admin/testimonial/sort_testimonial/'); ?>", itemList);
                }
            }
        });
    });

</script>
