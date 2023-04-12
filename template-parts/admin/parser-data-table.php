<?php 
$link_1   = home_url() . '/wp-admin/edit.php?post_type=product&page=parser_data&parser=1&parser_page=1&type=courses';
$link_2   = home_url() . '/wp-admin/edit.php?post_type=product&page=parser_data&parser=1&parser_page=1&type=course-reviews';
$link_2_1 = home_url() . '/wp-admin/edit.php?post_type=product&page=parser_data&parser=1&parser_page=1&type=rewrite-course-reviews';
$link_3   = home_url() . '/wp-admin/edit.php?post_type=product&page=parser_data&parser=1&parser_page=1&type=school-reviews';
$link_3_1 = home_url() . '/wp-admin/edit.php?post_type=product&page=parser_data&parser=1&parser_page=1&type=rewrite-school-reviews';
$status_courses = get_option( 'parser_status_courses' );
$status_course_views = get_option( 'parser_status_course_views' );
$status_school_views = get_option( 'parser_status_school_views' );
?>

<h1>Парсер</h1>
<table id="parser_table" class="form-table" role="presentation">
    <tbody>
        <tr>
            <th scope="row">
                <label for="blogname">Кусры</label>
            </th>
            <td>
                <a class="button button-primary" href="<?php echo $link_1; ?>">Начать</a>
            </td>
            <td>
            </td>
            <td>
                <?php if ($status_courses) : ?>
                    <img src="<?php echo THEME_URI . '/img/preloader.gif'; ?>">
                <?php else : ?>
                    <img src="<?php echo THEME_URI . '/img/completed.png'; ?>">
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="blogname">Отзывы курсов</label>
            </th>
            <td>
                <a class="button button-primary" href="<?php echo $link_2; ?>">Начать</a>
            </td>
            <td>
                <a class="button button-primary" href="<?php echo $link_2_1; ?>">Рерайт с помощью Chat gpt</a>
            </td>
            <td>
                <?php if ($status_course_views) : ?>
                    <img src="<?php echo THEME_URI . '/img/preloader.gif'; ?>">
                <?php else : ?>
                    <img src="<?php echo THEME_URI . '/img/completed.png'; ?>">
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="blogname">Отзывы школ</label>
            </th>
            <td>
                <a class="button button-primary" href="<?php echo $link_3; ?>">Начать</a>
            </td>
            <td>
                <a class="button button-primary" href="<?php echo $link_3_1; ?>">Рерайт с помощью Chat gpt</a>
            </td>
            <td>
                <?php if ($status_school_views) : ?>
                    <img src="<?php echo THEME_URI . '/img/preloader.gif'; ?>">
                <?php else : ?>
                    <img src="<?php echo THEME_URI . '/img/completed.png'; ?>">
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
</table>