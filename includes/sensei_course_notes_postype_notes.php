<?php

add_action('init', 'scn_postype_fn');

//Custom Post Type Course Notes
function scn_postype_fn(){

	$labels = array(
		'name' => 'Notas de Cursos',
		'singular_name' => 'Notas de Cursos',
		'add_new' => 'Registrar Nota de Curso',
		'all_items'=> 'Listar Notas de Cursos',
		'add_new_item'=> 'Agregar Nueva Nota de Curso',
		'edit_item' => 'Editar Nota de Curso',
		'view_item ' => 'Visualizar Nota de Curso',
		'search_item' => 'Buscar Nota de Curso',
		'not_found' => 'No Existe la Nota de Curso',
		'not_found_in_trash ' => 'No Enlace found in trash',
		'parent_item_colon' => 'Parent Item'
	);

	$args = array(
		'labels'=> $labels,
		'public'=> true,
		'has_archive'=>true,
		'publicly_queryable'=>true,
		'query_var'=>true,
		'rewrite'=>true,
		'capability_type'=>'post',
		'menu_icon' => 'dashicons-list-view',
		'hierarchical' => false,
		'supports'=> array('title'),
		'taxonomies' => array(''),
		'menu_position'=>5,
		'exclude_from_search'=>true
	);

	register_post_type('scn_cpt_notes',$args);
}

add_action('save_post','scn_notes_save_cp');

function scn_notes_save_cp($post){

}

//MetaBox for Course
add_action("add_meta_boxes", "scn_mtbx_notes_course");

function scn_mtbx_notes_course(){

	add_meta_box("scn_mbtx_notes_course", "Curso Seleccionado", "scn_mtbx_notes_course_callback",array("scn_cpt_notes"),"normal","default");

}

function scn_mtbx_notes_course_callback($post){
	
}

//MetaBox for Detail Note
add_action('add_meta_boxes','scn_mtbx_notes_detail');

function scn_mtbx_notes_detail()
{
	add_meta_box('scn_mtbx_notes_detail', 'Detalle de la Nota','scn_mtbx_notesx_callback', array('scn_cpt_notes'), 'normal', 'default');
}

function scn_mtbx_notesx_callback($post){

	$content = "";
	wp_editor($content, 'sensei_course_notes_editor');

}