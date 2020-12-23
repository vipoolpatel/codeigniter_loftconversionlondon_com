<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
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
            <h4>MANAGE BLOG</h4>

            <?php echo $this->session->flashdata('success') ? $this->session->flashdata('success') . "<br>" : ''; ?><br>
            <a href="<?php echo site_url('admin/blog/add_blog'); ?>" class="btn floatRight">ADD NEW BLOG</a>
            <a href="<?php echo site_url('admin/category'); ?>" class="btn floatRight">Category</a><br><br>
            <div class="clear"></div>
            <table id="header-navs" class="table no-margin table-striped table-bordered">
                <?php
                foreach ($blog->result() as $t) {
                    ?>
                    <tr>
                        <td>
                            <div class="floatLeft leftTitle"><?php echo strtoupper($t->title); ?></td>
                        <td>
                            <select class="form-control changeCategory" id="<?=$t->id?>" >
                                <option value="">Select Category</option>
                                <?php
                                foreach ($category as $value)
                                { 
                                    $selected = '';
                                    if($t->category_id == $value->category_id)
                                    {
                                        $selected = 'selected';
                                    }
                                    ?>
                                <option <?=$selected?> value="<?=$value->category_id?>"><?=$value->category_name?></option>
                                <?php }
                                ?>
                                
                            </select>
                            
                        </td>
                        <td width="35%">
                            <a href="<?php echo site_url('admin/blog/edit_blog/' . $t->id); ?>" class="edit_but btn btn-success">Edit</a>
                            <a href="<?php echo site_url('admin/blog/delete_blog/' . $t->id); ?>" class="del btn btn-danger" onclick="return confirm('Are You sure to delete?');">Delete</a>
                            <a href="<?php echo site_url('admin/blog/blog_comment/' . $t->id); ?>" class="btn btn-info">View Comments</a>
                        </td>

                    <tr>

                    <?php }
                    ?>
            </table>

        </div>
        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>
                            
                                   
        <script type="text/javascript">
            $('.changeCategory').change(function(){
                var value = $(this).val();
                var id = $(this).attr('id');
                    $.ajax({
                    type:'POST',
                    url:"<?=base_url()?>admin/blog/changeCategory",
                    data: {value: value,id:id},
                    dataType: 'JSON',
                    success:function(data){
                         //  alert('Category Successfully Changed');
                    }
	 });
            });
        </script>
    </body>
</html>