<?php

class portfolio_masonry_shortcode
{
    public function register_shortcode($shortcodeName)
    {
        function shortcode_portfolio_masonry($atts, $content = null)
        {
            if (!isset($compile)) {$compile='';}

            extract(shortcode_atts(array(
                'heading_alignment' => 'left',
                'heading_size' => $GLOBALS["pbconfig"]['default_heading_in_module'],
                'heading_color' => '',
                'heading_text' => '',
                'posts_per_page' => '4',
                'filter' => 'on',
                'selected_categories' => '',
            ), $atts));

            #heading
            if (strlen($heading_color) > 0) {
                $custom_color = "color:#{$heading_color};";
            }
            if (strlen($heading_text) > 0) {
                $compile .= "<div class='bg_title'><" . $heading_size . " style='" . $custom_color . ((strlen($heading_alignment) > 0 && $heading_alignment !== 'left') ? 'text-align:' . $heading_alignment . ';' : '') . "' class='headInModule'>{$heading_text}</" . $heading_size . "></div>";
            }

            $post_type_terms = array();
            if (strlen($selected_categories) > 0) {
                $post_type_terms = explode(",", $selected_categories);
            }

            wp_enqueue_script('js_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
            wp_enqueue_script('js_sorting', get_template_directory_uri() . '/js/sorting.js');

            #Filter
            if ($filter == "on") {
                $compile .= showPortCatsMasonry($post_type_terms);
            }
			
			$compile .= '<div class="masonry_portfolio_preview container"><a href="javascript:void(0)" class="pf_preview_close"></a><div class="portfolio_preview_wrapper container"></div></div>';

            $compile .= '<div class="masonry_portfolio_block portfolio_block image-grid isotope" id="list">';
            global $wp_query_in_shortcodes;
            $wp_query_in_shortcodes = new WP_Query();
            global $paged;
            $args = array(
                'post_type' => 'port',
                'order' => 'DESC',
                'paged' => $paged,
                'posts_per_page' => $posts_per_page,
            );

            if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
                $post_type_terms = $_GET['slug'];
            }
            if (count($post_type_terms) > 0) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'portcat',
                        'field' => 'id',
                        'terms' => $post_type_terms
                    )
                );
            }

            $wp_query_in_shortcodes->query($args);

            $i = 1;

            while ($wp_query_in_shortcodes->have_posts()) : $wp_query_in_shortcodes->the_post();

                $pf = get_post_format();
                if (empty($pf)) $pf = "text";
                $pagebuilder = get_plugin_pagebuilder(get_the_ID());

                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
                if (strlen($featured_image[0]) < 1) {
                    $featured_image[0] = "";
                }

                if (isset($pagebuilder['page_settings']['portfolio']['work_link']) && strlen($pagebuilder['page_settings']['portfolio']['work_link']) > 0) {
                    $linkToTheWork = $pagebuilder['page_settings']['portfolio']['work_link'];
                    $target = "target='_blank'";
                } else {
                    $linkToTheWork = "javascript:void(0)";
                    $target = "";
                }

                if (!isset($echoallterm)) {
                    $echoallterm = '';
                }
                $new_term_list = get_the_terms(get_the_id(), "portcat");
                if (is_array($new_term_list)) {
                    foreach ($new_term_list as $term) {
                        $tempname = strtr($term->name, array(
                            ' ' => '-',
                        ));
                        $echoallterm .= strtolower($tempname) . " ";
                        $echoterm = $term->name;
                    }
                } else {
                    $tempname = 'Uncategorized';
                }

                #Portfolio 1
                    $port_content_show = ((strlen(get_the_excerpt()) > 0) ? get_the_excerpt() : smarty_modifier_truncate(get_the_content(), 470));

                    $compile .= '
						<div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element masonry_pf_item">
							<div class="portfolio_item_wrapper">
								<a href="'.$linkToTheWork.'" target="'.$target.'" class="portfolio_preview" data-url="' . get_permalink() . '">
									<div class="portfolio_item_img portfolio_item_img">										
										<img src="' . aq_resize($featured_image[0], "570", null, true, true, true) . '" alt="" width="570">
										<div class="masonry_pf_image_fadder"></div>
									</div>
									<div class="portfolio_content">
										<span class="masonry_pf_icon"></span>
										<h5 class="masonry_pf_title">' . get_the_title() . '</h5>
										<span class="masonry_pf_excerpt">'. smarty_modifier_truncate(get_the_excerpt(), 1400) .'</span>
									</div>
								</a>
							</div>
						</div>
						';
                $i++;
                unset($echoallterm, $pf);
            endwhile;

            $compile .= '<div class="clear"></div></div>';
            $compile .= get_plugin_pagination(10, "show_in_shortcodes");

            wp_reset_query();
            return $compile;
        }

        add_shortcode($shortcodeName, 'shortcode_portfolio_masonry');
    }
}

#Shortcode name
$shortcodeName = "portfolio_masonry";
$portfolio = new portfolio_masonry_shortcode();
$portfolio->register_shortcode($shortcodeName);
?>