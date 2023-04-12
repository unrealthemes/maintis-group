<?php 
$logo_id = get_field('logo_header', 'option');
$phone = get_field('phone_header', 'option');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Mantis Group description">
    <meta name="theme-color" content="#00AEF0">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo THEME_URI; ?>/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEME_URI; ?>/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEME_URI; ?>/img/favicon-16x16.png">
    <link rel="manifest" href="<?php echo THEME_URI; ?>/img/site.webmanifest">
    <!-- Google fonts -->
    <link rel="preload" href="https://fonts.googleapis.com">
    <link rel="preload" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head> 
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
    <header> 
        <div id="site-header" class="sticky">  
            <div class="container">
                <div class="row header_top">
                    <div class="header_top_vn">
                        
						<?php if ( $logo_id ) : ?>
							<div class="logo">
								<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
									<?php 
										$logo_url = wp_get_attachment_url( $logo_id, 'full' );
										if ( get_post_mime_type($logo_id) == 'image/svg+xml' ) :
											echo file_get_contents( $logo_url );
										else :
											echo '<img src="' . $logo_url . '" alt="Mantis Group logo">';
										endif;
									?>
								</a>
							</div> 
						<?php endif; ?> 
    
						<?php if ($phone) : ?>
							<div class="phone xs_vizible">
								<a href="tel:<?php echo esc_attr($phone); ?>">
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g clip-path="url(#clip0_142_3063)">
											<path d="M28.3334 24.1V26.6C28.3344 26.8321 28.2868 27.0618 28.1939 27.2745C28.1009 27.4871 27.9645 27.678 27.7935 27.8349C27.6225 27.9918 27.4206 28.1112 27.2007 28.1856C26.9809 28.2599 26.7479 28.2876 26.5168 28.2667C23.9525 27.988 21.4893 27.1118 19.3251 25.7083C17.3116 24.4289 15.6046 22.7218 14.3251 20.7083C12.9168 18.5343 12.0403 16.0592 11.7668 13.4833C11.7459 13.2529 11.7733 13.0206 11.8472 12.8014C11.921 12.5821 12.0397 12.3806 12.1957 12.2097C12.3517 12.0388 12.5416 11.9023 12.7533 11.8088C12.9649 11.7153 13.1937 11.6669 13.4251 11.6667H15.9251C16.3295 11.6627 16.7216 11.8059 17.0282 12.0696C17.3349 12.3333 17.5352 12.6995 17.5918 13.1C17.6973 13.9001 17.893 14.6856 18.1751 15.4417C18.2872 15.7399 18.3115 16.0641 18.245 16.3757C18.1786 16.6874 18.0242 16.9734 17.8001 17.2L16.7418 18.2583C17.9281 20.3446 19.6555 22.072 21.7418 23.2583L22.8001 22.2C23.0267 21.9759 23.3127 21.8215 23.6244 21.7551C23.936 21.6886 24.2602 21.7129 24.5584 21.825C25.3145 22.1071 26.1001 22.3028 26.9001 22.4083C27.3049 22.4654 27.6746 22.6693 27.9389 22.9812C28.2032 23.2932 28.3436 23.6913 28.3334 24.1Z" stroke="#00AEF0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</g>
										<rect x="0.5" y="0.5" width="39" height="39" rx="19.5" stroke="#00AEF0"/>
										<defs>
											<clipPath id="clip0_142_3063">
												<rect width="20" height="20" fill="white" transform="translate(10 10)"/>
											</clipPath>
										</defs>
									</svg>
								</a>
							</div> 
						<?php endif; ?>
    
                        <div class="header_menu">
                            <div class="mobile_menu_btn">
                                <a class="header_menu_btn" id="nav-icon4" href="#" onclick="return false">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
                            
                            <nav class="row header_nav">  
								<?php
									if ( has_nav_menu('menu_1') ) {
										wp_nav_menu( [
											'theme_location' => 'menu_1',
											'container'      => false,
											// 'walker'         => new UT_Mega_Menu(),
											'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										] );
									}
								?> 
                            </nav>
                        </div>      
                        
						<?php if ($phone) : ?>
							<div class="phone pk_vizible">
								<a href="tel:<?php echo esc_attr($phone); ?>">
									<?php echo esc_html($phone); ?>
								</a>
							</div> 
						<?php endif; ?>

                    </div>
            
                </div> 
            </div>  
        </div>
  
    </header>
    <main> 