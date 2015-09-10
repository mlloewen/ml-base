<?php
/**
 * radio-image Customizer Control.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2015, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Early exit if the class already exists
if ( class_exists( 'Kirki_Controls_Radio_Image_Control' ) ) {
	return;
}

class Kirki_Controls_Radio_Image_Control extends WP_Customize_Control {

	public $type = 'radio-image';

	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );
		wp_enqueue_script( 'kirki-radio-image', trailingslashit( kirki_url() ) . 'includes/controls/radio-image/script.js', array( 'jquery', 'jquery-ui-button' ) );
		wp_enqueue_style( 'kirki-radio-image', trailingslashit( kirki_url() ) . 'includes/controls/radio-image/style.css' );
	}

	public function render_content() {

		if ( empty( $this->choices ) ) {
			return;
		}

		$name = '_customize-radio-' . $this->id;

		?>
		<span class="customize-control-title">
			<?php echo esc_html( $this->label ); ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</span>
		<div id="input_<?php echo $this->id; ?>" class="image">
			<?php foreach ( $this->choices as $value => $label ) : ?>
				<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . esc_attr( $value ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
					<label for="<?php echo $this->id . esc_attr( $value ); ?>">
						<img src="<?php echo esc_html( $label ); ?>">
					</label>
				</input>
			<?php endforeach; ?>
		</div>
		<?php
	}

}
