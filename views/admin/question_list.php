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

            <h4> MANAGE QUESTION</h4>

          
            <span class="floatRight"><a class="btn btn-primary" style="margin-bottom: 10px;" href="<?=base_url();?>admin/content/question_add/<?=$content_id?>">Add New</a></span> 



                <table id="header-navs" class="table no-margin table-striped table-bordered">



                    <?php
                      foreach ($getRecord as $value) {
                    ?>
                        <tr>
                            <td><?=$value->id?></td>
                            <td>
                                <?=$value->title?>
                            </td>
                           <!--  <td>
                                <?=$value->description?>
                            </td> -->
                            <td><?php
                            if(!empty($value->image_name)){
                            ?>

                                <img style="height: 100px;" src="<?=base_url()?>upload/question/<?=$value->image_name?>">
                                <?php
                                    }
                                ?></td>

                                <td>
                                    <?=!empty($value->is_full_screen) ? 'Yes' : 'No'?>
                                </td>
                            
                                 <td>
                                    <?=$value->order_by?>
                                </td>
                            
                           
                <td class="span2"><a href="<?=base_url()?>admin/content/question_edit/<?=$value->id?>/<?=$content_id?>" class="edit_but btn btn-primary btn-small tuc">Edit</a></td>
               <td class="span2">
                  <a href="<?=base_url()?>admin/content/question_delete/<?=$value->id?>/<?=$content_id?>" class="edit_but btn btn-primary btn-small tuc" onclick="return confirm('Are you sure delete?')">Delete</a>
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