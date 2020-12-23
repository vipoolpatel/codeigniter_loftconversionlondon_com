<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
        <script type="text/javascript">
             $(document).ready(function()
            {
                $('#frmEditContent').validate({
                    rules: {
                    	page:{required:true},
                        meta_title: {required: true},
                        meta_desc: {required: true},
                        path:{required:true}
                    },
                    messages: {
                    	page:{required:'Page Name is Required.'},
                        meta_title: {required: 'Title is Required.'},
                        meta_desc: {required: 'Description is Required.'},
                        path:{required:'Path is Required.'}
                    }
                });

                //  $('#meta_desc').NobleCount('#desc_err', {
                //     max_chars: 160,
                //     block_negative: true
                // });

                // $('#meta_title').NobleCount('#title_err', {
                //     max_chars: 60,
                //     block_negative: true
                // });
                
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
        if ($tot > 0)
            $t = $seo->row();
        else
            $t = "";

        $c = "";
        
        ?>
        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card mt20 extra-padding">
            <h4><?php echo $t != "" ? "EDIT" : "ADD";?> SEO</h4>
            <div class="addNewContents">
                <form method="post" name="frmEditContent" id="frmEditContent" action="<?php if ($t != "") echo site_url('admin/seo/edit/' . $t->id); ?>">
                	<div  class="addnewpagetitletxtbox margintop10">
                		<label for="page">Page Name:</label>
                        <input type="text" name="page" id="page" value="<?php if ($t != "") echo $t->page; ?>" />
                    </div>
                    <br>
                    <div  class="addnewpagetitletxtbox margintop10">
                    	<label for="page">Meta Title:</label>
                    	<textarea name="meta_title" id="meta_title"><?php if ($t != "") echo $t->meta_title; ?></textarea>
                    	<div>You have <span id="title_err">60</span> characters left.</div>
                    </div>
                    <br>
                    <div class="paddingleft15">
                    	<label for="page">Meta Description:</label>
                        <textarea name="meta_desc" id="meta_desc"><?php if ($t != "") echo $t->meta_desc; ?></textarea>
                        <div>You have <span id="desc_err">160</span> characters left.</div>
                    </div>
					<br>
                    <div class="paddingleft15">
                    	<label for="page">Page Keywords:</label>
                        <textarea name="meta_key" id="meta_key"><?php if ($t != "") echo $t->meta_key; ?></textarea>
                        
                    </div>
                    <br>
                    <div  class="addnewpagetitletxtbox margintop10">
                    	<label for="page">Path:</label>
                        <input type="text" name="path" id="path" value="<?php if ($t != ""){ echo $t->path;} ?>" <?php if($t!=''&& $t->path=='generic'){?>readonly="readonly"<?php }?>/>
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
