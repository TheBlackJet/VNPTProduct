<?php

/* PB MODULES */
$modules['accordion']['name'] = "accordion";
$modules['accordion']['caption'] = "Accordion";
$modules['accordion']['help'] = __("Add simple accordion style with collapsible components.");

$modules['blog']['name'] = "blog";
$modules['blog']['caption'] = "Blog";
$modules['blog']['help'] = __("Display standard style blog to the page.");

$modules['feature_posts']['name'] = "feature_posts";
$modules['feature_posts']['caption'] = "Blog Posts";
$modules['feature_posts']['help'] = __("Display blog posts from different categories.");

$modules['content']['name'] = "content";
$modules['content']['caption'] = "Content";
$modules['content']['help'] = __("Display entire content available in the visual editor.");

$modules['divider']['name'] = "divider";
$modules['divider']['caption'] = "Divider";
$modules['divider']['help'] = __("Add divider to separate module blocks.");

$modules['google_map']['name'] = "google_map";
$modules['google_map']['caption'] = "Google Map";
$modules['google_map']['help'] = __("Add simple google map.");

$modules['html']['name'] = "html";
$modules['html']['caption'] = "HTML";
$modules['html']['help'] = __("Add any HTML code or shortcode to display on the page.");

$modules['title']['name'] = "title";
$modules['title']['caption'] = "Heading";
$modules['title']['help'] = __("Add simple heading.");

$modules['iconboxes']['name'] = "iconboxes";
$modules['iconboxes']['caption'] = "Icon Box";
$modules['iconboxes']['help'] = __("Add content block with the icon.");

$modules['javascript']['name'] = "javascript";
$modules['javascript']['caption'] = "Javascript";
$modules['javascript']['help'] = __("Add javascript code to run on the page.");

$modules['messageboxes']['name'] = "messageboxes";
$modules['messageboxes']['caption'] = "Message Box";
$modules['messageboxes']['help'] = __("Add different message box types.");

$modules['price_table']['name'] = "price_table";
$modules['price_table']['caption'] = "Price Table";
$modules['price_table']['help'] = __("Add simple and advanced price table.");

$modules['promo_text']['name'] = "promo_text";
$modules['promo_text']['caption'] = "Promo Text";
$modules['promo_text']['help'] = __("Add special promo text with call to action button.");

$modules['tabs']['name'] = "tabs";
$modules['tabs']['caption'] = "Tabs";
$modules['tabs']['help'] = __("Add tabbed content area.");

$modules['text_area']['name'] = "text_area";
$modules['text_area']['caption'] = "Text Area";
$modules['text_area']['help'] = __("Add simple text area.");

$modules['toggle']['name'] = "toggle";
$modules['toggle']['caption'] = "Toggle";
$modules['toggle']['help'] = __("Add simple toggle style with collapsible components.");

$modules['video']['name'] = "video";
$modules['video']['caption'] = "Video";
$modules['video']['help'] = __("Add vimeo or youtube video.");
/* END PB MODULES */

require_once("get-module-settings.php");

function get_pb_module($module_name, $module_caption, $moduleid, $pagebuilder, $module_size, $size_caption, $tinymce_activation_class = "")
{

    if (!isset($compile)) {
        $compile = '';
    }

    if (strlen($module_size) < 1) {
        $module_size = "block_1_4";
    }
    if (strlen($size_caption) < 1) {
        $size_caption = "1/4";
    }
    if (!is_array($pagebuilder)) {
        $pagebuilder = array();
        $pb_module_size_now = $GLOBALS["pbconfig"]['default_heading_in_module'];
    } else {
        $pb_module_size_now = (isset($pagebuilder['modules'][$moduleid]['heading_size']) ? $pagebuilder['modules'][$moduleid]['heading_size'] : '');
    }

    $all_items_before_html = "<li class='module-cont item-with-settings {$module_size}'><input type='hidden' value='{$module_size}' name='pagebuilder[modules][$moduleid][size]' class='current_size'><input type='hidden' value='{$module_name}' name='pagebuilder[modules][$moduleid][name]' class='module_name'><input type='hidden' value='{$module_caption}' name='pagebuilder[modules][$moduleid][caption]' class='module_caption'><input type='hidden' value='{$moduleid}' name='pagebuilder[modules][$moduleid][key]' class='module_key'><div class='innerpadding'><div class='top'><div class='caption'><span class='module-name'>{$module_caption}</span></div><div class='controls'><div class='dragger box-with-icon'><div class='border-right'></div><div class='border-left'></div><div class='control-element'></div></div><div class='delete box-with-icon'><div class='border-right'></div><div class='border-left'></div><div class='control-element'></div></div></div><div class='text-catch'></div></div><div class='bottom'><div class='left box-with-icon'><div class='control-element'></div></div><div class='size-caption box-with-icon'><div class='control-element'><span>{$size_caption}</span></div></div><div class='right box-with-icon'><div class='control-element'></div></div><div class='edit box-with-icon'><div class='border-right'></div><div class='border-left'></div><div class='control-element'></div></div></div></div><div class='edit_popup'>";
    $all_items_after_html = "</div></li>";

    $compile .= $all_items_before_html;

###########################################################################################
##################################### ACCORDION MODULE START ##############################
###########################################################################################
    if ($module_name == "accordion") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='fl'>
            <div class='heading line_option visual_style1 small_type hovered clickable add_new_accordion_section'>
                <div class='option_title text-shadow1'>" . __('Add new item', 'gt3_builder') . "</div>
                <div class='some-element cross'></div>
                <div class='pre_toggler'></div>
            </div>
        </div>
        <div class='fr desc_pop text-shadow1'>

        </div>
        <div class='clear'></div>
    </div>
    <div class='pb-popup-white-bg'>
        <div class='padding-cont pt25'>
            <ul class='sections accordion'>";
        if (isset($pagebuilder['modules'][$moduleid]['module_items']) && is_array($pagebuilder['modules'][$moduleid]['module_items'])) {
            foreach ($pagebuilder['modules'][$moduleid]['module_items'] as $itemid => $item) {
                $compile .= "
                <li class='section'>
                    <div class='heading line_option visual_style1 big_type'>
                        <div class='option_title text-shadow1'>{$item['title']}</div>
                        <div class='some-element clickable edit hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element movable move hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element clickable delete hovered'></div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='clear'></div>
                    <div class='hide_area'>
                        <div class='some-padding'>
                            <input type='text' class='expanded_text1 type1 section_name' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][title]' value='{$item['title']}'>
                            <textarea class='expanded_text1 type2 mt tinytextarea' id='" . $tinymce_activation_class . "' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][description]'>{$item['description']}</textarea>
                        </div>
                        <div class='expanded_state_cont'>
                            <span class='text-shadow1'>" . __('Expanded', 'gt3_builder') . "</span>
                        " . toggle_radio_yes_no("pagebuilder[modules][$moduleid][module_items][{$itemid}][expanded_state]", $item['expanded_state'], 'no', 'accordion_expanded_toggle') . "
                        </div>
                    </div>
                </li>
                ";
            }
        }
        $compile .= "</ul>
            <div class='clear'></div>
        </div>
    </div>
    <div class='dbg'></div>
    <div class='padding-cont'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
