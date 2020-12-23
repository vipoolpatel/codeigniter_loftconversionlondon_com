<?php
$meta_pack = $this->common_lib->get_site_meta();
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
              <title><?php
if ($this->uri->segment(1) == 'category') {
	$titledata = $this->uri->segment(1) == 'category' ? $meta_pack->meta_title : $this->common_lib->get_page_title();
} else {
	$titledata = $this->uri->segment(1) == 'marketing' ? $meta_pack->meta_title : $this->common_lib->get_page_title();
}
echo trim($titledata);
?></title>
            <meta name="description" content="<?php echo trim($meta_pack->meta_desc); ?>">
            <meta name="keywords" content="<?php echo trim($meta_pack->meta_keywords); ?>">
            <meta name="title" content="<?php echo trim($meta_pack->meta_title); ?>">
            <meta name="viewport" content="width=device-width">
            <link rel="canonical" href="<?=base_url()?><?=uri_string()?>" />
            <link href="<?php echo site_url('css/theme_venera2.css'); ?>" media="all" rel="stylesheet" type="text/css" />
            <link href="<?=base_url()?>images/logo/loftconversionlondonlogo.png" rel="icon">
            <link href="<?php echo site_url('css/googlefont.css'); ?>" media="all" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="<?=base_url()?>css/font-awesome.min.css" >
            <link href="<?php echo site_url('css/main2.css'); ?>" rel="stylesheet">
            <script src="<?php echo site_url('js/jquery.js'); ?>" type="text/javascript"></script>
            <?php if ($this->uri->segment(1) != '') {?>
            <script type="text/javascript" src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
            <?php }?>
            <script src="<?php echo site_url('js/bootstrap.js'); ?>" type="text/javascript"></script>
            <style type="text/css">
.boxzilla.boxzilla-bottom-right {
    bottom: 0;
    right: 0;
}
.boxzilla {
    position: fixed;
    z-index: 12000;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    background: #fff;
    padding: 25px;
}

.boxzilla-close-icon {
    position: absolute;
    right: 0;
    top: 0;
    text-align: center;
    padding: 6px;
    cursor: pointer;
    -webkit-appearance: none;
    font-size: 28px;
    font-weight: 700;
    line-height: 20px;
    color:
    #000;opacity: .5;
}
.boxzilla-close-icon {
    display: block !important;
}
.box-content {
    float: left;
    width: 66%;
    margin: 0 4% 30px 0;
    padding: 0;
}
.box-sidebar {
    float: left;
    width: 30%;
}
.box-content, .box-sidebar {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

   @media (max-width:767px) {
      #contact-project-form input {
        width:94% !important;
      }
      
      #contact-project-form select {
        width:100% !important;
      }
   }

            </style>
    </head>
    <body>
        <header id='header'>
            <div class='navbar navbar-fixed-top'>
                <div class='navbar-inner'>
                    <div class='container'>
                        <a class='btn btn-navbar' data-target='.nav-collapse' data-toggle='collapse'>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                        </a>
                        <a href="<?php echo site_url(); ?>" class="brand"><img style="height: 61px;" src="<?php echo site_url(); ?>images/logo/loftconversionlondonlogo.png" alt="loft conversion"></a>
                        <div class='nav-collapse subnav-collapse collapse pull-right' id='top-navigation'>
                            <ul class='nav'>
                                <li class='<?php if ($this->uri->segment(1) == "") {?>active<?php }?>'>
                                    <a href="<?php echo site_url(''); ?>">Home</a>
                                </li>

                                <li class="dropdown <?php if ($this->uri->segment(1) == "dormer-loft-conversion" || $this->uri->segment(1) == "hip-to-gable-loft-conversions" || $this->uri->segment(1) == "mansard-loft-conversion" || $this->uri->segment(1) == "velux-loft-conversion" || $this->uri->segment(1) == "l-shaped-dormer-loft-conversion") {?>active<?php }?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Types of Loft Conversion</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?=base_url()?>dormer-loft-conversion">Dormer Loft Conversion</a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url()?>hip-to-gable-loft-conversions">Hip to Gable Loft Conversion</a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url()?>mansard-loft-conversion">Mansard Loft Conversion</a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url()?>velux-loft-conversion">Velux Loft Conversion</a>
                                        </li>
                                         <li>
                                            <a href="<?=base_url()?>l-shaped-dormer-loft-conversion">L Shaped Loft Conversion</a>
                                        </li>
                                    </ul>
                                </li>


                                <li class='<?php if ($this->uri->segment(1) == "loft-conversion-gallery") {?>active<?php }?>'>
                                    <a href="<?php echo site_url('loft-conversion-gallery'); ?>">Gallery</a>
                                </li>

                                <li class='<?php if ($this->uri->segment(1) == "about-us") {?>active<?php }?>'>
                                    <a href="<?php echo site_url('about-us'); ?>">Our Process</a>
                                </li>

                                <li class='<?php if ($this->uri->segment(1) == "marketing") {?>active<?php }?>'>
                                    <a href="<?php echo site_url('marketing'); ?>">Blog</a>
                                </li>
                                

                                <li class='<?php if ($this->uri->segment(1) == "work-with-us") {?>active<?php }?>'>
                                    <a href="<?php echo site_url('work-with-us'); ?>">Work With Us</a>
                                </li>

                                <li><a href="<?php echo site_url('contact-us'); ?>">Contact</a></li>
                            </ul>
                            <div class='top-account-control visible-desktop'>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
