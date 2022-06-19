<?php


class TopicsTaxonomy
{
    public function __construct()
    {
        add_action( 'init', array( $this, 'init_topics' ) );
    }

    public function init_topics() {
        $labels = array(
            'name'          => 'Topics',
            'singular_name' => 'Topic',
            'edit_item'     => 'Edit Topic',
            'update_item'   => 'Update Topic',
            'add_new_item'  => 'Add New Topic',
            'menu_name'     => 'Topic'
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'topic' )
        );

        register_taxonomy( 'topic', 'post', $args );
    }
}
