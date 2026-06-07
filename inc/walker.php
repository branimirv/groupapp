<?php
class Menu_With_Description extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
         
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';
 
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
 
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '<br /><span class="sub">' . $item->description . '</span>';
        $item_output .= '</a>';
        $item_output .= $args->after;
 
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Mega_Menu_Walker
 *
 * Renders the header's primary nav. Top-level items whose CSS classes include
 * `mega-platform` or `mega-solutions` are rendered as <button> triggers that
 * control the corresponding mega-menu panel. All other items render as normal
 * links. Sub-items (depth >= 1) are intentionally suppressed because panel
 * contents now come from ACF Options instead of menu sub-items.
 */
class Mega_Menu_Walker extends Walker_Nav_Menu {

    /**
     * Map of detection class => panel id (used for data-panel and aria-controls).
     */
    protected $panels = array(
        'mega-platform'  => 'platform',
        'mega-solutions' => 'solutions',
    );

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        // No nested <ul>; sub-items are suppressed.
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        // No nested <ul>; sub-items are suppressed.
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( $depth > 0 ) {
            return; // Suppress sub-items entirely.
        }

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $panel   = $this->detect_panel( $classes );

        $li_classes   = array( 'primary-nav__item' );
        $li_classes[] = 'menu-item-' . $item->ID;
        if ( $panel ) {
            $li_classes[] = 'primary-nav__item--mega';
        }
        $li_classes = array_merge( $li_classes, array_filter( $classes ) );
        $li_classes = array_unique( array_filter( $li_classes ) );
        $li_class   = join( ' ', apply_filters( 'nav_menu_css_class', $li_classes, $item, $args, $depth ) );

        $output .= '<li id="menu-item-' . $item->ID . '" class="' . esc_attr( $li_class ) . '">';

        if ( $panel ) {
            $output .= sprintf(
                '<button type="button" class="primary-nav__trigger" aria-expanded="false" aria-controls="mega-%1$s" data-panel="%1$s"><span class="primary-nav__label">%2$s</span><svg class="primary-nav__chev" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true" focusable="false"><path d="M2 4l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>',
                esc_attr( $panel ),
                esc_html( apply_filters( 'the_title', $item->title, $item->ID ) )
            );

            if ( function_exists( 'groupapp_render_mega_menu' ) ) {
                ob_start();
                groupapp_render_mega_menu( $panel, 'mega-' . $panel );
                $output .= ob_get_clean();
            }
        } else {
            $attrs  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
            $attrs .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target ) . '"' : '';
            $attrs .= ! empty( $item->xfn )        ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
            $attrs .= ! empty( $item->url )        ? ' href="' . esc_attr( $item->url ) . '"' : '';

            $output .= '<a class="primary-nav__link"' . $attrs . '>' . esc_html( apply_filters( 'the_title', $item->title, $item->ID ) ) . '</a>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( $depth > 0 ) {
            return;
        }
        $output .= "</li>\n";
    }

    /**
     * Return the panel id ('platform' / 'solutions') if the item has a matching class.
     */
    protected function detect_panel( $classes ) {
        foreach ( $this->panels as $class => $panel ) {
            if ( in_array( $class, $classes, true ) ) {
                return $panel;
            }
        }
        return null;
    }
}
