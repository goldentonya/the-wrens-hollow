<?php
/**
 * The whole About page editing experience — Header, Bio, Facts, Connect, and
 * Journey Timeline — as ONE meta box with a single click-to-switch tab bar.
 *
 * ACF's own 'tab' fields can only group ACF fields, and Facts/Journey are
 * hand-built "add row" repeaters (see inc/inline-repeaters.php), not ACF
 * fields — so getting one unified tab bar across all five sections means none
 * of them can be a normal ACF field group. Header/Bio/Connect are plain
 * postmeta here (same pattern as the repeaters' own "intro" fields), and
 * Facts/Journey reuse the shared repeater renderer so their add/remove-row
 * behavior stays defined in exactly one place.
 *
 * The Portrait photo field (sidebar) is still a normal ACF field — see
 * group_wh_about_photo in inc/acf-page-fields.php — this file only replaces
 * what used to be the "Page copy — About" ACF group.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header/Bio/Connect field definitions, grouped by tab. 'wysiwyg' fields
 * render via wp_editor() (WordPress's native rich-text editor — no ACF
 * dependency) so Bio keeps a real Bold/Italic/link toolbar.
 */
function wrens_hollow_about_fields_config() {
	return array(
		'header'  => array(
			'about_greeting' => array( 'type' => 'text', 'label' => 'Greeting', 'default' => 'Welcome!' ),
			'about_name'     => array( 'type' => 'text', 'label' => 'Name heading', 'default' => "I'm Ali Wren" ),
			'about_tagline'  => array( 'type' => 'text', 'label' => 'Tagline', 'default' => 'Indie author · Minnesota · romance & fantasy.' ),
		),
		'bio'     => array(
			'bio_intro'     => array(
				'type'    => 'wysiwyg',
				'label'   => 'Intro paragraphs',
				'default' => "<p>I write romance and fantasy filled with emotion, danger, and unforgettable connections.</p>\n<p>My stories are inspired by real-world experiences, human behavior, and the idea that love can be both powerful and complicated.</p>",
			),
			'bio_pullquote' => array(
				'type'    => 'textarea',
				'label'   => 'Pull quote',
				'default' => "Author, biological anthropologist, and proud mom. I write romantic adventures that blend science, suspense, and heart. Stories where love is hard-won and nothing is ever as simple as it seems. You'll find strong heroines (often scientists), fiercely loyal heroes, and characters shaped by resilience, survival, and the choices that define them.",
			),
			'bio_more'      => array(
				'type'    => 'wysiwyg',
				'label'   => 'Remaining paragraphs',
				'default' => "<p>My writing is deeply influenced by my background in anthropology and my fascination with human behavior, why we love the way we do, what drives us, and what we're willing to risk for the people who matter most. Many of my stories are inspired by real-world experiences, from travel and culture to the emotional complexities we carry with us.</p>\n<p>Some of my earliest inspiration came from a trip to Brazil, where I fell in love with the landscape, the energy, and the depth of human connection I witnessed there. That experience, combined with my son's interest in the military and my own love of science, helped shape the stories I tell today—where emotion, danger, and discovery all collide.</p>\n<p>When I'm not writing, I'm answering phones at our family plumbing business, running a support brand for families affected by alopecia, or chasing my kids around, usually with a coffee (or water) in hand. Motherhood continues to be one of my biggest inspirations, reminding me daily what strength, love, and resilience truly look like.</p>\n<p>Welcome to my corner of the internet—where love is fierce, women are brilliant, and there's always more to the story.</p>",
			),
		),
		'connect' => array(
			'connect_eyebrow' => array( 'type' => 'text', 'label' => 'Newsletter — eyebrow', 'default' => 'Join the Hollow' ),
			'connect_heading' => array( 'type' => 'text', 'label' => 'Newsletter — heading', 'default' => "Let's Stay Connected" ),
			'connect_body'    => array( 'type' => 'textarea', 'label' => 'Newsletter — text', 'default' => 'Love strong heroines, slow-burn romance, and a little bit of danger? Sign up for my newsletter and get bonus chapters plus first look at new releases, behind-the-scenes peeks, character deep-dives, and updates straight to your inbox.' ),
			'hello_eyebrow'   => array( 'type' => 'text', 'label' => 'Contact — eyebrow', 'default' => 'Say hello' ),
			'hello_heading'   => array( 'type' => 'text', 'label' => 'Contact — heading', 'default' => "I'd Love to Hear from You!" ),
			'hello_body'      => array( 'type' => 'textarea', 'label' => 'Contact — text', 'default' => "Whether you're a fellow reader, a book club, a blogger, or just curious about my writing—drop a note below!" ),
		),
	);
}

/**
 * The default value for any field in the config above, keyed by field name —
 * the single source of truth for both the admin pre-fill and the front-end
 * fallback (see page-about.php), so long bio paragraphs aren't duplicated.
 */
