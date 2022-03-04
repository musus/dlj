<?php
$content = do_shortcode( get_the_content_feed( 'rss2' ) );
?>
<item>
    <title><?php the_title_rss(); ?></title>
    <link><?php the_permalink_rss(); ?></link>
    <guid><?php the_guid(); ?></guid>
    <category><![CDATA[ライフ]]></category>
    <description>
        <![CDATA[<?php echo $content; ?>]]>
    </description>
    <pubDate><?php echo esc_html( mysql2date( 'D, d M Y H:i:s +0900', get_post_time( 'Y-m-d H:i:s', false ), false ) ); ?></pubDate>
    <modifiedDate><?php echo esc_html( mysql2date( 'D, d M Y H:i:s +0900', get_post_modified_time( 'Y-m-d H:i:s', false ), false ) ); ?></modifiedDate>
    <encoded>
        <![CDATA[<?php echo $content; ?>]]>
    </encoded>
    <delete>0</delete>
    <enclosure url="<?php the_post_thumbnail_url(); ?>"/>
    <thumbnail url="<?php the_post_thumbnail_url(); ?>"/>
	<?php
	$categories  = get_the_category();
	$categoryIds = [];
	foreach ( $categories as $category ):
		array_push( $categoryIds, $category->cat_ID );
	endforeach;
	$categoryArgs = [
		'exclude'        => get_the_ID(),
		'post_type'      => "post",
		'posts_per_page' => 3,
		'category'       => implode( ',', $categoryIds )
	];
	?>
	<?php foreach ( get_posts( $categoryArgs ) as $cPost ) : setup_postdata( $cPost ); ?>
        <relatedlink title="<?php echo get_the_title( $cPost->ID ); ?>"
                     link="<?php echo get_the_permalink( $cPost->ID ); ?>"
                     thumbnail="<?php echo get_the_post_thumbnail_url( $cPost->ID ); ?>"/>
	<?php endforeach; ?>
</item>
