<!DOCTYPE html>

<html lang="en">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

        <script src="<?php echo base_url(); ?>js/jquery.validate.js"></script>



        <link rel="stylesheet" type="text/css" href="<?php echo site_url('css/button.css'); ?>" />
        <link href="<?php echo site_url('css/theme_venera2.css'); ?>" media="all" rel="stylesheet" type="text/css" /> 



        <script language="javascript">

            $(document).ready(function() {

                $('#login_form').validate();

            });

        </script>

    </head>

    <body>
        <div id="wrapper" class="row-fluid">    
            <form name="login_form" id="login_form" method="POST" action="<?php echo base_url() ?>admin/login" class="span6 offset3 white-card form-horizontal">

                <div class="admin_login">

                    <div class="loginlogo">

                        <a href="<?php echo site_url(); ?>"><img src="<?php echo site_url(); ?>/images/seo-logo-png-final.png" width="50%" alt="Pay On Result SEO"></a>

                    </div>

                    <div class="control-group">
                        <label class="control-label">User Name</label></td>
                        <div class="controls"><input class="required" type="text" name="user_name" id="user_name" value="<?php if (isset($user_name)) echo $user_name ?>" /></div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Password</label>
                        <div class="controls"><input class="required" type="password" name="user_password" id="user_password" /></div>
                    </div>
                    <?php if (isset($message)) { ?>
                        <div id="message" class="aligncenter error"><?php echo $message; ?></div>

                        </tr>

                    <?php } ?>

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="submit" class="btn big" name="btn_submit" id="btn_submit" value="Login" />
                        </div>
                    </div>


                </div>

            </form>

        </div>



    </body>

</html>