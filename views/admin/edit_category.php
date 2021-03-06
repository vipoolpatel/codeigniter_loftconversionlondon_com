<?php $this->load->library('common_lib'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->load->view("admin/boxes/head_element") ?>
        <link href="<?php echo base_url()."js/taginput/bootstrap-tagsinput.css";?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()."js/taginput/app.css";?>" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="<?php echo site_url("js/ajaxupload.3.6.js") ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('js/jquery.noble.min.js') ?>"></script>
        
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
            <h4>Edit Category</h4>
            <div class=" ">
                <form method="post"  action="">
                        <div class="seo_packs">
                        <ul>
                            <li><h6>Category Name </h6>
                                <input class="form-control" name="category_name" required="" value="<?=$category->category_name?>" type="text" style="width: 500px;">
                                <input  name="id"  value="<?=$category->category_id?>" type="hidden" >
                            </li>
                            
                            <li><h6>Category Page URL </h6>
                                <input class="form-control" name="category_slug" required type="text" value="<?=$category->category_slug?>" style="width: 500px;">
                            </li>
                            
                        
                            
                        </ul>
                    
                        </div>
                    <div class="clearfix"></div>
                    <div class="seo_packs">
                        <h5 class="mt20">SEO TAGS (optional)</h5>
                        <ul>
                            <li><h6>TITLE </h6>
                                <textarea name="meta_title" id="meta_title"><?=$category->meta_title?></textarea>
                            </li>
                            <li>
                                <h6>DESCRIPTION</h6>
                                <textarea name="meta_desc" id="meta_desc"><?=$category->meta_desc?></textarea>
                            </li>
                            
                            <li>
                                <h6>PAGE KEYWORDS</h6>
                                <textarea name="meta_keywords" id="meta_tags"><?=$category->meta_keywords?></textarea>
                            </li>
                        </ul>
                    </div>
                    <div class="seperator"></div>
                    <div style="float:right;">
                        <input type="submit" name="submit" value="Update" class="btn primary large"/>
                    </div>
                    <div class="clear"></div>
                </form>
        
            </div>
        </div>
<?php
$this->load->view("admin/boxes/admin_footer_view");
?>
<script type="text/javascript" src="<?php echo base_url()."js/taginput/bootstrap-tagsinput.js";?>"></script>
<script type="text/javascript" src="<?php echo base_url()."js/typeahead.bundle.js";?>"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var tagsengine = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
              url: '<?php echo base_url()."admin/blog/get_tags";?>',
              filter: function(list) {
                return $.map(list, function(tags) {
                  return { name: tags }; });
              }
            }
        });
        tagsengine.clearPrefetchCache();
        tagsengine.initialize();

        $('#tags').tagsinput({
            typeaheadjs: {
                name: 'tags',
                displayKey: 'name',
                valueKey: 'name',
                source: tagsengine.ttAdapter()
            }
        });
        var mestatus = $('#mestatus');

        new AjaxUpload("#picture", {
            action: "<?php echo site_url('admin/blog/upload_photo'); ?>",
            name: 'image',
            enctype: 'multipart/form-data',
            onSubmit: function(file, ext) {
                $('#show_image').empty();
                $('#show_image').html('<img src="<?php echo base_url() . "images/big-ajax-loader.gif"; ?>">');

                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                    // extension is not allowed
                    mestatus.text('Only JPG, PNG or GIF files are allowed');
                    return false;
                }
                //mestatus.html('loading...');
                //$("#picture_button").text("Uploading");
                //this.disable();
            },
            onComplete: function(file, response) {


                //alert(response);
                //alert(response);
                //mestatus.html(response);
                //Add uploaded file to list
                var response = eval('(' + response + ')');

                if (response.status == "success") {

                    //var file=res[1].split(" ");""
                    mestatus.html("");
                    var img = "<span  id='preview'><div class='upload'><img   src='" + response.path + "/" + response.thumb + "'></div><span>";
                    //var img_field = "<input type='hidden' name='picture' value='" + response.thumb + "'>";
                    $('#show_image').html(img);
                    $('#pic').val(response.thumb);
                    //$("#preview_"+id).attr('src',response.path+"/"+response.thumb);
                    //$("#picture_"+id).val(response.thumb);
                } else {
                    mestatus.html(response.error);
                }


                this.enable();
            }

        });

    });
</script>
 </body>
</html>
