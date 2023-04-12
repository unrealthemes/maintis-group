<?php 

/**
 * Pagination
 */
function ut_pagination( $pages = '', $range = 1 ) {

    $showitems = $range + 1;
    global $paged;

    if ( empty( $paged ) ) $paged = 1;

    if ( $pages == '' ) {
         global $wp_query;
         $pages = $wp_query->max_num_pages;

         if ( ! $pages ) {
             $pages = 1;
         }
    }

    if ( 1 != $pages ) {

        echo '<ul class="pagination">';

            if ( $paged > 1 && $showitems < $pages ) {

                echo '<li class="page-item page-item__prev"><a class="page-link" href="' . get_pagenum_link( $paged - 1 ) . '">&lt; Назад</a> </li> <li class="page-item active">';
            }

    		for ( $i=1; $i <= $pages; $i++ ) {

    			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {

                    if ( $paged == $i ) {
                        echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
                    }
    			}
    		}

            if ( $range == 2 && $pages > $paged && $pages - 2 != $paged && $pages - 1 != $paged ) {

        		if ( $pages - 3 != $paged ) {
                	echo '<li class="page-item"><a class="page-link" href="#">...</a></li>';
                }
            	echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
            }

            if ( $range == 1 && $pages > $paged && $pages - 2 != $paged && $pages - 1 != $paged ) {

                echo '<li class="page-item"><a class="page-link" href="#">...</a></li>';
            	echo '<li class="page-item"><a class="page-link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a></li>';
            }

            if ( $paged < $pages && $showitems < $pages ) {

                echo '<li class="page-item page-item__next"><a class="page-link" href="' . get_pagenum_link( $paged + 1 ) . '">Вперед &gt;</a></li>';
            } 

        echo "</ul>";

    }
}