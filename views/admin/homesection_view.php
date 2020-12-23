<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('#frmEditContent').validate({
                    rules: {
                        main_title: {required: true},
                        bottom_title: {required: true}
                    },
                    messages: {
                        main_title: {required: 'TITLE IS REQUIRED.'},
                        bottom_title: {required: 'TITLE IS REQUIRED.'}
                    }
                });
                
            });
        </script>

        <style>
            .btn-remove {
                margin: 0 0 10px 5px;
            }
            .text-success{
                color: #3c763d;
                margin:10px 0;
            }
        </style>

    </head>

    <body>
        <?php $points = ""; $t = "";
        if ($homesection->num_rows() > 0){
            $t = $homesection->row();
            $desc = $t->bottom_description;

            if($desc){
                $points = explode("#!#",$desc);
            }
        }

        $c = "";

        ?>
        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4><?php echo $t != "" ? "EDIT" : "ADD";?> Home Section</h4>
            <div class="text-success">
                <?php echo $this->session->flashdata('success');?>
            </div>
            <div class="addNewContents"><br>
                <form method="post" name="frmEditContent" id="frmEditContent" action="">
                    <h5>Main Section</h5>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Title</label>
                        <input type="text" name="main_title" class="span5" id="main_title" value="<?php if ($t != "") echo $t->main_title; ?>" />
                    </div>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Sub Title</label>
                        <textarea type="text" name="main_sub_title" class="span5" id="main_sub_title"><?php if ($t != "") echo $t->main_sub_title; ?></textarea>
						<?php echo $this->ckeditor->replace("main_sub_title"); ?>
                    </div>
					
					
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Caption</label>
                        <input type="text" name="main_caption"  class="span5" id="main_caption" value="<?php if ($t != "") echo $t->main_caption; ?>" />
                    </div>
                    <div class="seperator"></div>
					
                    <hr>
					
					<h5>Middle Section</h5>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Title</label>
                        <input type="text" name="middle_title" class="span5" id="main_title" value="<?php if ($t != "") echo $t->middle_title; ?>" />
                    </div>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Sub Title</label>
                        <textarea type="text" name="middle_sub_title" class="span5" id="middle_sub_title"><?php if ($t != "") echo $t->middle_sub_title; ?></textarea>
						<?php echo $this->ckeditor->replace("middle_sub_title"); ?>
                    </div>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Caption</label>
                        <input type="text" name="middle_caption"  class="span5" id="main_caption" value="<?php if ($t != "") echo $t->middle_caption; ?>" />
                    </div>
					
			        <div class="seperator"></div><hr>
					
			        <h5>Bottom Section</h5>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Title</label>
                        <input type="text" name="bottom_title" id="bottom_title"  class="span5" value="<?php if ($t != "") echo $t->bottom_title; ?>" />
                    </div>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Points</label>
                        <ul id="points">
                            <?php if($points){?>
                                <?php foreach($points as $point){?>
                                    <li>
                                        <input type="text" name="points[]" class="span5" value="<?php echo $point; ?>" />
                                        <button type="button" class="btn btn-danger btn-remove" title="Remove">X</button>
                                    </li>
                                <?php }?>
                            <?php }?>
                        </ul>
                        <button class="btn add-point" type="button">Add Point</button>
                    </div><br>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Button Caption</label>
                        <input type="text" name="bottom_button_caption" id="bottom_button_caption"  class="span5" value="<?php if ($t != "") echo $t->bottom_button_caption; ?>" />
                    </div>
                    <hr>
                    <div style="float:left;">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary large"/>
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
<script type="text/javascript">
    $(document).ready(function() {
        var mestatus = $('#mestatus');

        $('.add-point').click(function(){
            $('#points').append(
                '<li>'+
                    '<input type="text" name="points[]" class="span5" value="" />'+
                    '<button type="button" class="btn btn-danger btn-remove" title="Remove">X</button>'+
                '</li>');
        });

        $(document).on('click','.btn-remove',function(){
            if(confirm("Are you sure to delete?")){
                $(this).parents('li').remove();
            }
        }); 

    });
</script>
