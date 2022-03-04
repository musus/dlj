<?php
/**
 * RSS2 Feed Template for displaying RSS2 Posts feed.
 *
 * @package WordPress
 */

header( 'Content-Type: application/rss+xml; charset=' . get_option( 'blog_charset' ), true );
$more              = 1;
$adfd_display_name = "Doctors Lab Japan";
$blog_charset      = esc_html( get_option( 'blog_charset' ) );

/**
 * Fires between the xml and rss tags in a feed.
 *
 * @param string $context Type of feed. Possible values include 'rss2', 'rss2-comments',
 *                        'rdf', 'atom', and 'atom-comments'.
 *
 * @since 4.0.0
 *
 */
do_action( 'rss_tag_pre', 'rss2' );
?>
<rss version="2.0">
    <channel>
        <title><?php echo $adfd_display_name; ?></title>
        <link><?php bloginfo_rss( 'url' ) ?></link>
        <description><?php bloginfo_rss( "description" ) ?></description>
        <pubDate><?php echo esc_html( mysql2date( 'D, d M Y H:i:s +0900', get_post_time( 'Y-m-d H:i:s', false ), false ) ); ?></pubDate>
        <language>ja</language>
        <copyright><?php echo $adfd_display_name; ?></copyright>

		<?php
		/**
		 * Fires at the end of the RSS2 Feed Header.
		 *
		 * @since 2.0.0
		 */
		do_action( 'rss2_head' );
		
		while ( have_posts() ) : the_post();
			require plugin_dir_path( __FILE__ ) . 'parts/loop-mamatenna.php';
		endwhile;
		?>
    </channel>
</rss>