##################################### TOGGLE MODULE START #################################
###########################################################################################
    if ($module_name == "toggle") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='fl'>
            <div class='heading line_option visual_style1 small_type hovered clickable add_new_toggle_section'>
                <div class='option_title text-shadow1'>" . __('Add new item', 'gt3_builder') . "</div>
                <div class='some-element cross'></div>
                <div class='pre_toggler'></div>
            </div>
        </div>
        <div class='fr desc_pop text-shadow1'>

        </div>
        <div class='clear'></div>
    </div>
    <div class='pb-popup-white-bg'>
        <div class='padding-cont pt25'>
            <ul class='sections'>";
        if (isset($pagebuilder['modules'][$moduleid]['module_items']) && is_array($pagebuilder['modules'][$moduleid]['module_items'])) {
            foreach ($pagebuilder['modules'][$moduleid]['module_items'] as $itemid => $item) {
                $compile .= "
                <li class='section'>
                    <div class='heading line_option visual_style1 big_type'>
                        <div class='option_title text-shadow1'>{$item['title']}</div>
                        <div class='some-element clickable edit hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element movable move hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element clickable delete hovered'></div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='clear'></div>
                    <div class='hide_area'>
                        <div class='some-padding'>
                            <input type='text' class='expanded_text1 type1 section_name' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][title]' value='{$item['title']}'>
                            <textarea class='expanded_text1 type2 mt tinytextarea' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][description]'>{$item['description']}</textarea>
                        </div>
                        <div class='expanded_state_cont'>
                            <span class='text-shadow1'>" . __('Expanded', 'gt3_builder') . "</span>
                        " . toggle_radio_yes_no("pagebuilder[modules][$moduleid][module_items][{$itemid}][expanded_state]", $item['expanded_state'], 'no', 'toggles_expanded_toggle') . "
                        </div>
                    </div>
                </li>
                ";
            }
        }
        $compile .= "</ul>
            <div class='clear'></div>
        </div>
    </div>
    <div class='dbg'></div>
    <div class='padding-cont'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
####################################### FAQ MODULE START ##################################
###########################################################################################
    if ($module_name == "faq") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='fl'>
            <div class='heading line_option visual_style1 small_type hovered clickable add_new_toggle_section'>
                <div class='option_title text-shadow1'>" . __('Add new item', 'gt3_builder') . "</div>
                <div class='some-element cross'></div>
                <div class='pre_toggler'></div>
            </div>
        </div>
        <div class='fr desc_pop text-shadow1'>

        </div>
        <div class='clear'></div>
    </div>
    <div class='pb-popup-white-bg'>
        <div class='padding-cont pt25'>
            <ul class='sections'>";
        if (isset($pagebuilder['modules'][$moduleid]['module_items']) && is_array($pagebuilder['modules'][$moduleid]['module_items'])) {
            foreach ($pagebuilder['modules'][$moduleid]['module_items'] as $itemid => $item) {
                $compile .= "
                <li class='section'>
                    <div class='heading line_option visual_style1 big_type'>
                        <div class='option_title text-shadow1'>{$item['title']}</div>
                        <div class='some-element clickable edit hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element movable move hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element clickable delete hovered'></div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='clear'></div>
                    <div class='hide_area'>
                        <div class='some-padding'>
                            <input type='text' class='expanded_text1 type1 section_name' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][title]' value='{$item['title']}'>
                            <textarea class='expanded_text1 type2 mt tinytextarea' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][description]'>{$item['description']}</textarea>
                        </div>
                        <div class='expanded_state_cont'>
                            <span class='text-shadow1'>" . __('Expanded', 'gt3_builder') . "</span>
                        " . toggle_radio_yes_no("pagebuilder[modules][$moduleid][module_items][{$itemid}][expanded_state]", $item['expanded_state'], 'no', 'toggles_expanded_toggle') . "
                        </div>
                    </div>
                </li>
                ";
            }
        }
        $compile .= "</ul>
            <div class='clear'></div>
        </div>
    </div>
    <div class='dbg'></div>
    <div class='padding-cont'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
