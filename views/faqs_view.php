<?php
//Location: app/views/faqs_view.php
$this->load->view('includes/header_view');
?>

<section class='section-wrapper about-page-w'>
    <div class='container'>
        <h1 class='section-main-header'>FREQUENTLY ASKED QUESTIONS</h1>
        <?php
        if (!empty($faqs)) {
            foreach ($faqs as $faq) {
                ?><div class='row row-separated'>
                    <div class='span12'>
                        <h4><?php echo $faq->question; ?></h4>
                        <div class="section-paragraph"><p><?php echo $faq->answer; ?></p></div>
                    </div>
                </div>
                <?php
            }
        }
        else
            echo "Currently, there are no FAQS!";
        ?>
    </div>
</section>



<?php $this->load->view('includes/footer_view'); ?>



