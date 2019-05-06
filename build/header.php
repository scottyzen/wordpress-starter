<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div>
        <header>
            <div class="container flex flex-wrap justify-between">

                <div>
                    <!-- Logo -->
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo get_bloginfo('name'); ?></a>
                    <!-- Description -->
                    <div><?php bloginfo('description'); ?></div>
                </div>

                <nav class="flex-1">
                    <div class="w-full">
                        <div id="search" class="flex justify-end"><?php get_search_form(); ?></div>
                    </div>
                    <div class="w-full bg-blue-500">
                        <ul class="flex flex-wrap justify-end">
                            <?php
                            $locations = get_nav_menu_locations();
                            $menu = wp_get_nav_menu_object($locations['main-menu']);
                            $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => ''));


                            foreach ($menuitems as $item) {
                                echo '<li class="py-6 ml-6"><a href="' . $item->url . '" title="' . $item->title . '">' . $item->title . '</a></li>';
                            }
                            ?>

                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">