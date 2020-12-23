<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <script type="text/javascript" src="<?php echo site_url('js/jquery-ui-1.7.1.custom.min.js') ?>"></script>


    </head>

    <body>

        <?php
        $this->load->view("admin/boxes/admin_header_view");
        ?>

        <div class="row-fluid white-card extra-padding mt20">

            <h4> MANAGE PAGES</h4>

                 <!--<div class="title_top"><span class="green"><strong class="red">PAGE ORDER - </strong></span>Drag and drop the page order</div>--> 

            <span class="floatRight"><a class="btn btn-primary" style="margin-bottom: 10px;" href="<?php echo site_url('admin/content/add') ?>">Add New</a></span> 


            <?php
            if (!empty($pages)) {
                ?>

                <table id="header-navs" class="table no-margin table-striped table-bordered">



                    <?php
                    foreach ($pages as $nav) {

                        $id = $nav['id'];
                        $testimonial_study_url = site_url('admin/content/testimonial_study/' . $id);
                        $image_url = site_url('admin/content/image/' . $id);
                        $question = site_url('admin/content/question/' . $id);
                        $edit_url = site_url('admin/content/edit/' . $id);
                        $delete_url = site_url('admin/content/delete/' . $id);
                        $content_type = site_url('admin/content/content_type/' . $id);
                        ?>
                        <tr>


                            <td><?php echo strtoupper($nav['title']); ?></td>

                            <td class="span2"><a href="<?php echo $testimonial_study_url; ?>" class="edit_but btn btn-primary btn-small tuc">Testimonial Study</a>


                            <td class="span2"><a href="<?php echo $image_url; ?>" class="edit_but btn btn-primary btn-small tuc">Add Image</a></td>
                            <td class="span2"><a href="<?php echo $question; ?>" class="edit_but btn btn-primary btn-small tuc">Question</a></td>
                            <td class="span2"><a href="<?php echo $content_type; ?>" class="edit_but btn btn-primary btn-small tuc">Loft Conversion Type</a></td>    
                            <td class="span2"><a href="<?php echo $edit_url; ?>" class="edit_but btn btn-primary btn-small tuc">Edit</a></td>
                            <td class="span2"><a href="<?php echo $delete_url; ?>" class="edit_but btn btn-primary btn-small tuc">Delete</a>
                            </td>
                        </tr>

                        <?php
                        if ($id == 2 && !empty($about_pages)) {
                            ?>



                            <?php
                            foreach ($about_pages as $about) {
                                ?>

                                <li id="listitem_<?php echo $about['id']; ?>">

                                    <div class="list_1">

                                        <td><?php echo strtoupper($about['title']); ?></div>

                                    <div class="floatRight ediDelet">

                                        <a href="<?php echo site_url('admin/content/edit/' . $about['id']) ?>" class="edit_but">Edit</a>

                                    </div>

                                    <div class="clear"></div>  

                                    </div>

                                </li>

                                <?php
                            }
                            ?>

                            </ul>

                            <?php
                        }
                        ?>

                        <?php
                        if ($id == 5 && !empty($news_pages)) {
                            ?>

                            <ul id="news-list">

                                <?php
                                foreach ($news_pages as $news) {
                                    ?>

                                    <li id="listitem_<?php echo $news['id']; ?>">

                                        <div class="list_1">

                                            <div class="floatLeft leftTitle"><?php echo strtoupper($news['title']); ?></div>

                                            <div class="floatRight ediDelet">

                                                <a href="<?php echo site_url('admin/content/edit/' . $news['id']) ?>" class="edit_but">Edit</a>

                                            </div>

                                            <div class="clear"></div>  

                                        </div>

                                    </li>

                                    <?php
                                }
                                ?>

                            </ul>

                            <?php
                        }
                        ?>

                        </li>

                        <?php
                    }
                    ?>

                    </ul>

                </table>

                <div id="showmsg"></div>

                <?php
            }
            ?>



        </div>

        <?php
        $this->load->view("admin/boxes/admin_footer_view");
        ?>

    </body>

</html>