####################################### TABS MODULE START #################################
###########################################################################################
    if ($module_name == "tabs") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='fl'>
            <div class='heading line_option visual_style1 small_type hovered clickable add_new_accordion_section'>
                <div class='option_title text-shadow1'>" . __('Add new item', 'gt3_builder') . "</div>
                <div class='some-element cross'></div>
                <div class='pre_toggler'></div>
            </div>
        </div>
        <div class='fr desc_pop text-shadow1'>

        </div>
        <div class='clear'></div>
    </div>
    <div class='pb-popup-white-bg'>
        <div class='padding-cont pt25'>
            <ul class='sections'>";
        if (isset($pagebuilder['modules'][$moduleid]['module_items']) && is_array($pagebuilder['modules'][$moduleid]['module_items'])) {
            foreach ($pagebuilder['modules'][$moduleid]['module_items'] as $itemid => $item) {
                $compile .= "
                <li class='section'>
                    <div class='heading line_option visual_style1 big_type'>
                        <div class='option_title text-shadow1'>{$item['title']}</div>
                        <div class='some-element clickable edit hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element movable move hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element clickable delete hovered'></div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='clear'></div>
                    <div class='hide_area'>
                        <div class='some-padding'>
                            <input type='text' class='expanded_text1 type1 section_name' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][title]' value='{$item['title']}'>
                            <textarea class='expanded_text1 type2 mt tinytextarea' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][description]'>{$item['description']}</textarea>
                        </div>
                        <div class='expanded_state_cont'>
                            <span class='text-shadow1'>" . __('Expanded', 'gt3_builder') . "</span>
                        " . toggle_radio_yes_no("pagebuilder[modules][$moduleid][module_items][{$itemid}][expanded_state]", $item['expanded_state'], 'no', 'accordion_expanded_toggle') . "
                        </div>
                    </div>
                </li>
                ";
            }
        }
        $compile .= "</ul>
            <div class='clear'></div>
        </div>
    </div>
    <div class='dbg'></div>
    <div class='padding-cont'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################# BLOCKQUOTE MODULE START #################################
###########################################################################################
    if ($module_name == "blockquote") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>

    " . get_module_settings_part_textarea($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], "Quote text", "quote_text") . "

    " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], "Quote type", "quote_type", "200px", $GLOBALS["pbconfig"]['all_available_quote_types']) . "

    " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], "Author", "author_name", "100%", "left") . "
    " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
        <div class='clear'></div>
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
####################################### FEEDBACK FORM #####################################
###########################################################################################
    if ($module_name == "feedback_form") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    <div style='margin-bottom:20px;'></div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
########################################## DIAGRAMM #######################################
###########################################################################################
    if ($module_name == "diagramm") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont diagram_admin'>
		<div class='gt3_floated_option diagram_bg_wrapper'><h5>" . __('Bar Background', 'gt3_builder') . ":</h5>" . colorpicker_block("pagebuilder[modules][$moduleid][diagram_bg]", (isset($pagebuilder['modules'][$moduleid]['diagram_bg']) ? $pagebuilder['modules'][$moduleid]['diagram_bg'] : 'f2f2f2')) . "</div>
		<div class='gt3_floated_option diagram_bg_wrapper'><h5>" . __('Bar Color', 'gt3_builder') . ":</h5>" . colorpicker_block("pagebuilder[modules][$moduleid][diagram_color]", (isset($pagebuilder['modules'][$moduleid]['diagram_color']) ? $pagebuilder['modules'][$moduleid]['diagram_color'] : '0aa4ca')) . "</div>
		<div class='gt3_floated_option'>" . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __('Bar Width:', 'gt3_builder'), "bar_width", "95px", "left", "8px") . "</div>
		<div class='gt3_floated_option'>" . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __('Bar Size:', 'gt3_builder'), "diagram_size", "95px", "left", "60px") . "</div>
		<div class='gt3_floated_option'>" . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __('Font Size:', 'gt3_builder'), "percent_size", "95px", "left", "14px") . "</div>
		<div class='clear'></div>
	
        <div class='fl'>
            <div class='heading line_option visual_style1 small_type hovered clickable add_new_diagramm_section'>
                <div class='option_title text-shadow1'>" . __('Add new item', 'gt3_builder') . "</div>
                <div class='some-element cross'></div>
                <div class='pre_toggler'></div>
            </div>
        </div>
        <div class='fr desc_pop text-shadow1'>

        </div>
        <div class='clear'></div>
    </div>
    <div class='pb-popup-white-bg'>
        <div class='padding-cont pt25'>
            <ul class='sections accordion'>";
        if (isset($pagebuilder['modules'][$moduleid]['module_items']) && is_array($pagebuilder['modules'][$moduleid]['module_items'])) {
            foreach ($pagebuilder['modules'][$moduleid]['module_items'] as $itemid => $item) {
                $compile .= "
                <li class='section'>
                    <div class='heading line_option visual_style1 big_type'>
                        <div class='option_title text-shadow1'>{$item['title']}</div>
                        <div class='some-element clickable edit hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element movable move hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element clickable delete hovered'></div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='clear'></div>
                    <div class='hide_area'>
                        <div class='some-padding'>
                            <input type='text' class='expanded_text1 type1 section_name' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][title]' value='{$item['title']}'> " . __('Percent', 'gt3_builder') . ": <input type='text' class='expanded_text1 type1 section_name skill_percent' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][percent]' style='width:88px; text-align: center; margin-right: 2px; float: right;' value='{$item['percent']}'><input type='text' class='expanded_text1 type1 section_name  skill_description' name='pagebuilder[modules][$moduleid][module_items][{$itemid}][description]' value='{$item['description']}'>
                        </div>
                    </div>
                </li>
                ";
            }
        }
        $compile .= "</ul>
            <div class='clear'></div>
        </div>
    </div>
    <div class='dbg'></div>
    <div class='padding-cont'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################## GALLERY MODULE START ###################################
