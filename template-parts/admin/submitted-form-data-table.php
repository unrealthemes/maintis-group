<?php 
$i = 1;
$reviews = $args['users_data']; 
$redirect_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="wrap">
    <form id="submitted_form" action="" method="post">
        <input type="hidden" name="redirect_url" value="<?php echo $redirect_url; ?>">
        <h1>Отзывы школы</h1>

        <p>
            <button type="submit" class="button button-primary delete-emails-js" disabled>
                Удалить
            </button>
        </p>

        <table id="submitted_form_data" class="wp-list-table widefat fixed striped table-view-list posts">
            <thead>
                <tr>
                    <th style="min-width: 28px;">
                        <input id="sf_all" type="checkbox" style="padding:0px;">
                    </th>
                    <th>Школа</th>
                    <th>Имя</th>
                    <th>Почта</th>
                    <th>Дата</th>
                    <th>Контент</th>
                    <th>Рейтинг</th>
                    <th>Одобренный</th>
                    <th>Кнопки</th>
                </tr>
            </thead>
            <tbody>

                <?php if ( $reviews ) : ?>

                    <?php foreach ( $reviews as $key => $review ) : ?>

                        <tr data-comment-id="<?php echo esc_attr($review['comment_ID']); ?>">
                            <td>
                                <input id="sf_<?php echo $review['comment_ID'] ?>" 
                                    type="checkbox" 
                                    name="reviews[]" 
                                    class="email-items"
                                    value="<?php echo $review['comment_ID'] ?>">
                            </td>

                            <?php 
                            foreach ( $review as $key => $value ) : 
                                
                                if ( $key == 'comment_ID' || $key == 'comment_date_gmt' || $key == 'user_id' || $key == 'rewrite' ) :
                                    continue;
                                endif;
                            ?>

                                <?php if ( $key == 'comment_content' ) : ?>

	                                <td class="table-item">
                                        <div class="content">
                                            <?php echo stripcslashes($value); ?>
                                        </div>
                                        <span class="modal-open"></span>
                                    </td>
                                
                                <?php 
                                elseif ( $key == 'comment_school_ID' ) : 
                                    $tax_name = 'pa_onlajn-platforma';
                                    $school = get_term($value, $tax_name);
                                ?>

	                                <td class="table-item">
                                        <?php echo esc_html($school->name); ?>
                                    </td>
                                
                                <?php elseif ( $key == 'comment_rating' ) : ?>

	                                <td class="table-item rating">
                                        <div class="rating">                                
                                            <svg class="none" width="0" height="0" xmlns="http://www.w3.org/2000/svg">
                                                <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="star">
                                                    <path d="M31.547 12a.848.848 0 00-.677-.577l-9.427-1.376-4.224-8.532a.847.847 0 00-1.516 0l-4.218 8.534-9.427 1.355a.847.847 0 00-.467 1.467l6.823 6.664-1.612 9.375a.847.847 0 001.23.893l8.428-4.434 8.432 4.432a.847.847 0 001.229-.894l-1.615-9.373 6.822-6.665a.845.845 0 00.214-.869z"></path>
                                                </symbol>
                                            </svg>                                             
                                            <div class="c-rate">
                                                
                                                <?php 
                                                for ($y = 1; $y <= 5; $y++) : 
                                                    $class = ( $y <= round($value) ) ? ' diactive' : '';
                                                ?>
                                                    <svg class="c-icon<?php echo esc_attr($class); ?>" width="20" height="20">
                                                        <use xlink:href="#star"></use>
                                                    </svg>
                                                <?php endfor; ?>

                                            </div>  
                                        </div>
                                    </td>

                                <?php else : ?>

                                    <td class="table-item">
                                        <?php echo esc_html($value); ?>
                                    </td>

                                <?php endif; ?>

                            <?php endforeach; ?>

                            <td>
                                <?php if ( $review['comment_approved'] == 0 ) : ?>
                                    <div class="ut-loader"></div>
                                    <button class="button button-primary confirm-user-data-js"
                                            data-comment-id="<?php echo esc_attr($review['comment_ID']); ?>">
                                        Одобрить
                                    </button>
                                <?php endif; ?>

                                <button type="button"
                                        class="button button-primary edit-review-js"
                                        data-comment-id="<?php echo esc_attr($review['comment_ID']); ?>">
                                    Редактировать
                                </button>

                            </td>

                        </tr>

                    <?php $i++; endforeach; ?>

                <?php endif; ?>

            </tbody>
        </table>

        <?php echo $args['pagination']; ?>

    </form>
</div>

<?php get_template_part('template-parts/modals/edit-review'); ?>