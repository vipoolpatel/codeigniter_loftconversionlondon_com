<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml">

    <head>

        <?php echo $this->load->view("admin/boxes/head_element") ?>

    </head>

    <body>

        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>


        <section class="section-wrapper row-fluid welcome-page">
            <h1 class="span12 aligncenter">WELCOME</h1>
        </section>




        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>

    </body>

</html>