###########################################################################################
    if ($module_name == "gallery") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='enter_option_row'>
            <h5>" . __('Select gallery', 'gt3_builder') . "</h5>
            <select name='pagebuilder[modules][$moduleid][selected_gallery]' class='newselect' style='width:300px;'>";

        /* GET ALL GALL'S FOR SELECT */
        if (isset($wp_query)) {
            $temp = $wp_query;
        }
        $wp_query = null;
        $wp_query = new WP_Query();
        $args = array(
            'post_type' => 'gallery',
            'posts_per_page' => -1,
        );

        $compilegal = "";

        $wp_query->query($args);
        while ($wp_query->have_posts()) : $wp_query->the_post();

            if (isset($pagebuilder['modules'][$moduleid]['selected_gallery']) && $pagebuilder['modules'][$moduleid]['selected_gallery'] == get_the_ID()) {
                $selectedstate = "selected='selected'";
            } else {
                $selectedstate = "";
            }

            $compilegal .= "<option value='" . get_the_ID() . "' {$selectedstate}>" . get_the_title() . "</option>";

        endwhile;

        $compile .= $compilegal;

        if (!isset($pagebuilder['modules'][$moduleid]['image_width'])) {
            $pagebuilder['modules'][$moduleid]['image_width'] = $GLOBALS["pbconfig"]['gallery_module_default_width'];
        }

        if (!isset($pagebuilder['modules'][$moduleid]['image_height'])) {
            $pagebuilder['modules'][$moduleid]['image_height'] = $GLOBALS["pbconfig"]['gallery_module_default_height'];
        }

        $compile .= "
            </select>
            <div class='clear'></div>
        </div>
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __('Thumbs format preview', 'gt3_builder'), "preview_thumbs_format", "100px", array("rectangle" => "Rectangle", "square" => "Square")) . "
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __('Images in a row', 'gt3_builder'), "images_in_a_row", "100px", $GLOBALS["pbconfig"]['gallery_images_in_a_row']) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################ CONTACT INFO MODULE START ################################
###########################################################################################

    if ($module_name == "contact_info") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_any_icons($pagebuilder, $moduleid, __('Select icons', 'gt3_builder'), "contact_info_icons") . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################## SITEMAP MODULE START ###################################
###########################################################################################

    if ($module_name == "sitemap") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __('Show Site Feeds', 'gt3_builder'), "show_site_feeds", "200px", array('yes' => 'Yes', 'no' => 'No')) . "
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __('Show Posts', 'gt3_builder'), "show_posts", "200px", array('yes' => 'Yes', 'no' => 'No')) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
#################################### BLOG MODULE START ####################################
###########################################################################################
    if ($module_name == "blog") {

        if (isset($pagebuilder['modules'][$moduleid]['posts_per_page']) && strlen($pagebuilder['modules'][$moduleid]['posts_per_page']) < 1) {
            $pagebuilder['modules'][$moduleid]['posts_per_page'] = $GLOBALS["pbconfig"]['blog_default_posts_per_page'];
        }

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Posts per page", 'gt3_builder'), "posts_per_page", "100px", "center", $GLOBALS["pbconfig"]['blog_default_posts_per_page']) . "
        <div class='checkbox_wrapper'>" . get_module_settings_part_categories($pagebuilder, $moduleid, __("Categories", 'gt3_builder'), "cat_ids", "post") . "</div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
############################### BLOG MASONRY MODULE START #################################
###########################################################################################
    if ($module_name == "blog_masonry") {

        if (isset($pagebuilder['modules'][$moduleid]['posts_per_page']) && strlen($pagebuilder['modules'][$moduleid]['posts_per_page']) < 1) {
            $pagebuilder['modules'][$moduleid]['posts_per_page'] = $GLOBALS["pbconfig"]['blog_masonry_default_posts_per_page'];
        }

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Posts per page", "gt3_builder"), "posts_per_page", "100px", "center", $GLOBALS["pbconfig"]['blog_default_posts_per_page']) . "
		" . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Items per line", "gt3_builder"), "posts_per_line", "100px", "center", $GLOBALS["pbconfig"]['blog_default_posts_per_page']) . "
        <div class='checkbox_wrapper'>" . get_module_settings_part_categories($pagebuilder, $moduleid, __("Categories", "gt3_builder"), "cat_ids", "post") . "</div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################ LAYER SLIDER MODULE START ################################
