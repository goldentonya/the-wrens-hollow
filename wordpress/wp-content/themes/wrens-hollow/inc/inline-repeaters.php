<?php
/**
 * Hand-built "add row / remove row" lists that live directly on the page that
 * displays them, instead of a separate CPT menu — for content that is only
 * ever shown on ONE page (About's Facts + Journey timeline; the Whiskey Tango
 * Foxtrot page's Team roster). This is the free-WordPress substitute for ACF
 * Pro's Repeater field: no plugin, just a meta box with plain HTML rows, a
 * <template> to clone for new rows, and a save handler that reads the
 * resulting arrays off $_POST into that page's own postmeta.
 *
 * Content shown on MULTIPLE pages (Events, Reviews, Books, Writing) is
 * deliberately NOT handled this way — it stays in its own CPT menu so the
 * same item can be reused/edited once instead of duplicated per page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Postmeta key + row-shape config for each inline repeater, keyed by an
 * internal id used throughout this file (row field names are
 * "wh_repeater_{id}_{field}[]").
 */
function wrens_hollow_inline_repeaters_config() {
	return array(
		'facts'      => array(
			'template'      => 'page-about.php',
			'skip_metabox'  => true, // rendered as a tab inside inc/about-page-editor.php instead
			'meta_key'      => 'about_facts',
			'row_label'     => 'fact',
			'intro_fields'  => array(
				'facts_heading' => array( 'type' => 'text', 'label' => 'Section heading', 'default' => 'A few things about me' ),
			),
			'fields'        => array(
				'icon' => array( 'type' => 'text', 'label' => 'Icon', 'width' => '70px', 'placeholder' => '📍' ),
				'text' => array( 'type' => 'text', 'label' => 'Text', 'width' => '', 'placeholder' => 'Based in Minnesota' ),
			),
		),
		'milestones' => array(
			'template'      => 'page-about.php',
			'skip_metabox'  => true, // rendered as a tab inside inc/about-page-editor.php instead
			'meta_key'      => 'about_milestones',
			'row_label'     => 'milestone',
			'intro_fields'  => array(
				'journey_eyebrow' => array( 'type' => 'text', 'label' => 'Eyebrow', 'default' => 'My Journey' ),
				'journey_heading' => array( 'type' => 'text', 'label' => 'Heading', 'default' => 'The Road So Far' ),
			),
			'fields'        => array(
				'date' => array( 'type' => 'text', 'label' => 'Date', 'width' => '160px', 'placeholder' => 'May 2024' ),
				'body' => array( 'type' => 'textarea', 'label' => 'Description', 'width' => '', 'placeholder' => 'What happened. Basic HTML like <strong>bold</strong> is allowed.' ),
			),
		),
		'team'       => array(
			'template'  => 'page-whiskey-tango-foxtrot.php',
			'title'     => 'Meet the Team roster',
			'meta_key'  => 'wtf_team',
			'row_label' => 'team member',
			'fields'    => array(
				'image' => array( 'type' => 'image', 'label' => 'Badge' ),
				'name'  => array( 'type' => 'text', 'label' => 'Name & callsign', 'width' => '', 'placeholder' => 'Wade "Wraith" Blakely' ),
				'desc'  => array( 'type' => 'textarea', 'label' => 'Description', 'width' => '' ),
			),
		),
	);
}

/**
 * Registers a plain meta box per repeater, except any marked 'skip_metabox'
 * (Facts/Journey — those render as tabs inside the About page's own unified
 * editor, see inc/about-page-editor.php, but still save through the shared
 * handler below since their 'template' still matches).
 */
function wrens_hollow_register_inline_repeater_metaboxes( $post ) {
	$template = get_page_template_slug( $post );
	foreach ( wrens_hollow_inline_repeaters_config() as $id => $cfg ) {
		if ( $cfg['template'] !== $template || ! empty( $cfg['skip_metabox'] ) ) {
			continue;
		}
		add_meta_box(
			'wh_repeater_' . $id,
			$cfg['title'],
			function ( $post ) use ( $id, $cfg ) {
				wp_nonce_field( 'wh_save_repeaters', 'wh_repeaters_nonce' );
				wrens_hollow_render_inline_repeater( $id, $cfg, $post );
			},
			'page',
			'normal',
			'default'
		);
	}
}
add_action( 'add_meta_boxes_page', 'wrens_hollow_register_inline_repeater_metaboxes' );

