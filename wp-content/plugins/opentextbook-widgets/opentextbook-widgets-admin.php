<?php
if($_POST['opentextbook_pageexcerpt_hidden'] == 'Y') {
    $opentextbook_pageexcerpt_page_id = $_POST['opentextbook_pageexcerpt_page_id'];
    update_option('opentextbook_pageexcerpt_page_id', $opentextbook_pageexcerpt_page_id);
} else {
    $opentextbook_pageexcerpt_page_id = get_option('opentextbook_pageexcerpt_page_id');
}
?>

<div class="wrap">
		<input type="hidden" name="opentextbook_pageexcerpt_hidden" value="Y">
		<?php echo "<h4>" . __( 'Page Excerpt Widget Options', 'opentextbook' ) . "</h4>"; ?>
		<p>
			<?php _e("Page to display: " ); ?>
			<select name="opentextbook_pageexcerpt_page_id">
				<?php
					$pages = get_pages();
					foreach ($pages as $page){
					    if ($page->ID == $opentextbook_pageexcerpt_page_id){
							$selected = 'selected="selected"';
						}
						else {
							$selected='';
						}
						echo '<option value="'.$page->ID.'"'.$selected.'>'.$page->post_title.'</option>';
					};
				?>
			</select>
		</p>
</div>
