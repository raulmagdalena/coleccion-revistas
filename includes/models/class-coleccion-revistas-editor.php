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

class coleccion_revistas_editor {

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

    public function __construct(){
        $this->custom_post_type = 'cr_editor';
        $this->labels = array(
        'name'                  => __( 'Editores', 'Coleccion-Revistas' ),
        'singular_name'         => __( 'Editor', 'Coleccion-Revistas' ),
        'menu_name'             => __( 'Editores', 'Coleccion-Revistas' ),
        'name_admin_bar'        => __( 'Editores', 'Coleccion-Revistas' ),
        'archives'              => __( 'Archivos de Editores', 'Coleccion-Revistas' ),
        'all_items'             => __( 'Todos los editores', 'Coleccion-Revistas' ),
        'add_new_item'          => __( 'Agregar nuevo editor', 'Coleccion-Revistas' ),
        'add_new'               => __( 'Agregar editor', 'Coleccion-Revistas' ),
        'new_item'              => __( 'Nuevo editor', 'Coleccion-Revistas' ),
        'edit_item'             => __( 'Editar editor', 'Coleccion-Revistas' ),
        'update_item'           => __( 'Actualizar editor', 'Coleccion-Revistas' ),
        'view_item'             => __( 'Ver editor', 'Coleccion-Revistas' ),
        'view_items'            => __( 'Ver editores', 'Coleccion-Revistas' ),
        'search_items'          => __( 'Buscar editores', 'Coleccion-Revistas' ),
        'not_found'             => __( 'No encontrado', 'Coleccion-Revistas' ),
        'featured_image'        => __( 'Imagen Destacada', 'Coleccion-Revistas' ),
        'set_featured_image'    => __( 'Colocar imagen destacada', 'Coleccion-Revistas' ),
        'remove_featured_image' => __( 'Quitar imagen destacada', 'Coleccion-Revistas' ),
        'use_featured_image'    => __( 'Usar como imagen destacada', 'Coleccion-Revistas' ),
        'insert_into_item'      => __( 'Insertar en el editor', 'Coleccion-Revistas' ),
        'uploaded_to_this_item' => __( 'Subir en el editor', 'Coleccion-Revistas' ),
        'items_list'            => __( 'Lista de editores', 'Coleccion-Revistas' )
        );
        $this->options = array(
            'label'         => __('Editor', 'Coleccion-Revistas'),
            'description'   => __('Editores de revistas', 'Coleccion-Revistas'),
            'labels'        => $this->labels,
            'supports'      => array('title', 'thumbnail'),
            'public'        => true,
            'menu_position' => 2,
            'has_archive'   => true,
            'rewrite'       => array('slug' => 'editores'),
        );
        add_action('init', array($this,'cr_editor_register_post_type'));
        add_action('add_meta_boxes',array($this ,'cr_editor_custom_boxes'));
        add_action('save_post', array($this, 'save_meta_data'));
    }

    function cr_editor_register_post_type(){

        register_post_type($this->custom_post_type, $this->options);
    }


    function cr_editor_custom_boxes(){
        add_meta_box('cr_editor_address', 'Dirección',array($this,'cr_editor_custom_box_address_html'), 'cr_editor', 'normal');
        add_meta_box('cr_editor_web', 'web', array($this, 'cr_editor_custom_box_web_html'), 'cr_editor', 'normal');
    }

    /**
     * Saves the data inputed on meta boxes
     * 
     * @since   0.0.1
     * @access  private
     */

    function save_meta_data($post_id){


    /*
    * We need to verify this came from the our screen and with proper authorization,
    * because save_post can be triggered at other times.
    */
 
    // Check if our nonce is set.
    if ( ! isset( $_POST['cr_editor_address_nonce'] ) ) {
        return $post_id;
    }
 
    $nonce = $_POST['cr_editor_address'];
 
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'cr_editor_address_nonce' ) ) {
        return $post_id;
    }
 
    /*
     * If this is an autosave, our form has not been submitted,
     * so we don't want to do anything.
     */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
 
    // Check the user's permissions.
    if ( 'page' == $_POST['cr_editor'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return $post_id;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }
    }
 
    /* OK, it's safe for us to save the data now. */
 
    // Sanitize the user input.
    $mydata = array(
        'cr_editor_address' => sanitize_text_field( $_POST['cr_editor_address']),
        'cr_editor_web' => sanitize_text_field( $_POST['cr_editor_web']),
    );
 
    // Update the meta fields.
    foreach ($metas as $meta => $value) {
        update_post_meta( $post_id, $meta, $metas );
    }

}

    function cr_editor_custom_box_address_html($post){
        // Add a nonce field to check it later
        wp_nonce_field('cr_editor_address', 'cr_editor_address_nonce')
        ?>
        <input type="text" name="cr_editor_address" size="30">
        <?php
    }

    function cr_editor_custom_box_web_html($post){
        // Add a nonce field to check it later
        wp_nonce_field('cr_editor_web', 'cr_editor_web_nonce')
        ?>
        <input type="text" name="cr_editor_web" size="30">
        <?php
    }
}