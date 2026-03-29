<?php
function register_widget_areas() {
	register_sidebar([
		'name'	=> 'Footer kolom 1',
		'id'    => 'footer_column_first',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 2',
		'id'    => 'footer_column_second',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 3',
		'id'    => 'footer_column_third',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 4',
		'id'    => 'footer_column_fourth',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);
}
add_action( 'widgets_init', 'register_widget_areas' );