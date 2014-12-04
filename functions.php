<?php

include_once('framework/custom-post-types.php');
include_once('framework/facebookEventManager.php');

setlocale(LC_ALL, 'pl_PL.UTF-8');

//Menu
register_nav_menu('primary', 'Menu główne');
register_nav_menu('secondary', 'Menu w stopce');
register_nav_menu('top', 'Top Menu');

//Rozmiary obrazków
add_theme_support('post-thumbnails');
add_image_size('post', 850, 9999);
add_image_size('mini', 265, 200, true);
add_image_size('avatars', 65, 65, true);
add_image_size('partners', 9999, 70);

function the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug;
}

function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'...'; //<a href="'.$permalink.'">Czytaj dalej</a>
  return $excerpt;
}

function excerpt($limit) {
 $excerpt = explode(' ', get_the_excerpt(), $limit);
 
 if (count($excerpt)>=$limit) {
 	array_pop($excerpt);
 	$excerpt = implode(" ",$excerpt).'...';
 } else {
 	$excerpt = implode(" ",$excerpt);
 }
 
 $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
 return $excerpt;
}

//Menu Główne
function primary_menu(){

	$menu_name = 'primary';
	$i=1;

	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		foreach ( (array) $menu_items as $key => $menu_item ) {

			if($i==1){
				$menu_list .= '<div class="navbar-left">';
				$menu_list .= '<ul class="nav navbar-nav">';
			} else if($i==4) {
				$menu_list .= '<div class="navbar-right">';
				$menu_list .= '<ul class="nav navbar-nav">';
			}

			$title = $menu_item->title;
			$url = $menu_item->url;
			$target = $menu_item->target;
			$menu_list .= '<li><a target="'. $target .'" href="' . $url . '">' . $title . '</a></li>';

			if( ($i==3) || ($i==6) ){
				$menu_list .= '</ul>';
				$menu_list .= '</div>';
			}

			$i++;
		}
	}
	echo $menu_list;
}


// Okruszki
function the_breadcrumb() {
		echo '<ol class="breadcrumbs">';
	if (!is_home()) {
		echo '<li><a href="';
		echo get_option('home');
		echo '">';
		bloginfo('name');
		echo "</a></li>";
		if (is_category() || is_single()) {
			echo '<li>';
			the_category(' </li><li> ');
			if (is_single()) {
				echo "</li><li>";
				the_title();
				echo '</li>';
			}
		} elseif (is_page()) {
			echo '<li class="is-active"> ';
			echo the_title();
			echo '</li>';
		}
	}
	elseif (is_tag()) {single_tag_title();}
	elseif (is_day()) {echo"<li >Archiwum z "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li>Archiwum z "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archiwum z "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Archiwum autora"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Archiwum bloga"; echo'</li>';}
	elseif (is_search()) {echo"<li>Wynik wyszukiwania"; echo'</li>';}
	echo '</ol>';
}