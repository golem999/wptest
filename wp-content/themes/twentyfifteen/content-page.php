<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>





<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		twentyfifteen_post_thumbnail();
	?>


    <?php the_content(); ?>




</article><!-- #post-## -->
