<!DOCTYPE html>

<html lang="en">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo base_url('js/ajaxupload.3.6.js'); ?>"></script>
    </head>

    <body>

        <?php $this->load->view("admin/boxes/admin_header_view");
        ?>



        <div class="row-fluid white-card extra-padding mt20">
            <?php if (!empty($client)) {
                ?>
                <a class="btn btn-primary" href="<?php echo site_url('admin/client/view/' . $client->id); ?>">Back</a>
                <h4> Domain: <?php echo $client->domain; ?></h4>

            <?php } ?>
            <h5 class="mt20">Add Keywords</h5>
            <?php if (!empty($keywords)) {
                ?> 
                <ul class="keywords">
                    <?php foreach ($keywords as $key) {
                        ?>
                        <li class="keys" id="key_<?php echo $key->id; ?>"><?php echo $key->keyword; ?></li>
                    <?php }
                    ?>
                </ul>
            <?php } ?>
            <form action="" method="post" id="keyword-form">
                <div class="row-fluid mt20">
                    <label class="span2" style="text-align:right">Enter keyword:</label>
                    <div class="span8"> <input type="text" name="keyword" id="keyword" class="required"  /></div>
                </div>
                <div class="row-fluid">
                    <label class="span2"></label>
                    <div class="span8"> <input type="submit" name="submit" value="Submit" class="btn btn-primary"/></div>
                </div>
            </form>

        </div>

        <script>
            $(document).ready(function() {
                $('#keyword-form').validate({
                    submitHandler: function(form) {
                        var exist = 0;
                        var keyword = $('#keyword').val();
                        $('.keys').each(function() {
                            var value = $(this).html();
                            if (keyword.toLowerCase() == value.toLowerCase())
                            {
                                exist = 1;
                                alert('Keyword "' + keyword + '" is already added!');
                                return false;
                            }
                        });

                        if (exist != 1)
                        {
                            form.submit();
                        }
                    }
                });
            });
        </script>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>