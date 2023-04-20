<?php 
$link_1 = home_url() . '/wp-admin/edit.php?post_type=realestate&page=parser_data&parser=1&parser_page=1&type=realestate';
$link_2 = home_url() . '/wp-admin/edit.php?post_type=realestate&page=parser_data&parser=1&parser_page=1&type=rewrite-realestate';
$status_posts = get_option( 'parser_status_posts' );
?>

<h1>Парсер</h1>
<table id="parser_table" class="form-table" role="presentation">
    <tbody>
        <tr>
            <th scope="row">
                <label for="blogname">Объекты недвижимости</label>
            </th>
            <td>
                <a class="button button-primary" href="<?php echo $link_1; ?>">Начать</a>
            </td>
            <td>
                <a class="button button-primary" href="<?php echo $link_2; ?>">Рерайт с помощью Chat gpt</a>
            </td>
            <td>
                <?php if ($status_posts) : ?>
                    <img src="<?php echo THEME_URI . '/img/preloader.gif'; ?>">
                <?php else : ?>
                    <img src="<?php echo THEME_URI . '/img/completed.png'; ?>">
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
</table>