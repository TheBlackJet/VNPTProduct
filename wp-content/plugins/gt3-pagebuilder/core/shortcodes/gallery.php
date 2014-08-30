<?php

class show_gallery {

	public function register_shortcode($shortcodeName) {
		function shortcode_show_gallery($atts, $content = null) {
            $compile = "";

			extract( shortcode_atts( array(
                'heading_alignment' => 'left',
                'heading_size' => $GLOBALS["pbconfig"]['default_heading_in_module'],
                'heading_color' => '',
                'heading_text' => '',
                'preview_thumbs_format' => 'rectangle',
                'images_in_a_row' => '4',
                'width' => $GLOBALS["pbconfig"]['gallery_module_default_width'],
                'height' => $GLOBALS["pbconfig"]['gallery_module_default_height'],
                'galleryid' => '',
			), $atts ) );

            switch($images_in_a_row) {
                case '1':
                    if ($preview_thumbs_format == "square") {
                        $width = "570px";
                        $height = "570px";
                    } else {
                        $width = "570px";
                        $height = "401px";
                    }
                    $rowClass = "images_in_a_row_1";
                    break;
					
                case '2':
                    if ($preview_thumbs_format == "square") {
                        $width = "570px";
                        $height = "570px";
                    } else {
                        $width = "570px";
                        $height = "401px";
                    }
                    $rowClass = "images_in_a_row_2";
                    break;

                case '3':
                    if ($preview_thumbs_format == "square") {
                        $width = "570px";
                        $height = "570px";
                    } else {
                        $width = "570px";
                        $height = "401px";
                    }
                    $rowClass = "images_in_a_row_3";
                    break;

                case '4':
                    if ($preview_thumbs_format == "square") {
                        $width = "570px";
                        $height = "570px";
                    } else {
                        $width = "570px";
                        $height = "401px";
                    }
                    $rowClass = "images_in_a_row_4";
                    break;

                case 'fw':
                    if ($preview_thumbs_format == "square") {
                        $width = "570px";
                        $height = "570px";
                    } else {
                        $width = "570px";
                        $height = "401px";
                    }
                    $rowClass = "fw_gallery";
                    break;
            }

            #heading
            if (strlen($heading_color)>0) {$custom_color = "color:#{$heading_color};";}
            if (strlen($heading_text)>0) {
                $compile .= "<div class='bg_title'><".$heading_size." style='".(isset($custom_color) ? $custom_color : '') . ((strlen($heading_alignment) > 0 && $heading_alignment !== 'left') ? 'text-align:'.$heading_alignment.';' : '')."' class='headInModule'>{$heading_text}</".$heading_size."></div>";
            }

			$compile .= "<div class='list-of-images ".$rowClass."'>";

            $galleryPageBuilder = get_plugin_pagebuilder($galleryid);

            if (isset($galleryPageBuilder['sliders']['fullscreen']['slides']) && is_array($galleryPageBuilder['sliders']['fullscreen']['slides'])) {
                foreach ($galleryPageBuilder['sliders']['fullscreen']['slides'] as $image) {

                    if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {$photoTitleOutput = $image['title']['value'];} else {$photoTitleOutput = "";}
                    if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {$photoCaption  = $image['caption']['value'];} else {$photoCaption = "";}

                        $compile .= '
                        <div class="gallery_item">
							<div class="gallery_item_padding">
								<div class="gallery_item_wrapper">
									<a href="'.$image['src'].'" class="prettyPhoto" rel="prettyPhoto[gallery1]" title="'.$photoCaption.'">
										<img class="gallery-stand-img" src="'.aq_resize((($image['slide_type'] == "image") ? $image['src'] : $image['thumbnail']['value']), $width, $height, true, true, true).'" alt="'.$photoTitleOutput.'" width="'.substr($width, 0, -2).'" height="'.substr($height, 0, -2).'">
										<div class="gallery_fadder"></div>
										<div class="gallery_zoom_ico">
											<span><i class="icon-search"></i></span>
										</div>
									</a>
								</div>
							</div>
                        </div>
                        ';

                    unset($photoTitleOutput, $photoCaption);
                }
            }

			$compile .= "
            <div class='clear'></div>
            </div>
            ";
			
			return $compile;
			
		}
		add_shortcode($shortcodeName, 'shortcode_show_gallery');
	}
}

#Shortcode name
$shortcodeName="show_gallery";
$shortcode_show_gallery = new show_gallery();
$shortcode_show_gallery->register_shortcode($shortcodeName);

?>