###########################################################################################
    if ($module_name == "layer_slider") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_textarea_without_tiny($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Slider", "gt3_builder"), "html") . "
        <div class='example'>" . __("You can add any slider(plugin) that uses shortcodes. Please copy/paste the slider plugin shortcode to the content area above and click \"Done\".", "gt3_builder") . "</div>
    </div>
    <div class='padding-cont' style='padding-top:0;'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################# PORTFOLIO MODULE START ##################################
###########################################################################################
    if ($module_name == "portfolio") {

        if (isset($pagebuilder['modules'][$moduleid]['portfolio_per_page']) && strlen($pagebuilder['modules'][$moduleid]['portfolio_per_page']) < 1) {
            $pagebuilder['modules'][$moduleid]['portfolio_per_page'] = $GLOBALS["pbconfig"]['portfolio_default_posts_per_page'];
        }

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Items per page (Put the number of the items to load on the page)", "gt3_builder"), "posts_per_page", "100px", "center", $GLOBALS["pbconfig"]['posts_per_page']) . "
        " . get_module_settings_part_select($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("View type", "gt3_builder"), "view_type", "200px", $GLOBALS["pbconfig"]['all_available_portfolio_types']) . "
        " . get_module_settings_part_select($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Filter", "gt3_builder"), "filter", "200px", array("on", "off")) . "
        <div class='checkbox_wrapper'>" . get_module_settings_part_categories($pagebuilder, $moduleid, __("Categories", "gt3_builder"), "selected_categories", "port") . "</div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
############################# PORTFOLIO MASONRY MODULE START ##############################
###########################################################################################
    if ($module_name == "portfolio_masonry") {

        if (isset($pagebuilder['modules'][$moduleid]['portfolio_per_page']) && strlen($pagebuilder['modules'][$moduleid]['portfolio_per_page']) < 1) {
            $pagebuilder['modules'][$moduleid]['portfolio_per_page'] = $GLOBALS["pbconfig"]['portfolio_default_posts_per_page'];
        }

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Items per page (Put the number of the items to load on the page)", "gt3_builder"), "posts_per_page", "100px", "center", $GLOBALS["pbconfig"]['posts_per_page']) . "
        " . get_module_settings_part_select($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Filter", "gt3_builder"), "filter", "200px", array("on", "off")) . "
        <div class='checkbox_wrapper'>" . get_module_settings_part_categories($pagebuilder, $moduleid, __("Categories", "gt3_builder"), "selected_categories", "port") . "</div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################## PARTNERS MODULE START ##################################
###########################################################################################
    if ($module_name == "partners") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='checkbox_wrapper'>" . get_module_settings_part_cpts($pagebuilder, $moduleid, __("Select partners", "gt3_builder"), "cpt_ids", "partners") . "</div>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Items per line", "gt3_builder"), "partners_in_line", "100px", "center") . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################### FEATURED POSTS START ##################################
###########################################################################################
    if ($module_name == "feature_posts") {

        if (!isset($pagebuilder['modules'][$moduleid]['posts_per_line'])) {
            $pagebuilder['modules'][$moduleid]['posts_per_line'] = $GLOBALS["pbconfig"]['featured_posts_default_posts_per_line'];
        }

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Items per line", "gt3_builder"), "posts_per_line", "100px", $GLOBALS["pbconfig"]['available_posts_per_line']) . "
        <div class='checkbox_wrapper'>" . get_module_settings_part_categories($pagebuilder, $moduleid, __("Categories", "gt3_builder"), "selected_categories", "post") . "</div>
        " . get_module_settings_part_select($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Sorting type", "gt3_builder"), "sorting_type", "200px", $GLOBALS["pbconfig"]['featured_posts_available_sorting_type']) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################# FEATURED PORTFOLIO START ################################
###########################################################################################
    if ($module_name == "feature_portfolio") {

        if (!isset($pagebuilder['modules'][$moduleid]['number_of_posts'])) {
            $pagebuilder['modules'][$moduleid]['number_of_posts'] = $GLOBALS["pbconfig"]['featured_port_default_number_of_posts'];
        }

        if (!isset($pagebuilder['modules'][$moduleid]['posts_per_line'])) {
            $pagebuilder['modules'][$moduleid]['posts_per_line'] = $GLOBALS["pbconfig"]['featured_port_default_posts_per_line'];
        }

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Number of posts", "gt3_builder"), "number_of_posts", "100px", "center") . "
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Items per line", "gt3_builder"), "posts_per_line", "100px", $GLOBALS["pbconfig"]['available_posts_per_line']) . "
        <div class='checkbox_wrapper'>" . get_module_settings_part_categories($pagebuilder, $moduleid, __("Categories", "gt3_builder"), "selected_categories", "port") . "</div>
        " . get_module_settings_part_select($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Sorting type", "gt3_builder"), "sorting_type", "200px", $GLOBALS["pbconfig"]['featured_posts_available_sorting_type']) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################# PROMO TEXT MODULE START #################################
