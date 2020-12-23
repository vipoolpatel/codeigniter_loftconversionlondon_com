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

            <h4>Add CONTENT PAGE</h4>

            <div class="addNewContents">

                <form method="post" name="frmEditContent" id="frmEditContent" action="">



                    <div  class="addnewpagetitletxtbox margintop10">
                         <label>Title</label>
                        <input type="text" name="title" id="title" style="width: 70%;" value="" />
                    </div>

                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Sub title</label>
                        <input type="text" name="sub_title" style="width: 70%;" value="" />
                    </div>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Main title 1</label>
                        <input type="text" name="main_title_1" style="width: 70%;" value="" />
                    </div>
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Main title 2 </label>
                        <input type="text" name="main_title_2" style="width: 70%;" value="" />
                    </div>
                    
                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Page SEO</label>
                        <input type="text" required="" name="page_seo" style="width: 70%;" value="" />
                    </div>

                    <div class="seperator"></div>

                    <div class="paddingleft15">
                        <textarea name="txtPageDes" id="txtPageDes"></textarea>
                        <?php echo $this->ckeditor->replace("txtPageDes"); ?>
                        <div id="display_error"></div>

                    </div>
                    
                    <div class="paddingleft15">
                        <textarea name="more_info" id="more_info"></textarea>
                        <?php echo $this->ckeditor->replace("more_info"); ?>
                        <div id="display_error"></div>

                    </div>

                    <div  class="addnewpagetitletxtbox margintop10">
                        <label>Google Map URL</label>
                        <input type="text" name="google_map_url" style="width: 70%;">
                    </div>

                    <div class="seo_packs">

                        <h5 class="mt20">SEO TAGS (optional)</h5>

                        <ul>
                            <li><h6>TITLE </h6>
                                <textarea name="meta_title" id="meta_title"></textarea>
                            </li>
                            <li>
                                <h6>DESCRIPTION</h6>
                                <textarea name="meta_desc" id="meta_desc"></textarea>
                            </li>
                            <li>
                                <h6>PAGE KEYWORDS</h6>
                                <textarea name="meta_tags" id="meta_tags"></textarea>
                            </li>
                            <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                <input type="checkbox" name="page_status"  id="page_status"  />
                                <h6>PAGE IS VISIBLE AND DISPLAYS LIVE</h6> </label>
                            </li>
                            <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                <input type="checkbox" name="on_footer"  />
                                <h6 style="text-transform: uppercase;">Page Display in footer</h6> </label>
                            </li>
                            
                            <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                <input type="checkbox" name="gallery"  />
                                <h6 style="text-transform: uppercase;">Gallery</h6> </label>
                            </li>
                            
                            <li>
                                <label class="chkBOx margintopbot10 checkbox">
                                <input type="checkbox" name="on_contact"  />
                                <h6 style="text-transform: uppercase;">Contact Button</h6> </label>
                            </li>
                        </ul>
                    </div>

                    <div class="seperator"></div>

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