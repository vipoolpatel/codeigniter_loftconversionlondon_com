<?php $this->load->library('common_lib');?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php echo $this->load->view("admin/boxes/head_element") ?>
      <link rel="stylesheet" href="<?php echo site_url('css/ui-lightness/jquery-ui-1.8.11.custom.css') ?>" type="text/css" media="all" />
      <script type="text/javascript" src="<?php echo site_url('js/jquery-ui-1.7.1.custom.min.js') ?>"></script>
      <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
      <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
      <style>
         textarea {
         width:550px;
         height:60px;
         }
      </style>
   </head>
   <body>
      <?php
         $this->load->view("admin/boxes/admin_header_view");
         ?>
      <div class="row-fluid white-card mt20 extra-padding">
         <h4>EDIT LOFT CONVERSION TYPE</h4>
         <div class="addNewContents">
            <form method="post" action="" enctype="multipart/form-data">
               <div  class="addnewpagetitletxtbox margintop10">
                  <label>Title</label>
                  <input type="text" required name="title" value="<?=$getRecord->title?>" style="width: 70%;"/>
               </div>
               <div class="paddingleft15">
                  <label>Description</label>
                  <textarea name="description" required style="width: 70%;"><?=$getRecord->description?></textarea>
               </div>
               <div class="paddingleft15">
                  <label>Image Name</label>
                  <input type="file" name="image_name">
                  <?php
                     if (!empty($getRecord->image_name)) {
                         ?>
                  <img  width="70" height="70"  src="<?=base_url()?>images/type/<?=$getRecord->image_name?>">
                  <input type="hidden" value="<?=$getRecord->image_name?>" name="old_image_name">
                  <?php }?>
               </div>
               <div style="margin-top: 10px;"  class="addnewpagetitletxtbox margintop10">
                  <label>Default Image</label>
                  <select name="default_image" style="width: 70%;">
                     <option value="">Select Default Image</option>
                     <option value="Dormer-Conversion.jpg" <?=($getRecord->default_image == 'Dormer-Conversion.jpg')? 'selected':''?>>Dormer Conversion</option>
                     <option value="Gable-Conversion.jpg" <?=($getRecord->default_image == 'Gable-Conversion.jpg')? 'selected':''?>>Gable Conversion</option>
                     <option value="Velux-Conversion.jpg" <?=($getRecord->default_image == 'Velux-Conversion.jpg')? 'selected':''?>>Velux Conversion</option> 

                     <option value="bungalow-loft-conversion-illustrated.jpg" <?=($getRecord->default_image == 'bungalow-loft-conversion-illustrated.jpg')? 'selected':''?>>Bungalow loft conversion illustrated</option>
                     
                     <option value="mansard-loft-conversion-london-illustration.jpg" <?=($getRecord->default_image == 'mansard-loft-conversion-london-illustration.jpg')? 'selected':''?>>Mansard Loft Conversion London Illustration</option>

                  </select>
               </div>
               <hr />
               <div class="seperator"></div>
               <div style="float:right;">
                  <input type="submit" name="submit" value="Submit" class="btn primary large"/>
               </div>
               <div class="clear"></div>
            </form>
         </div>
      </div>
      <?php
         $this->load->view("admin/boxes/admin_footer_view");
         ?>
   </body>
</html>