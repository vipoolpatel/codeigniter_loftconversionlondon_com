<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url('js/jquery-ui-1.7.1.custom.min.js') ?>"></script>
    </head>
    <body>
        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>
        <div class="row-fluid white-card extra-padding mt20">
            <h4> MANAGE GALLERY IMAGE</h4>
            <span class="floatRight"><a class="btn btn-primary" style="margin-bottom: 10px;" href="<?php echo site_url('admin/gallery/image_add/'.$id) ?>">Add New</a></span> 
            <?php
            if (!empty($gallery)) {
                ?>
                <table id="header-navs" class="table no-margin table-striped table-bordered">
                    <?php
                    foreach ($gallery as $nav) {
                        $ids = $nav->id;
                        $delete_url = site_url('admin/gallery/delete_image/' . $id.'/'.$ids);
                        ?>
                        <tr>
                            <td><?php echo strtoupper($nav->title); ?></td>
                            <td>
                                <img src="<?php echo site_url('images/temp/thumb/' . $nav->name); ?>" class="img-centered"/>
                            </td>
                            <td class="span2"><a href="<?php echo $delete_url; ?>" class="edit_but btn btn-primary btn-small tuc">Delete</a></td>
                        </tr>
                    <?php }
                    ?>
                </table>

                <div id="showmsg"></div>

                <?php
            }
          
            ?>



        </div>

        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>

    </body>

</html>