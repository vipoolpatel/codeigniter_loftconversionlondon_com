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
         <h4>ADD TESTIMONIAL STUDY</h4>
         <div class="addNewContents">
            <form method="post" action="" enctype="multipart/form-data">
               <div  class="addnewpagetitletxtbox margintop10">
                  <label>Title</label>
                  <input type="text" required name="title" style="width: 70%;"/>
               </div>
               <div class="paddingleft15">
                  <label>Description</label>
                  <textarea name="description" required style="width: 70%;"></textarea>
               </div>
               <div class="paddingleft15">
                  <label>Image Name</label>
                  <input type="file" required name="image_name">
               </div>
               <div  style="margin-top: 10px;"  class="addnewpagetitletxtbox margintop10">
                  <label>URL</label>
                  <select name="sub_content_id" required style="width: 70%;">
                     <option value="">Select Content Name</option>
                     <?php
                        foreach($content_list as $content)
                        {
                        ?>
                     <option value="<?=$content->id?>"><?=$content->title?></option>
                     <?php
                        }
                        ?>  
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
