<?php


function kdp_add_brigade_captain_role()
{
    add_role('kdp_brigade_captain',
        'Kapitan Brygady',
        array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
            'publish_posts' => false,
            'upload_files' => true,
        )
    );
}

register_activation_hook(__FILE__, 'kdp_add_brigade_captain_role');

add_action('admin_init', 'kdp_add_role_caps', 999);
function kdp_add_role_caps()
{

// Add the roles you'd like to administer the custom post types
    $roles = array('kdp_brigade_captain', 'editor', 'administrator');

// Loop through each role and assign capabilities
    foreach ($roles as $the_role) {

        $role = get_role($the_role);

        $role->add_cap('read');
        $role->add_cap('read_project');
        $role->add_cap('read_private_projects');
        $role->add_cap('edit_project');
        $role->add_cap('edit_projects');
        $role->add_cap('edit_others_projects');
        $role->add_cap('edit_published_projects');
        $role->add_cap('publish_projects');
        $role->add_cap('delete_others_projects');
        $role->add_cap('delete_private_projects');
        $role->add_cap('delete_published_projects');

    }