###########################################################################################
    if ($module_name == "promo_text") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Main text", "gt3_builder"), "main_text", "100%", "left") . "
        <div class='enter_option_row'>
            <h5>" . __('Main text color', 'gt3_builder') . "</h5>
            " . colorpicker_block("pagebuilder[modules][$moduleid][main_text_color]", (isset($pagebuilder['modules'][$moduleid]['main_text_color']) ? $pagebuilder['modules'][$moduleid]['main_text_color'] : '')) . "
            <div class='clear'></div>
        </div>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Additional text", "gt3_builder"), "additional_text", "100%", "left") . "
        <div class='enter_option_row'>
            <h5>" . __('Additional text color', 'gt3_builder') . "</h5>
            " . colorpicker_block("pagebuilder[modules][$moduleid][additional_text_color]", (isset($pagebuilder['modules'][$moduleid]['additional_text_color']) ? $pagebuilder['modules'][$moduleid]['additional_text_color'] : '')) . "
            <div class='clear'></div>
        </div>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Button text", "gt3_builder"), "button_text", "100%", "left") . "
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Button link", "gt3_builder"), "button_link", "100%", "left") . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################### DIVIDER MODULE START ##################################
###########################################################################################
    if ($module_name == "divider") {

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    <div class='padding-cont'>
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], "Divider type", "divider_color", "200px", $GLOBALS["pbconfig"]['all_available_dividers']) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
        <div class='clear'></div>
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
#################################### VIDEO MODULE START ###################################
###########################################################################################
    if ($module_name == "video") {

        if (isset($pagebuilder['modules'][$moduleid]['video_height']) && strlen($pagebuilder['modules'][$moduleid]['video_height']) < 1) {
            $pagebuilder['modules'][$moduleid]['video_height'] = $GLOBALS["pbconfig"]['default_video_height'];
        }

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='example'>" . __('Examples:<br>Youtube - http://www.youtube.com/watch?v=6v2L2UGZJAM<br>Vimeo - http://vimeo.com/47989207', 'gt3_builder') . "</div>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Video url", "gt3_builder"), "video_url", "100%", "left") . "
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Video height", "gt3_builder"), "video_height", "100px", "center", $GLOBALS["pbconfig"]['default_video_height']) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
#################################### TEAM MODULE START ####################################
###########################################################################################
    if ($module_name == "team") {

        if (!isset($pagebuilder['modules'][$moduleid]['number_of_workers']) || $pagebuilder['modules'][$moduleid]['number_of_workers'] < 1) {
            $pagebuilder['modules'][$moduleid]['number_of_workers'] = $GLOBALS["pbconfig"]['team_default_numbers'];
        }

        if (!isset($pagebuilder['modules'][$moduleid]['posts_per_line']) || $pagebuilder['modules'][$moduleid]['posts_per_line'] < 1) {
            $pagebuilder['modules'][$moduleid]['posts_per_line'] = 4;
        }

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
    <div class='checkbox_wrapper'>" . get_module_settings_part_cpts($pagebuilder, $moduleid, __("Select team members", "gt3_builder"), "cpt_ids", "team") . "</div>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Items per line", "gt3_builder"), "items_per_line", "100px", "center") . "
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Order type", "gt3_builder"), "order", "200px", array("ASC" => "Ascending", "DESC" => "Descending")) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
############################### TESTIMONIALS MODULE START #################################
###########################################################################################
    if ($module_name == "testimonial") {

        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='checkbox_wrapper'>" . get_module_settings_part_cpts($pagebuilder, $moduleid, __("Select testimonials", "gt3_builder"), "cpt_ids", "testimonials") . "</div>
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Items per line", "gt3_builder"), "testimonials_in_line", "100px", "center") . "
        " . get_module_settings_part_select($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Sorting type", "gt3_builder"), "sorting_type", "200px", $GLOBALS["pbconfig"]['all_available_testimonial_sorting_type']) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################## TEXT AREA MODULE START #################################
###########################################################################################
    if ($module_name == "text_area") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_textarea($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Text", "gt3_builder"), "text", $tinymce_activation_class) . "
        <div class='example'>" . __('You can use any HTML tags and shortcodes that are available in this plugin.', 'gt3_builder') . "</div>
    </div>
    <div class='padding-cont' style='padding-top:0;'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
##################################### HTML MODULE START ###################################
###########################################################################################
    if ($module_name == "html") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_textarea($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("HTML", "gt3_builder"), "html") . "
        <div class='example'>" . __('You can use HTML tags and shortcodes.', 'gt3_builder') . "</div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
############################### JAVASCRIPT MODULE START ###################################
###########################################################################################
    if ($module_name == "javascript") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_textarea($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Javascript", "gt3_builder"), "html") . "
        <div class='example'>" . __('You can use Javascript and shortcodes.', 'gt3_builder') . "</div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
###################################### BG START MODULE ####################################
###########################################################################################

    if ($module_name == "bg_start") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    <div class='padding-cont'>
		" . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Please set the custom top padding before the modules.", "gt3_builder"), "padding_top", "115px", "center", "40px") . "
        <div class='bg_start_style'>" . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Properties", "gt3_builder"), "properties", "200px", array("stretch" => "Stretch", "" => "Pattern", "paralax" => "Paralax")) . "</div>
        " . get_module_settings_part_upload_file($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Background image", "gt3_builder"), "bg_image", "90%") . "
        <div class='enter_option_row'>
            <h5>" . __('Background color', 'gt3_builder') . "</h5>
            " . colorpicker_block("pagebuilder[modules][$moduleid][bg_color]", (isset($pagebuilder['modules'][$moduleid]['bg_color']) ? $pagebuilder['modules'][$moduleid]['bg_color'] : '')) . "
            <div class='clear'></div>
        </div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
