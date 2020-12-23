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
         <h4>  LOFT CONVERSION TYPE </h4>
         <!--<div class="title_top"><span class="green"><strong class="red">PAGE ORDER - </strong></span>Drag and drop the page order</div>--> 
         <span class="floatRight"><a class="btn btn-primary" style="margin-bottom: 10px;" href="<?=base_url()?>admin/content/content_type_add/<?=$content_id?>">Add New</a></span> 
         <?php
            if (!empty($getRecord)) {
                ?>
         <table id="header-navs" class="table no-margin table-striped table-bordered">
            <?php
               foreach ($getRecord as $value) {
                   ?>
            <tr>
               <td><?=$value->id?></td>
               <td><?=$value->title?></td>
               
               <td><?=$value->description?></td>
               <td>
                  <?php
                     if (!empty($value->image_name)) {
                     ?>
                  <a target="_blank" href="<?=base_url()?>images/type/<?=$value->image_name?>">
                     <img height="80px;" width="80px" src="<?=base_url()?>images/type/<?=$value->image_name?>" target="_blank">
                     <?php }?>
               </td>
                <td><?=$value->default_image?></td>
               <td class="span2"><a href="<?=base_url()?>admin/content/content_type_edit/<?=$value->id?>/<?=$content_id?>" class="edit_but btn btn-primary btn-small tuc">Edit</a></td>
               <td class="span2">
                  <a href="<?=base_url()?>admin/content/content_type_delete/<?=$value->id?>/<?=$content_id?>" class="edit_but btn btn-primary btn-small tuc">Delete</a>
               </td>
            </tr>
            <?php
               }
               ?>
            </ul>
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
