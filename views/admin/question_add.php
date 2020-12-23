<?php $this->load->library('common_lib'); ?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

        <link rel="stylesheet" href="<?php echo site_url('css/ui-lightness/jquery-ui-1.8.11.custom.css') ?>" type="text/css" media="all" />

        <script type="text/javascript" src="<?php echo site_url('js/jquery-ui-1.7.1.custom.min.js') ?>"></script>

        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>

        <script type="text/javascript">

            $(document).ready(function()

            {

                //alert('here');

                $('#frmEditContent').validate({
                    rules: {
                        title: {required: true}

                    },
                    messages: {
                        title: {required: 'CONTENT TITLE IS REQUIRED.'}

                    }

                });

                $('#frmEditContent').submit(function() {

                    var editorcontent = CKEDITOR.instances['txtPageDes'].getData().replace(/<[^>]*>/gi, '');



                    if (!editorcontent.length)

                    {

                        $('#display_error').html('<div class="error">CONTENT DESCRIPTION IS REQUIRED.</div>');

                        return false;

                    }

                    else

                    {

                        $('#display_error').html('');

                    }

                    return true;

                });





            });

        </script>

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

            <h4>ADD QUESTION</h4>

            <div class="addNewContents">

                <!-- <form method="post" name="frmEditContent" id="frmEditContent" action=""> -->
                  <form method="post" action="" enctype="multipart/form-data">



                    <div  class="addnewpagetitletxtbox margintop10">
                         <label>Title</label>
                        <input type="text" name="title" id="title" style="width: 70%;">
                    </div>

                    <div class="seperator"></div>

                    <div class="paddingleft15">
                        <textarea name="description" id="txtPageDes"></textarea>
                        <?php echo $this->ckeditor->replace("txtPageDes"); ?>
                        <div id="display_error"></div>

                    </div>
                    
                      <div class="seperator" style="margin-bottom: 15px;"></div>
                     <div  class="addnewpagetitletxtbox margintop10">
                        <label>Image Name</label>
                        <input type="file" name="image_name" style="width: 70%;">
                    </div>
                    <div class="seperator" style="margin-bottom: 15px;"></div>
                     <div  class="addnewpagetitletxtbox margintop10">
                        <label>Full Screen</label>
                        <input type="checkbox" name="is_full_screen" >
                    </div>


                      <div class="seperator" style="margin-bottom: 15px;"></div>
                     <div  class="addnewpagetitletxtbox margintop10">
                        <label>Order By</label>
                        <select name="order_by">
                            <?php 
                            for($i = 1; $i <= 100; $i++)
                            {
                            ?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php 
                            }
                            ?> 

                        </select>
                    </div>


                    <div style="float:right;">

                        <input type="submit" name="submit" value="Submit" class="btn primary large"/>

                    </div>

                    <div class="clear"></div>

                </form>

                <?php
                if (isset($message)) {
                    ?>

                    <div class="<?php echo $message != '' ? 'messagesuccess' : '' ?>"><?php echo $message; ?></div>

                <?php }
                ?>

            </div>

        </div>

        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>

    </body>

</html>