function wrens_hollow_render_inline_repeater( $id, $cfg, $post ) {
	$rows = get_post_meta( $post->ID, $cfg['meta_key'], true );
	if ( ! is_array( $rows ) ) {
		$rows = array();
	}
	?>
	<input type="hidden" name="<?php echo esc_attr( 'wh_repeater_present_' . $id ); ?>" value="1">
	<?php if ( ! empty( $cfg['intro_fields'] ) ) : ?>
	  <div class="wh-repeater__intro">
	    <?php foreach ( $cfg['intro_fields'] as $meta_key => $field ) :
	      $value = get_post_meta( $post->ID, $meta_key, true );
	      if ( '' === $value ) {
	        $value = isset( $field['default'] ) ? $field['default'] : '';
	      }
	      ?>
	      <p class="wh-repeater__intro-field">
	        <label class="wh-repeater__field-label"><?php echo esc_html( $field['label'] ); ?></label><br>
	        <input type="text" class="widefat" name="<?php echo esc_attr( 'wh_intro_' . $meta_key ); ?>" value="<?php echo esc_attr( $value ); ?>">
	      </p>
	    <?php endforeach; ?>
	  </div>
	  <hr>
	<?php endif; ?>
	<div class="wh-repeater" data-repeater="<?php echo esc_attr( $id ); ?>">
	  <div class="wh-repeater__rows">
	    <?php foreach ( $rows as $row ) : ?>
	      <?php wrens_hollow_render_inline_repeater_row( $id, $cfg, $row ); ?>
	    <?php endforeach; ?>
	  </div>
	  <p><button type="button" class="button wh-repeater__add">+ Add <?php echo esc_html( $cfg['row_label'] ); ?></button></p>
	  <template class="wh-repeater__template">
	    <?php wrens_hollow_render_inline_repeater_row( $id, $cfg, array() ); ?>
	  </template>
	</div>
	<?php
}

function wrens_hollow_render_inline_repeater_row( $id, $cfg, $row ) {
	?>
	<div class="wh-repeater__row">
	  <div class="wh-repeater__row-fields">
	    <?php foreach ( $cfg['fields'] as $field_key => $field ) :
	      $name  = 'wh_repeater_' . $id . '_' . $field_key . '[]';
	      $value = isset( $row[ $field_key ] ) ? $row[ $field_key ] : '';
	      ?>
	      <div class="wh-repeater__field wh-repeater__field--<?php echo esc_attr( $field['type'] ); ?>">
	        <?php if ( ! empty( $field['label'] ) ) : ?>
	          <label class="wh-repeater__field-label"><?php echo esc_html( $field['label'] ); ?></label>
	        <?php endif; ?>
	        <?php if ( 'textarea' === $field['type'] ) : ?>
	          <textarea name="<?php echo esc_attr( $name ); ?>" rows="3" class="widefat" placeholder="<?php echo esc_attr( isset( $field['placeholder'] ) ? $field['placeholder'] : '' ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
	        <?php elseif ( 'image' === $field['type'] ) :
	          $img_url = $value ? wp_get_attachment_image_url( (int) $value, 'thumbnail' ) : '';
	          ?>
	          <div class="wh-repeater__image">
	            <img class="wh-repeater__image-preview" src="<?php echo esc_url( $img_url ); ?>" style="<?php echo $img_url ? '' : 'display:none;'; ?>width:70px;height:70px;object-fit:cover;border-radius:4px;">
	            <input type="hidden" class="wh-repeater__image-input" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
	            <br>
	            <button type="button" class="button wh-repeater__choose-image">Choose image</button>
	          </div>
	        <?php else : ?>
	          <input type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" placeholder="<?php echo esc_attr( isset( $field['placeholder'] ) ? $field['placeholder'] : '' ); ?>" <?php echo ! empty( $field['width'] ) ? 'style="width:' . esc_attr( $field['width'] ) . ';"' : 'class="widefat"'; ?>>
	        <?php endif; ?>
	      </div>
	    <?php endforeach; ?>
	  </div>
	  <div class="wh-repeater__row-actions">
	    <button type="button" class="button wh-repeater__move-up" title="Move up">▲</button>
	    <button type="button" class="button wh-repeater__move-down" title="Move down">▼</button>
	    <button type="button" class="button wh-repeater__remove" title="Remove">Remove</button>
	  </div>
	</div>
	<?php
}