####################################### BG END MODULE #####################################
###########################################################################################
    if ($module_name == "bg_end") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    <div class='padding-cont'>
        <div class='enter_option_row'>
            The \"Background End\" module is integral part of \"Background Start\" module. Those modules can not work separately.
        </div>
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################## GOOGLE MAP MODULE START ################################
###########################################################################################
    if ($module_name == "google_map") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_textarea_without_tiny($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Google map code", "gt3_builder"), "map") . "
        <div class='example'>
            " . __('Example:', 'gt3_builder') . "<br>
            &lt;iframe width='100%' height='395' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://maps.google.ca/maps?f=q&source=s_q&hl=en&geocode=&q=New+York&sll=49.891235,-97.15369&sspn=47.259509,86.923828&ie=UTF8&hq=&hnear=New+York,+United+States&ll=40.714867,-74.005537&spn=0.019517,0.018797&z=14&iwloc=near&output=embed'&gt;&lt;/iframe&gt;
        <br><br>
            " . __("Code from <a href='https://maps.google.com/' target='_blank'>Google maps</a>", 'gt3_builder') . "
        </div>
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Full width", "gt3_builder"), "fullwidth_map", "200px", array("no" => "No", "yes" => "Yes")) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
#################################### CONTENT MODULE START #################################
###########################################################################################
    if ($module_name == "content") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='enter_option_row'>
            " . __('This module will display the entire content of the standard wordpress visual editor. Please note that you can use this module only once on the page.', 'gt3_builder') . "
        </div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################# SOCIAL SHARE MODULE START ###############################
###########################################################################################
    if ($module_name == "social_share") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        <div class='enter_option_row'>
            " . __('This module displays the social sharing buttons.', 'gt3_builder') . "
        </div>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
###################################### TITLE MODULE START #################################
###########################################################################################
    if ($module_name == "title") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################## ICONBOXES MODULE START #################################
###########################################################################################
    if ($module_name == "iconboxes") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_icons($pagebuilder, $moduleid, "Select icon", "icon_type") . "
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Iconbox heading", "gt3_builder"), "iconbox_heading", "100%", "left") . "
        " . get_module_settings_part_textarea($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Iconbox text", "gt3_builder"), "iconbox_text", $tinymce_activation_class) . "
        " . get_module_settings_part_input($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Link", "gt3_builder"), "link", "100%", "left") . "
       " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Target", "gt3_builder"), "target", "200px", array("_blank" => "Blank", "_self" => "Self")) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
        <div class='clear'></div>
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################ MESSAGEBOXES MODULE START ################################
###########################################################################################
    if ($module_name == "messageboxes") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_icons($pagebuilder, $moduleid, __("Select icon", "gt3_builder"), "icon_type") . "
        " . get_module_settings_part_textarea($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Message box text", "gt3_builder"), "messagebox_text", $tinymce_activation_class) . "
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Box type", "gt3_builder"), "box_type", "200px", $GLOBALS["pbconfig"]['messagebox_available_types']) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
        <div class='clear'></div>
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################ CUSTOM LIST MODULE START #################################
###########################################################################################
    if ($module_name == "custom_list") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class='padding-cont'>
        " . get_module_settings_part_add_list_ability($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("Add new list item", "gt3_builder")) . "
        " . get_module_settings_part_select_with_caption($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"], __("List type", "gt3_builder"), "list_type", "200px", $GLOBALS["pbconfig"]['all_available_custom_list_types']) . "
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
        <div class='clear'></div>
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


