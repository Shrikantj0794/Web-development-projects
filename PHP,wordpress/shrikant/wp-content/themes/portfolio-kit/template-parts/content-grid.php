<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portfolio Kit
 */
$portfolio_kit_categories = get_the_category();
if ($portfolio_kit_categories) {
	$portfolio_kit_category = $portfolio_kit_categories[mt_rand(0, count($portfolio_kit_categories) - 1)];
} else {
	$portfolio_kit_category = '';
}
?>
<div class="col-lg-4 mb-4">
	<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-kit-list-item'); ?>>
		<div class="grid-blog-item">

			<div class="grid-img <?php if (!has_post_thumbnail()) : ?>no-img<?php endif; ?>">
				<a class="pkg-iconlink" href="<?php the_permalink(); ?>">
					<?php if (has_post_thumbnail()) : ?>
						<?php the_post_thumbnail(); ?>
					<?php endif; ?>
					<i class="fas fa-arrow-right"></i>
				</a>
				<?php if (!has_post_thumbnail()) : ?>
					<?php portfolio_kit_empty_img(); ?>
				<?php endif; ?>
				<?php if ('post' === get_post_type() && !empty($portfolio_kit_category)) : ?>
					<div class="grid-cat">
						<a class="blog-categrory" href="<?php echo esc_url(get_category_link($portfolio_kit_category)); ?>"><?php echo esc_html($portfolio_kit_category->name); ?></a>
					</div>

			</div>
		<?php endif; ?>
		<div class="grid-deatls p-3">

			<?php the_title('<h2 class="entry-title grid-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
			<div class="grid-date">
				<p><?php echo esc_html(get_the_date('M j, Y')); ?></p>
			</div>
		</div>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>