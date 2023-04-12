<?php 
$address = get_field('address');
?>

<div class="col_more">

    <?php if ( $address ) : ?>
        <div class="col_more_adres">
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.9" d="M16.6666 8.83334C16.6666 13.8333 9.99992 18.8333 9.99992 18.8333C9.99992 18.8333 3.33325 13.8333 3.33325 8.83334C3.33325 7.06523 4.03563 5.36954 5.28587 4.11929C6.53612 2.86905 8.23181 2.16667 9.99992 2.16667C11.768 2.16667 13.4637 2.86905 14.714 4.11929C15.9642 5.36954 16.6666 7.06523 16.6666 8.83334Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path opacity="0.9" d="M10 11.3333C11.3807 11.3333 12.5 10.214 12.5 8.83333C12.5 7.45262 11.3807 6.33333 10 6.33333C8.61929 6.33333 7.5 7.45262 7.5 8.83333C7.5 10.214 8.61929 11.3333 10 11.3333Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg> 
            <?php echo $address; ?>
        </div>
    <?php endif; ?>

    <div class="site_send">
        <a data-fancybox data-src="#share" href="javascript:;">
            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.5 13V16.3333C17.5 16.7754 17.3244 17.1993 17.0118 17.5118C16.6993 17.8244 16.2754 18 15.8333 18H4.16667C3.72464 18 3.30072 17.8244 2.98816 17.5118C2.67559 17.1993 2.5 16.7754 2.5 16.3333V13" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14.1666 7.16667L9.99992 3L5.83325 7.16667" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 3V13" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg> 
            Поделиться
        </a>
    </div>
</div>  