function wrens_hollow_about_field_default( $key ) {
	foreach ( wrens_hollow_about_fields_config() as $group ) {
		if ( isset( $group[ $key ] ) ) {
			return $group[ $key ]['default'];
		}
	}
	return '';
}

function wrens_hollow_register_about_editor( $post ) {
	if ( 'page-about.php' !== get_page_template_slug( $post ) ) {
		return;
	}
	add_meta_box( 'wh_about_editor', 'About page content', 'wrens_hollow_render_about_editor', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes_page', 'wrens_hollow_register_about_editor' );

function wrens_hollow_render_about_editor( $post ) {
	wp_nonce_field( 'wh_save_repeaters', 'wh_repeaters_nonce' );
	$repeaters = wrens_hollow_inline_repeaters_config();
	?>
	<input type="hidden" name="wh_about_fields_present" value="1">
	<div class="wh-tabs">
	  <div class="wh-tabs__nav">
	    <button type="button" class="wh-tabs__tab" data-wh-tab="header">Header</button>
	    <button type="button" class="wh-tabs__tab" data-wh-tab="bio">Bio</button>
	    <button type="button" class="wh-tabs__tab" data-wh-tab="facts">Facts</button>
	    <button type="button" class="wh-tabs__tab" data-wh-tab="connect">Connect</button>
	    <button type="button" class="wh-tabs__tab" data-wh-tab="journey">Journey Timeline</button>
	  </div>

	  <div class="wh-tabs__pane" data-wh-pane="header">
	    <?php wrens_hollow_render_about_plain_fields( 'header', $post ); ?>
	  </div>

	  <div class="wh-tabs__pane" data-wh-pane="bio">
	    <?php wrens_hollow_render_about_bio_fields( $post ); ?>
	  </div>

	  <div class="wh-tabs__pane" data-wh-pane="facts">
	    <?php wrens_hollow_render_inline_repeater( 'facts', $repeaters['facts'], $post ); ?>
	  </div>

	  <div class="wh-tabs__pane" data-wh-pane="connect">
	    <?php wrens_hollow_render_about_plain_fields( 'connect', $post ); ?>
	  </div>

	  <div class="wh-tabs__pane" data-wh-pane="journey">
	    <?php wrens_hollow_render_inline_repeater( 'milestones', $repeaters['milestones'], $post ); ?>
	  </div>
	</div>
	<?php
}

function wrens_hollow_render_about_plain_fields( $group, $post ) {
	foreach ( wrens_hollow_about_fields_config()[ $group ] as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		if ( '' === $value ) {
			$value = $field['default'];
		}
		?>
		<p>
		  <label class="wh-repeater__field-label"><?php echo esc_html( $field['label'] ); ?></label><br>
		  <?php if ( 'textarea' === $field['type'] ) : ?>
		    <textarea name="<?php echo esc_attr( $key ); ?>" rows="3" class="widefat"><?php echo esc_textarea( $value ); ?></textarea>
		  <?php else : ?>
		    <input type="text" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="widefat">
		  <?php endif; ?>
		</p>
		<?php
	}
}

function wrens_hollow_render_about_bio_fields( $post ) {
	$fields = wrens_hollow_about_fields_config()['bio'];

	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		if ( '' === $value ) {
			$value = $field['default'];
		}
		?>
		<p><label class="wh-repeater__field-label"><?php echo esc_html( $field['label'] ); ?></label></p>
		<?php
		if ( 'wysiwyg' === $field['type'] ) {
			wp_editor(
				$value,
				'wh_' . $key,
				array(
					'textarea_name' => $key,
					'textarea_rows' => ( 'bio_more' === $key ) ? 10 : 6,
					'media_buttons' => false,
					'teeny'         => true,
				)
			);
		} else {
			?>
			<textarea name="<?php echo esc_attr( $key ); ?>" rows="4" class="widefat"><?php echo esc_textarea( $value ); ?></textarea>
			<?php
		}
		echo '<div style="margin-bottom:20px;"></div>';
	}
}

function wrens_hollow_save_about_editor( $post_id ) {
	if ( ! isset( $_POST['wh_about_fields_present'] ) ) {
		return;
	}
	if ( ! isset( $_POST['wh_repeaters_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['wh_repeaters_nonce'] ), 'wh_save_repeaters' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}
	if ( 'page-about.php' !== get_page_template_slug( $post_id ) ) {
		return;
	}

	foreach ( wrens_hollow_about_fields_config() as $fields ) {
		foreach ( $fields as $key => $field ) {
			if ( ! isset( $_POST[ $key ] ) ) {
				continue;
			}
			$raw = wp_unslash( $_POST[ $key ] );
			if ( 'wysiwyg' === $field['type'] ) {
				$value = wp_kses_post( $raw );
			} elseif ( 'textarea' === $field['type'] ) {
				$value = sanitize_textarea_field( $raw );
			} else {
				$value = sanitize_text_field( $raw );
			}
			update_post_meta( $post_id, $key, $value );
		}
	}
}
add_action( 'save_post_page', 'wrens_hollow_save_about_editor' );
