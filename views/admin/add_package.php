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
                        name: {required: true},
                        description: {required: true},
                        short_description:{required: true}
                    },
                    messages: {
                        name: {required: 'NAME IS REQUIRED.'},
                        description: {required: 'DESCRIPTION IS REQUIRED.'},
                        short_description:{required: 'SHORT DESCRIPTION IS REQUIRED.'}
                    }
                });

                $('#frmEditContent').submit(function() {
                    var editorcontent = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '');
                    if (!editorcontent.length)
                    {
                        $('#display_error').html('<div class="error">DESCRIPTION IS REQUIRED.</div>');
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
            <h4><?php echo $package? "EDIT" : "ADD"; ?> PACKAGE</h4>
            <div class="addNewContents">
                <form method="post" name="frmEditContent" id="frmEditContent" enctype="multipart/form-data" action="<?php if ($package) {echo site_url('admin/package/edit_package/' . $package->id);} ?>">
                    <div class="addnewpagetitletxtbox margintop10">
                        <div class="span2"><div class="pull-right">Name: </div></div>
                        <div class="span9">
                            <input type="text" name="name" id="name" value="<?php if ($package != "") echo $package->name; ?>" placeholder="Name" />
                            <br><small>Name of the package</small>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Image:</div></div>
                        <div class="span9">
                            <input type="file" name="image"><br>
                            
                            <?php
                            if(!empty($package->image))
                            { ?>
                            <img style="height: 100px;" src="<?=base_url()?>images/package/<?=$package->image?>">  
                            <?php }
                            ?>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Price:</div></div>
                        <div class="span9">
                            <textarea name="price_text" id="price_text" placeholder=" <p>Only &pound;32 Per Day</p><p>Only &pound;12,000 Per Year</p>"><?php if ($package != "") echo $package->price_text; ?></textarea>
                            <br>
                            <!--<small>Description shown in other pages.</small>-->
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Description:</div></div>
                        <div class="span9">
                            <textarea name="short_description" id="short_description" placeholder="Description"><?php if ($package != "") echo $package->short_description; ?></textarea>
                            <br>
                            <!--<small>Description shown in other pages.</small>-->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">More Description:</div></div> 
                        <div class="span9">
                            <textarea name="description" id="description" placeholder="Description"><?php if ($package != "") echo $package->description; ?></textarea>
                            <div id="display_error"></div>
                            <!--<small>Description shown in monthly seo package page.</small>-->
                            <?php echo $this->ckeditor->replace("description"); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="paddingleft15">
                        <div class="span2"><div class="pull-right">Extra Description:</div></div> 
                        <div class="span9">
                            <textarea name="extra_description" id="extra_description" placeholder="Description"><?php if ($package != "") echo $package->extra_description; ?></textarea>
                            <div id="extra_description"></div>
                            <?php echo $this->ckeditor->replace("extra_description"); ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
<!--                    <hr>
                    <div class="addnewpagetitletxtbox margintop10">
                        <div class="span2"><div class="pull-right">Rating:</div></div>
                        <div class="span9">
                            <select name="rate">
                                <option value="" <?php echo $package&&$package->rate==""?"selected='selected'":"";?>>Select Rating</option>
                                <option value="1" <?php echo $package&&$package->rate==1?"selected='selected'":"";?>>1</option>
                                <option value="2" <?php echo $package&&$package->rate==2?"selected='selected'":"";?>>2</option>
                                <option value="3" <?php echo $package&&$package->rate==3?"selected='selected'":"";?>>3</option>
                                <option value="4" <?php echo $package&&$package->rate==4?"selected='selected'":"";?>>4</option>
                            </select>
                        </div>
                    </div>-->
                    <br>
                    
                    <div class="clearfix"></div>
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
