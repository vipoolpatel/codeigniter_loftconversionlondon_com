<?php if($recent_posts = $this->common_lib->get_5_recent_posts()):?>
	<div class="recent">
		<h2>Recent Blogs</h2>
		<ul>
			<?php foreach($recent_posts as $post):?>

				<li><a href="<?php echo base_url("marketing/".$post->page_seo);?>"><?php echo $post->title;?></a></li>

			<?php endforeach;?>
		</ul>
	</div>
<?php endif;?>
        <div class="recent">
		<h2>Categories</h2>
                <?php
                $category = $this->db->get('tbl_category')->result();
                ?>
		<ul>
			<?php foreach($category as $categoryvalue):?>

                    <li><a style="text-transform: capitalize;" href="<?php echo base_url("marketing/category/".$categoryvalue->category_slug);?>"><?php echo $categoryvalue->category_name;?></a></li>

			<?php endforeach;?>
		</ul>
	</div>





<?php /* if($lists = $this->common_lib->get_archive_lists()):?>
	<div class="archive">
		<h2>Archives</h2>
		<select name="archive" onclick="if(this.value != ''){window.location.href = this.value;}" class="">
			<option value="">Select Archive</option>
		<?php foreach($lists as $list):?>
			<option value="<?php echo base_url("archives/".$list->yr."/".$list->mth);?>">
				<?php echo $this->common_lib->format_date_time($list->yr."-".$list->mth."-1","F Y");?>
			</option>
		<?php endforeach;?>
		</select>
	</div>
<?php endif; */?>
