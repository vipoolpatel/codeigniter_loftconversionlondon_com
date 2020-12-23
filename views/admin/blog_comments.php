<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
        <script>
            $(document).ready(function() {
                $('.change_status').click(function() {
                    var id = $(this).attr('id');
                    var stat = $('#status_' + id).val();
                    $.ajax({
                        url: '<?php echo site_url('admin/blog/change_status'); ?>',
                        data: 'id=' + id + '&is_active=' + stat,
                        type: 'post',
                        success: function(response)
                        {
                            if (response == "1")
                                $('#stat_'+id).html('Active');
                            else
                                $('#stat_'+id).html('Pending');
                            $('#status_' + id).val(response);
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4>BLOG COMMENTS</h4>
            <table id="header-navs" class="table no-margin table-striped table-bordered">
                <?php
                foreach ($comment->result() as $c) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo substr($c->comment, '0', '200');
                            ?></td>
                        <td>
                            <a href="javascript:void(0);" id="<?php echo $c->id; ?>" class="change_status">Click here to change status</a>
                            <p id="stat_<?php echo $c->id;?>">
                                <?php
                                if ($c->is_active == "1")
                                    echo "Active";
                                else
                                    echo "Pending";
                                ?></p>
                            <input type="hidden" id="status_<?php echo $c->id; ?>" value="<?php echo $c->is_active; ?>" />
                        </td><td>
                            <a href="<?php echo site_url('admin/blog/delete_comment/' . $c->id); ?>" class="del btn btn-danger" onclick="return confirm('Are You sure to delete?');">Delete</a>
                        </td>

                    </tr>
                    <?php
                }
                ?>  
            </table>
        </div>

        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
    </body>
</html>