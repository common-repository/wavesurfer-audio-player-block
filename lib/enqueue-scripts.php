<?php

namespace WavesurferAudioPlayer;

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_block_editor_assets' );
/**
 * Enqueue block editor only JavaScript and CSS.
 */
function enqueue_block_editor_assets() {
	// Make paths variables so we don't write em twice ;)
	$block_path = '/assets/js/editor.blocks.js';
	$style_path = '/assets/css/blocks.editor.css';
	$stencil_path = '/assets/js/wsaudioplayer.js';

	// Enqueue optional editor only styles
	wp_enqueue_script(
		'ws-audio-player',
		_get_plugin_url() . $stencil_path,
		[ ],
		filemtime( _get_plugin_directory() . $stencil_path )
	);

	// Enqueue the bundled block JS file
	wp_enqueue_script(
		'jsforwp-blocks-js',
		_get_plugin_url() . $block_path,
		[ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor'],
		filemtime( _get_plugin_directory() . $block_path )
	);

	// Enqueue optional editor only styles
	wp_enqueue_style(
		'jsforwp-blocks-editor-css',
		_get_plugin_url() . $style_path,
		[ ],
		filemtime( _get_plugin_directory() . $style_path )
	);
}

add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue front end and editor JavaScript and CSS assets.
 */
function enqueue_assets() {
	$style_path = '/assets/css/blocks.style.css';
	wp_enqueue_style(
		'jsforwp-blocks',
		_get_plugin_url() . $style_path,
		null,
		filemtime( _get_plugin_directory() . $style_path )
	);
}

add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue_frontend_assets' );
/**
 * Enqueue frontend JavaScript and CSS assets.
 */
function enqueue_frontend_assets() {

	// If in the backend, bail out.
	if ( is_admin() ) {
		return;
	}

	$block_path = '/assets/js/frontend.blocks.js';
	$stencil_path = '/assets/js/wsaudioplayer.js';
	wp_enqueue_script(
		'jsforwp-blocks-frontend',
		_get_plugin_url() . $block_path,
		[],
		filemtime( _get_plugin_directory() . $block_path )
	);
	wp_enqueue_script(
		'ws-audio-player',
		_get_plugin_url() . $stencil_path,
		[ ],
		filemtime( _get_plugin_directory() . $stencil_path )
	);
}
