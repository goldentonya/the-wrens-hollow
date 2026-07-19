<?php
/**
 * Overrides WooCommerce's default single-product page. Laid out like an
 * Amazon book page — cover on the left, title/byline/rating with a bordered
 * "buy box" card on the right, then stacked sections below (no tabs): About
 * this book, the full description, customer reviews, related products —
 * reskinned to match the site's typography and colors.
 *
 * Book cover images reuse the static /images/covers/ assets the Shop archive
 * (archive-product.php) already uses, unless the product has its own featured
 * image set in the media library.
 */
$wh_nav_active = 'shop';
get_header();

$wh_sku_covers = array(
	'whiskey-and-secrets-signed' => 'whiskey-and-secrets.jpg',
	'whiskey-and-lies-signed'    => 'whiskey-and-lies.jpg',
	'veilfall-paperback'         => 'veilfall.jpg',
);

// Short teaser shown up top by the buy box (the full write-up lives in the
// Description tab). Keyed by SKU, same pattern as the cover map above.
$wh_sku_blurbs = array(
	'whiskey-and-secrets-signed' => 'Some secrets are worth the hangover. Fierce, funny, unforgettable contemporary romance — sharp banter, real heartbreak, and a heroine who doesn\'t back down.',
	'whiskey-and-lies-signed'    => 'Every relationship has a few secrets. Hers might be unforgivable.',
	'veilfall-paperback'         => 'She thought she was human. The fae realm knows better — the start of an unforgettable dark fae fantasy romance.',
);

while ( have_posts() ) :
	the_post();
	global $product;

	if ( ! $product instanceof WC_Product ) {
		continue;
	}

	$wh_title  = explode( ' — ', $product->get_name(), 2 )[0];
	$wh_rating = (float) $product->get_average_rating();
	$wh_count  = $product->get_review_count();
	$wh_blurb  = isset( $wh_sku_blurbs[ $product->get_sku() ] ) ? $wh_sku_blurbs[ $product->get_sku() ] : '';

	if ( $product->get_image_id() ) {
		$wh_cover_html = $product->get_image( 'large', array( 'style' => 'width:100%;height:100%;object-fit:cover;border-radius:6px;' ) );
	} else {
		$wh_cover_file = isset( $wh_sku_covers[ $product->get_sku() ] ) ? $wh_sku_covers[ $product->get_sku() ] : '';
		$wh_cover_html = $wh_cover_file
			? '<img src="' . esc_url( get_template_directory_uri() . '/images/covers/' . $wh_cover_file ) . '" alt="' . esc_attr( $wh_title . ' book cover' ) . '" style="width:100%;height:100%;object-fit:cover;border-radius:6px;">'
			: '';
	}
	?>

	<section class="sec sec--pink" style="position:relative;padding-top:104px;">
		<?php
		wh_breadcrumbs(
			array(
				array( 'label' => 'Shop', 'url' => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ),
				array( 'label' => $wh_title ),
			),
			'light'
		);
		?>
		<div class="wrap">
			<div class="product-single" id="product-<?php the_ID(); ?>">

				<div class="product-single__media wh-fade">
					<div class="ph-box"><?php echo $wh_cover_html; ?></div>
				</div>

				<div class="product-single__info wh-fade" style="--delay:.06s">
					<h1 class="product-single__title"><?php echo esc_html( $wh_title ); ?></h1>
					<p class="product-single__byline">by <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Ali Wren</a></p>

					<div class="product-single__rating">
						<?php if ( $wh_count > 0 ) : ?>
							<span class="stars" aria-hidden="true"><?php echo str_repeat( '★', (int) round( $wh_rating ) ) . str_repeat( '☆', 5 - (int) round( $wh_rating ) ); ?></span>
							<a href="#tab-reviews" class="woocommerce-review-link" rel="nofollow"><?php echo esc_html( $wh_rating ); ?> · <?php echo esc_html( $wh_count ); ?> <?php echo esc_html( 1 === (int) $wh_count ? 'rating' : 'ratings' ); ?></a>
						<?php else : ?>
							<span class="stars" aria-hidden="true">☆☆☆☆☆</span>
							<a href="#tab-reviews" class="woocommerce-review-link" rel="nofollow">Be the first to review this book</a>
						<?php endif; ?>
					</div>

					<?php if ( $product->get_short_description() ) : ?>
						<p class="book-card__tag"><?php echo wp_kses_post( $product->get_short_description() ); ?></p>
					<?php endif; ?>

					<?php if ( $wh_blurb ) : ?>
						<p class="product-single__blurb"><?php echo esc_html( $wh_blurb ); ?></p>
					<?php endif; ?>

					<div class="product-single__buybox card">
						<?php echo wp_kses_post( $product->get_price_html() ); ?>
						<?php echo wp_kses_post( wc_get_stock_html( $product ) ); ?>

						<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype="multipart/form-data">
							<?php
							woocommerce_quantity_input(
								array(
									'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
									'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
									'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // phpcs:ignore
								)
							);
							?>
							<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt btn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
						</form>

						<p class="product-single__meta">SKU: <?php echo esc_html( $product->get_sku() ? $product->get_sku() : '—' ); ?></p>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="sec sec--cream sec--dashed-top">
		<div class="wrap product-single__tabs">
			<?php woocommerce_output_product_data_tabs(); ?>
		</div>
	</section>

	<?php if ( wc_get_related_products( $product->get_id(), 3 ) ) : ?>
	<section class="sec sec--dashed-top">
		<div class="wrap">
			<?php woocommerce_output_related_products(); ?>
		</div>
	</section>
	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
