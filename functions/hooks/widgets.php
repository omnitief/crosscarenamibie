<?php
function register_widget_areas() {
	register_sidebar([
		'name'	=> 'Footer kolom 1 - NL',
		'id'    => 'footer_column_first',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 2 - NL',
		'id'    => 'footer_column_second',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 3 - NL',
		'id'    => 'footer_column_third',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 4 - NL',
		'id'    => 'footer_column_fourth',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);
	
	register_sidebar([
		'name'	=> 'Footer kolom 1 - EN',
		'id'    => 'footer_column_first_en',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 2 - EN',
		'id'    => 'footer_column_second_en',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 3 - EN',
		'id'    => 'footer_column_third_en',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);

	register_sidebar([
		'name'	=> 'Footer kolom 4 - EN',
		'id'    => 'footer_column_fourth_en',
		'before_widget'	=> '',
		'after_widget'	=> '',
	]);
}
add_action( 'widgets_init', 'register_widget_areas' );