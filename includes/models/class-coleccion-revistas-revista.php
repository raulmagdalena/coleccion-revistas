<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://raulmagdalenacatala.com
 * @since      0.0.1
 *
 * @package    Coleccion_Revistas
 * @subpackage Coleccion_Revistas/includes/models
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.0.1
 * @package    Coleccion_Revistas
 * @subpackage Coleccion_Revistas/includes/models
 * @author     Raul Magdalena Català <raulmagdalena@gmasil.com>
 */

class Coleccion_Revistas_Revista{

	 /**
     * The Custom Post Type
     * 
     *
     * @since    0.0.1
     * @access   protected
     * @var      string    $custom_post_type    The Custom Post Type to be registered.
     */
    protected $custom_post_type;


	/**
    * The Custom Post Type options
    *
    * @since    0.0.1.
    * @access   protected
    * @var      array()     $options        Contents the Custom Post Type options.
    */
    protected $options;

    /**
     * The label for the Custom Post Type
     * 
     * @since   0.0.1.
     * @access  protected
     * @var     array()     $labels
     */

    protected $labels;

    function __construct(){
    	$this->custom_post_type = 'cr_revista';
        $this->labels = array(
        'name'                  => __( 'Revistas', 'Coleccion-Revistas' ),
        'singular_name'         => __( 'Revista', 'Coleccion-Revistas' ),
        'menu_name'             => __( 'Revistas', 'Coleccion-Revistas' ),
        'name_admin_bar'        => __( 'Revistas', 'Coleccion-Revistas' ),
        'archives'              => __( 'Archivos de revistas', 'Coleccion-Revistas' ),
        'all_items'             => __( 'Todos las revistas', 'Coleccion-Revistas' ),
        'add_new_item'          => __( 'Agregar nueva revista', 'Coleccion-Revistas' ),
        'add_new'               => __( 'Agregar revista', 'Coleccion-Revistas' ),
        'new_item'              => __( 'Nueva revista', 'Coleccion-Revistas' ),
        'edit_item'             => __( 'Editar revista', 'Coleccion-Revistas' ),
        'update_item'           => __( 'Actualizar revista', 'Coleccion-Revistas' ),
        'view_item'             => __( 'Ver revista', 'Coleccion-Revistas' ),
        'view_items'            => __( 'Ver revistas', 'Coleccion-Revistas' ),
        'search_items'          => __( 'Buscar revistas', 'Coleccion-Revistas' ),
        'not_found'             => __( 'No encontrada', 'Coleccion-Revistas' ),
        'featured_image'        => __( 'Imagen Destacada', 'Coleccion-Revistas' ),
        'set_featured_image'    => __( 'Colocar imagen destacada', 'Coleccion-Revistas' ),
        'remove_featured_image' => __( 'Quitar imagen destacada', 'Coleccion-Revistas' ),
        'use_featured_image'    => __( 'Usar como imagen destacada', 'Coleccion-Revistas' ),
        'insert_into_item'      => __( 'Insertar en la revista', 'Coleccion-Revistas' ),
        'uploaded_to_this_item' => __( 'Subir en la revista', 'Coleccion-Revistas' ),
        'items_list'            => __( 'Lista de revistas', 'Coleccion-Revistas' )
        );
        $this->options = array(
            'label'         => __('Revista', 'Coleccion-Revistas'),
            'description'   => __('Revista periódica', 'Coleccion-Revistas'),
            'labels'        => $this->labels,
            'supports'      => array('title', 'thumbnail'),
            'public'        => true,
            'menu_position' => 3,
            'has_archive'   => true,
            'rewrite'       => array('slug' => 'revistas'),
        );
        add_action('init', array($this,'cr_revista_register_post_type'));
        add_action('add_meta_boxes',array($this ,'cr_revista_custom_boxes'));        
    }

    function cr_revista_register_post_type(){

        register_post_type($this->custom_post_type, $this->options);
    }


    function cr_revista_custom_boxes(){
        //add_meta_box('cr_editor_address', 'Dirección',array($this,'cr_editor_custom_box_address_html'), 'cr_editor', 'normal');
        
    }
}