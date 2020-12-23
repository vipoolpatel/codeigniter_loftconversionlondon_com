<!DOCTYPE html>

<html lang="en">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>

        <script type= "text/javascript">

            $(document).ready(function() {

                $('#meta_desc').NobleCount('#count_left', {
                    max_chars: 160,
                    block_negative: true



                });

                $('#meta_title').NobleCount('#count_left1', {
                    max_chars: 160,
                    block_negative: true



                });

            });

        </script>

    </head>

    <body>

        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>



        <div class="row-fluid white-card extra-padding mt20">

            <div class="addNewContents">

                <h4>GENERIC SEO TAGS (optional)</h4>

                <form method="post" action="" class="form-horizontal mt20">

                    <div class="seo_packs">

                        <div class="control-group">
                            <label class="control-label">TITLE</label>
                            <div class="controls">

                                <textarea name="meta_title" id="meta_title" class="span7"><?php echo $details['meta_title']; ?></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">DESCRIPTION</label>
                            <div class="controls">
                                <textarea name="meta_desc" id="meta_desc" class="span7"><?php echo $details['meta_desc']; ?></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">PAGE KEYWORDS</label>
                            <div class="controls">
                                <textarea name="meta_tags" id="meta_tags" class="span7"><?php echo $details['meta_keywords']; ?></textarea>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                                <input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary" />
                            </div>
                        </div>
                    </div>

                </form>

                <?php
                if (isset($message)) {
                    ?>

                    <div class="<?php echo $message != '' ? 'messagesuccess' : '' ?>"><?php echo $message; ?></div>

                <?php }
                ?>

            </div>

        </div>

        <!--righbody--> 

        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>

    </body>

</html>