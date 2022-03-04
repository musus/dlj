<?php /*Template Name: NTTDocomoママナテxml*/ ?>
<?php header('Content-Type: text/xml; charset='.get_option('blog_charset'), true); ?>
<?php echo "<?xml version=\"1.0\" encoding=\"".get_option("blog_charset")."\" ?".">"; ?>  
<rss version="2.0">
<channel>
	<title><?php bloginfo('name'); ?></title>
	<link><?php echo home_url(); ?></link>
	<description><?php bloginfo('description'); ?></description>
	<pubDate><?php echo (new DateTime())->format('D, d M y H:i:s O'); ?></pubDate>
	<language>ja</language>	
	<cipyright></cipyright>
	<?php
		$page = max(intval($_GET["offset"] ?? 1), 1);
		$args = ["post_type" => "post", "posts_per_page" => 10, "paged" => $page]; 
		$posts = get_posts($args);
	?>
	<page><?php echo $page ?></page>
	<?php foreach($posts as $post) : setup_postdata($post); ?>
	<item> 
		<title><?php the_title(); ?></title>
		<link><?php the_permalink(); ?></link>
		<guid><?php the_ID() ?></guid>
		<category><![CDATA[ライフ]]></category>
		<description></description>
		<pubDate><?php echo get_post_time('D, d M y H:i:s O');?></pubDate>
		<modifiedDate><?php echo get_post_modified_time('D, d M y H:i:s O');?></modifiedDate>
		<encoded>
			<![CDATA[<?php 
				global $more; $more = 0; the_content('');
				// moreタグの有無で分岐
				if (get_extended( $post->post_content )['extended'] ?? false) {
					global $more; $more = 1; the_content('', true);
				}
			?>]]>
		</encoded>
		<delete>0</delete>
		<enclosure url="<?php the_post_thumbnail_url(); ?>" />
		<thumbnail url="<?php the_post_thumbnail_url(); ?>" />
		<?php
			$categories = get_the_category();
			$categoryIds = [];
			foreach($categories as $category):
				array_push( $categoryIds, $category->cat_ID);
			endforeach;
			$categoryArgs = [
				'exclude' => get_the_ID(),
				'post_type' => "post",
				'posts_per_page' => 3,
				'category' => implode(',', $categoryIds)
			];
		?>
		<?php foreach(get_posts($categoryArgs) as $cPost) : setup_postdata($cPost); ?>
			<relatedlink title="<?php echo get_the_title($cPost->ID); ?>"
						 link="<?php echo get_the_permalink($cPost->ID); ?>"
						 thumbnail="<?php echo get_the_post_thumbnail_url($cPost->ID); ?>" />
		<?php endforeach; ?>
	</item>
	<?php endforeach; ?>	
</channel>
</rss>