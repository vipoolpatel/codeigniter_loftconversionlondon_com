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

            <h4> MANAGE PAGES</h4>

          
            <span class="floatRight"><a class="btn btn-primary" style="margin-bottom: 10px;" href="<?php echo site_url('admin/content/upload_image_add') ?>">Add New</a></span> 



                <table id="header-navs" class="table no-margin table-striped table-bordered">



                    <?php
                    foreach ($pages as $nav) {

                        ?>
                        <tr>
                            <td><?=$nav->id?></td>
                            <td><img style="height: 100px;" src="<?=base_url()?>upload/<?=$nav->file_name?>"></td>
                            <td>
                                <?=base_url()?>upload/<?=$nav->file_name?>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="<?=base_url()?>admin/content/delete_upload_image/<?=$nav->id?>">Delete</a>    
                            </td>
                        </tr>


                        <?php
                    }
                    ?>

                    </ul>

                </table>

           

      


        </div>

        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>

    </body>

</html>