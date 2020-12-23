<header id='header'>
    <div class='navbar navbar-fixed-top'>
        <div class='navbar-inner'>
            <div class='container'>
                <a class='btn btn-navbar' data-target='.nav-collapse' data-toggle='collapse'>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </a>
                <a href="<?php echo site_url('admin'); ?>" class="brand"><img src="<?php echo site_url(); ?>images/main-logo.png" style="width:50px;"/></a>
                <div class='nav-collapse subnav-collapse collapse pull-right' id='top-navigation'>
                    <ul class='nav'>
                        <li class='<?php echo $this->uri->segment(2) == 'content' && $this->uri->segment(3) != 'generic_seo' ? "active" : "" ?>'>
                            <a href="<?php echo base_url() ?>admin/content">Content</a>
                        </li>

                        <li class='<?php echo $this->uri->segment(2) == 'upload_image' ? "active" : "" ?>'>
                            <a href="<?php echo base_url() ?>admin/upload_image">Upload Image</a>
                        </li>
                        
                        
  
                        
                        
                        <li class='dropdown <?php echo $this->uri->segment(2) == 'seo' ? "active" : "" ?>'>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">SEO <i class="icon-chevron-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url() ?>admin/seo/generic_seo">Generic SEO</a></li>
                                    <li><a href="<?php echo base_url() ?>admin/seo">All SEO</a></li>
                                </ul>
                        </li>

                        <li class='<?php echo $this->uri->segment(2) == 'blog' ? "active" : "" ?>'>
                            <a href="<?php echo base_url() ?>admin/blog">Blog</a>
                        </li>
                        
                        <li class='<?php echo $this->uri->segment(2) == 'gallery' ? "active" : "" ?>'>
                            <a href="<?php echo base_url() ?>admin/gallery">Gallery</a>
                        </li>
                        
                        <li class='<?php echo $this->uri->segment(2) == 'testimonial' ? "active" : "" ?>'>
                            <a href="<?php echo base_url() ?>admin/testimonial">Testimonials</a>
                        </li>
                        
                        <li class='<?php echo $this->uri->segment(2) == 'settings' ? "active" : "" ?> '>
                            <a href="<?php echo base_url() ?>admin/settings">Email Lists</a>
                        </li>                        
                        <li class='dropdown <?php echo $this->uri->segment(2) == 'blog' ? "active" : "" ?>'>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home <i class="icon-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() ?>admin/package">Package</a></li>	
                                <li><a href="<?php echo base_url() ?>admin/home/section">Home Sections</a></li>
                                <li><a href="<?php echo base_url() ?>admin/loft_conversions">Type Loft Conversions</a></li>	
                                <li><a href="<?php echo base_url() ?>admin/services">Services</a></li>	
                                <li><a href="<?php echo base_url() ?>admin/results">Home Results</a></li>	
                                <li><a href="<?php echo base_url() ?>admin/home-features">Home Features</a></li>	
                                <li><a href="<?php echo base_url() ?>admin/home_sidebar">Home Sidebar</a></li>
                                <li><a href="<?php echo base_url() ?>admin/footer_logo">Footer Logo</a></li>

                            </ul>
                        </li>
                        
                       
                        <li>
                            <a href="<?php echo site_url('admin/home/logout'); ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</header>
<div class="container">