function wrens_hollow_save_inline_repeaters( $post_id ) {
	if ( ! isset( $_POST['wh_repeaters_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['wh_repeaters_nonce'] ), 'wh_save_repeaters' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	$template = get_page_template_slug( $post_id );

	foreach ( wrens_hollow_inline_repeaters_config() as $id => $cfg ) {
		if ( $cfg['template'] !== $template ) {
			continue;
		}
		// Safety net: this repeater's own hidden marker (rendered inside its
		// meta box) must be present, or we skip it entirely rather than risk
		// writing an empty array over real data — e.g. if a tab pane's inputs
		// were somehow left out of the submission for any reason, the OTHER
		// repeater on this same page must not get wiped out as a side effect.
		if ( ! isset( $_POST[ 'wh_repeater_present_' . $id ] ) ) {
			continue;
		}

		$field_keys  = array_keys( $cfg['fields'] );
		$columns     = array();
		$row_count   = 0;
		foreach ( $field_keys as $field_key ) {
			$post_key         = 'wh_repeater_' . $id . '_' . $field_key;
			$raw              = isset( $_POST[ $post_key ] ) ? (array) wp_unslash( $_POST[ $post_key ] ) : array();
			$columns[ $field_key ] = $raw;
			$row_count        = max( $row_count, count( $raw ) );
		}

		$rows = array();
		for ( $i = 0; $i < $row_count; $i++ ) {
			$row      = array();
			$has_data = false;
			foreach ( $cfg['fields'] as $field_key => $field ) {
				$raw_value = isset( $columns[ $field_key ][ $i ] ) ? $columns[ $field_key ][ $i ] : '';
				if ( 'textarea' === $field['type'] ) {
					$value = wp_kses_post( $raw_value );
				} elseif ( 'image' === $field['type'] ) {
					$value = absint( $raw_value );
				} else {
					$value = sanitize_text_field( $raw_value );
				}
				$row[ $field_key ] = $value;
				if ( '' !== $value && 0 !== $value ) {
					$has_data = true;
				}
			}
			if ( $has_data ) {
				$rows[] = $row;
			}
		}

		update_post_meta( $post_id, $cfg['meta_key'], $rows );

		if ( ! empty( $cfg['intro_fields'] ) ) {
			foreach ( $cfg['intro_fields'] as $meta_key => $field ) {
				$post_key = 'wh_intro_' . $meta_key;
				if ( isset( $_POST[ $post_key ] ) ) {
					update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $post_key ] ) ) );
				}
			}
		}
	}
}
add_action( 'save_post_page', 'wrens_hollow_save_inline_repeaters' );

/**
 * Loads the admin JS (row add/remove/reorder + media picker) and a small
 * amount of inline CSS only on the Page editor screen for a template that
 * actually has an inline repeater, to avoid loading it everywhere.
 */
function wrens_hollow_enqueue_repeater_admin_assets( $hook ) {
	if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}
	global $post;
	if ( ! $post || 'page' !== $post->post_type ) {
		return;
	}
	$template     = get_page_template_slug( $post );
	$has_repeater = false;
	foreach ( wrens_hollow_inline_repeaters_config() as $cfg ) {
		if ( $cfg['template'] === $template ) {
			$has_repeater = true;
			break;
		}
	}
	if ( ! $has_repeater ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_script(
		'wrens-hollow-admin-repeater',
		get_template_directory_uri() . '/js/admin-repeater.js',
		array(),
		filemtime( get_template_directory() . '/js/admin-repeater.js' ),
		true
	);
	wp_add_inline_style( 'wp-admin', wrens_hollow_repeater_admin_css() );
}
add_action( 'admin_enqueue_scripts', 'wrens_hollow_enqueue_repeater_admin_assets' );

function wrens_hollow_repeater_admin_css() {
	return '
		.wh-tabs__nav { display:flex; gap:4px; border-bottom:1px solid #dcdcde; margin-bottom:16px; }
		.wh-tabs__tab { background:#f0f0f1; border:1px solid #dcdcde; border-bottom:none; border-radius:4px 4px 0 0; padding:8px 14px; cursor:pointer; font-weight:600; color:#50575e; position:relative; top:1px; }
		.wh-tabs__tab.is-active { background:#fff; color:#1d2327; border-bottom:1px solid #fff; }
		.wh-repeater__intro { display:flex; gap:16px; flex-wrap:wrap; margin-bottom:12px; }
		.wh-repeater__intro-field { flex:1 1 220px; margin:0; }
		.wh-repeater__row { display:flex; gap:12px; align-items:flex-start; padding:12px 0; border-bottom:1px solid #dcdcde; }
		.wh-repeater__row:first-child { padding-top:0; }
		.wh-repeater__row-fields { flex:1; display:flex; gap:12px; flex-wrap:wrap; align-items:flex-start; }
		.wh-repeater__field { display:flex; flex-direction:column; gap:4px; }
		.wh-repeater__field--textarea { flex:1 1 100%; }
		.wh-repeater__field-label { font-size:12px; font-weight:600; color:#50575e; }
		.wh-repeater__row-actions { display:flex; flex-direction:column; gap:4px; }
		.wh-repeater__template { display:none; }
	';
}
