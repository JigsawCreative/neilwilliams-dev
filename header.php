<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php nw_theme_schema_type(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
</head>
<body <?php body_class('is-loading'); ?>>
    <?php wp_body_open(); ?>
        <header id="header" role="banner">
            <div class="menu-wrapper">
                <nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                    <div class="navbar">
                        <a href="/" aria-label="Home" class="logo-link" itemprop="url">
                            <svg class="logo" width="576" height="300" viewBox="0 0 576 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(0,-50)">
                                    <g class="ring-outer">
                                        <path d="M494.873 98.5701C461.048 61.6301 417.949 34.421 370.053 19.7694C322.156 5.11786 271.211 3.5583 222.508 15.2528" stroke="black" stroke-width="15"/>
                                        <path d="M568.5 288C568.5 224.333 546.841 162.56 507.082 112.833" stroke="black" stroke-width="15"/>
                                        <path d="M15 288C15 229.61 33.7209 172.759 68.4139 125.793C103.107 78.8281 151.944 44.2232 207.754 27.0601" stroke="black" stroke-width="30"/>
                                    </g>

                                    <g class="ring-mid-outer">
                                        <path d="M501.82 180.105C482.808 142.428 454.177 110.443 418.828 87.39" stroke="black" stroke-width="15"/>
                                        <path d="M527.5 288C527.5 256.409 521.25 225.13 509.11 195.964" stroke="black" stroke-width="15"/>
                                        <path d="M68.6421 212.461C79.7463 180.215 97.8232 150.814 121.586 126.351C145.348 101.888 174.212 82.965 206.121 70.9288C238.031 58.8926 272.202 54.0395 306.201 56.7151C340.2 59.3906 373.191 69.529 402.825 86.4084" stroke="black" stroke-width="30"/>
                                        <path d="M56 288C56 267.911 58.6092 247.907 63.7622 228.49" stroke="black" stroke-width="30"/>
                                    </g>

                                    <g class="ring-mid-inner">
                                        <path d="M486.5 288C486.5 236.924 466.812 187.813 431.53 150.882C396.248 113.95 348.088 92.0397 297.065 89.7071" stroke="black" stroke-width="15"/>
                                        <path d="M97 288C97 239.997 115.075 193.754 147.628 158.475C180.18 123.197 224.823 101.469 272.671 97.6161" stroke="black" stroke-width="30"/>
                                    </g>

                                    <g class="ring-inner">
                                        <path d="M138 288C138 264.669 143.442 241.66 153.894 220.802C164.346 199.943 179.519 181.81 198.208 167.844C216.897 153.878 238.586 144.464 261.551 140.35C284.516 136.236 308.124 137.536 330.498 144.146" stroke="black" stroke-width="30"/>
                                        <path d="M412.924 192.082C392.623 165.642 364.457 146.325 332.479 136.911" stroke="black" stroke-width="15"/>
                                        <path d="M445.5 288C445.5 261.461 438.794 235.352 426.004 212.098" stroke="black" stroke-width="15"/>
                                    </g>
                                    <circle class="logo-inner" cx="288.5" cy="287.5" r="71.5" fill="#D9D9D9" stroke="black" stroke-width="90"/>
                                </g>

                            </svg>

                        </a>
                        <div class="menu-button">
                            <span class="menu-span"></span>
                            <span class="menu-span"></span>
                            <span class="menu-span"></span>
                        </div>
                    </div>
                    <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
                </nav>
            </div>
        </header>
        
        <!-- Transition mask -->
        <?php
        $mask_colour = get_field('transition_colour') ?: '#3366cc'; // fallback if not set
        ?>
        <div class="transition-mask" style="background: <?php echo esc_attr($mask_colour); ?>;"></div>
        
        <div id="barba-wrapper" data-barba="wrapper">
            <div class="barba-container" data-barba="container" data-barba-namespace="<?php echo get_post_field('post_name'); ?>">        
                <main id="content" class="p1" role="main">