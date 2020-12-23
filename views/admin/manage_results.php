<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.validate.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('#frmEditContent').validate({
                    rules: {
                        title: {required: true},
                        detail: {required: true},
                        domain:{required: true}
                    },
                    messages: {
                        title: {required: 'COMPANY NAME IS REQUIRED.'},
                        detail: {required: 'DETAIL IS REQUIRED.'},
                        domain:{required: 'DOMAIN IS REQUIRED.'}
                    }
                });
                $('#frmEditContent').submit(function() {
                    var editorcontent = CKEDITOR.instances['detail'].getData().replace(/<[^>]*>/gi, '');
                    if (!editorcontent.length)
                    {
                        $('#display_error').html('<div class="error">DETAIL IS REQUIRED.</div>');
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
            <h4><?php echo $result? "EDIT" : "ADD"; ?> SEO RESULT</h4>
            <div class="addNewContents">
                <form method="post" name="frmEditContent" id="frmEditContent" action="<?php if ($result) {echo site_url('admin/results/edit_result/' . $result->id);} ?>">
                    <div class="addnewpagetitletxtbox margintop10">
                        <div class="span2"><div class="pull-right">Company Name: </div></div>
                        <div class="span9">
                            <input type="text" name="title" id="title" value="<?php if ($result != "") echo $result->title; ?>" placeholder="Company Name" />
                        </div>
                    </div>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Domain:</div></div>
                        <div class="span9">
                            <input type="text" name="domain" id="domain" value="<?php if ($result != "") echo $result->domain; ?>" placeholder="Domain" />
                        </div>
                    </div>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Keywords:</div></div>
                        <div class="span9">
                            <input type="text" name="keyword" id="keyword" value="<?php if ($result != "") echo $result->keyword; ?>" placeholder="Keywords" />
                        </div>
                    </div>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Competition:</div></div>
                        <div class="span9">
                            <input type="text" name="competition" id="competition" value="<?php if ($result != "") echo $result->competition; ?>" placeholder="Competition" />
                        </div>
                    </div>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Search Engine:</div></div>
                        <div class="span9">
                            <input type="text" name="search_engine" id="search_engine" value="<?php if ($result != "") echo $result->search_engine; ?>" placeholder="Search Engine" />
                        </div>
                    </div>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Time Scale:</div></div>
                        <div class="span9">
                            <input type="text" name="time_scale" id="time_scale" value="<?php if ($result != "") echo $result->time_scale; ?>" placeholder="Time Scale" />
                        </div>
                    </div>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Button Name:</div></div>
                        <div class="span9">
                            <input type="text" name="button_name" id="button_name" value="<?php if ($result != "") echo $result->button_name; ?>" placeholder="Button Name" />
                        </div>
                    </div>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Detail:</div></div> 
                        <div class="span9">
                            <textarea name="detail" id="detail" placeholder="Detail"><?php if ($result != "") echo $result->detail; ?></textarea>
                            <?php echo $this->ckeditor->replace("detail"); ?>
                            <div id="display_error"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
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