###########################################################################################
################################ PRICE TABLE MODULE START #################################
###########################################################################################
    if ($module_name == "price_table") {
        /* START POPUP HTML */
        $compile .= "
<h2>{$module_caption} settings</h2><span class='edit_popup_close'></span>
<div class='pop_scrollable_area'>
    " . get_module_settings_part_heading($pagebuilder, $moduleid, $pb_module_size_now, $GLOBALS["pbconfig"]) . "
    <div class=''>
        <div class='rows_must_be_here'>
            <div class='padding-cont'>
            <input type='hidden' value='{$moduleid}' class='moduleid' name='moduleid'>
            <div class='heading line_option visual_style1 small_type hovered clickable add_new_price_block'>
                <div class='option_title text-shadow1'>" . __('Add price item', 'gt3_builder') . "</div>
                <div class='some-element cross'></div>
                <div class='pre_toggler'></div>
            </div>
            <div class='clear'></div>
            </div>
            <div class='pb-popup-white-bg'>
            <div class='padding-cont'>
            <ul class='sections row-list' style='margin-top:7px !important;'>";
        if (isset($pagebuilder['modules'][$moduleid]['module_items']) && is_array($pagebuilder['modules'][$moduleid]['module_items'])) {
            foreach ($pagebuilder['modules'][$moduleid]['module_items'] as $itemid => $item) {
                $compile .= "

                <li class='section'>
                    <div class='heading line_option visual_style1 big_type'>
                        <div class='option_title text-shadow1'>" . ((isset($item['block_name']) && strlen($item['block_name']) > 0) ? $item['block_name'] : "&nbsp;") . "</div>
                        <div class='some-element clickable edit hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element movable move hovered'></div>
                        <div class='pre_toggler'></div>
                        <div class='some-element clickable delete hovered'></div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='clear'></div>
                    <div class='hide_area'>
                        <div class='some-padding'>
                            <div class='caption'>" . __('Name', 'gt3_builder') . "</div>
                            <input class='expanded_text type3' name='pagebuilder[modules][$moduleid][module_items][$itemid][block_name]' value='{$item['block_name']}'>
                            <div class='caption'>" . __('Price', 'gt3_builder') . "</div>
                            <input class='expanded_text type3' name='pagebuilder[modules][$moduleid][module_items][$itemid][block_price]' value='{$item['block_price']}'>
                            <div class='caption'>" . __('Period', 'gt3_builder') . "</div>
                            <input class='expanded_text type3' name='pagebuilder[modules][$moduleid][module_items][$itemid][block_period]' value='{$item['block_period']}'>
                            <div class='rows_must_be_here dark_lined'>
                                <input type='hidden' name='moduleid' class='moduleid' value='$moduleid'>
                                <input type='hidden' name='sectionid' class='sectionid' value='$itemid'>
                                <div class='heading line_option visual_style1 small_type hovered clickable add_new_price_feature'>
                                    <div class='option_title text-shadow1'>" . __('Add feature', 'gt3_builder') . "</div>
                                    <div class='some-element cross'></div>
                                    <div class='pre_toggler'></div>
                                </div>
                                <ul class='feature-list'>";
                if (isset($pagebuilder['modules'][$moduleid]['module_items'][$itemid]['price_features']) && is_array($pagebuilder['modules'][$moduleid]['module_items'][$itemid]['price_features'])) {
                    foreach ($pagebuilder['modules'][$moduleid]['module_items'][$itemid]['price_features'] as $featureid => $featuretext) {
                        $compile .= "
                        <li class='price_feature'>
                            <div class='heading line_option visual_style1 big_type'>
                                <div class='option_title text-shadow1'>$featuretext</div>
                                <div class='some-element2 clickable edit2 hovered'></div>
                                <div class='pre_toggler'></div>
                                <div class='some-element2 movable move hovered'></div>
                                <div class='pre_toggler'></div>
                                <div class='some-element2 clickable delete hovered'></div>
                                <div class='pre_toggler'></div>
                            </div>
                            <div class='clear'></div>
                            <div class='hide_area2'>
                                <div class='some-padding'>
                                <textarea class='expanded_text1 type2 mt' name='pagebuilder[modules][$moduleid][module_items][$itemid][price_features][$featureid]'>$featuretext</textarea>
                                </div>
                            </div>
                        </li>
                    ";
                    }
                }
                $compile .= "                   </ul>
                            </div>
                            <div class='caption'>" . __('"Get it now" Link', 'gt3_builder') . "</div>
                            <input class='expanded_text type3' name='pagebuilder[modules][$moduleid][module_items][$itemid][block_link]' value='{$item['block_link']}'>
                            <div class='caption'>" . __('"Get it now" caption', 'gt3_builder') . "</div>
                            <input class='expanded_text type3' name='pagebuilder[modules][$moduleid][module_items][$itemid][get_it_now_caption]' value='{$item['get_it_now_caption']}'>
                            <div class='caption' style='float:left; margin-top: 13px; margin-right: 15px;'>" . __('Most popular', 'gt3_builder') . "</div>

                            " . toggle_radio_yes_no("pagebuilder[modules][$moduleid][module_items][$itemid][most_popular]", $item['most_popular'], "no", "most_popular") . "

                            <div class='clear'></div>
                        </div>
                    </div>
                </li>

            ";
            }
        }
        $compile .= "
            </ul>
            <div class='clear'></div>
        </div>
        <div class='dbg'></div>
        </div>
        </div>
        <div class='clear'></div>
        </div>
        <div class='padding-cont'>
        " . get_module_settings_part_padding_bottom($pagebuilder, $moduleid) . "
    </div>
    " . get_module_settings_part_done_btn() . "
</div>
        ";
        /* END POPUP HTML */
    }
#MODULE END


    $compile .= $all_items_after_html;
    return $compile;
}

?>