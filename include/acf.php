<?php


/*
  =====================
    Make Gutenber blocks full width & add styles
  =====================
*/
add_action('admin_head', 'my_custom_width_gutenberg');

function my_custom_width_gutenberg() {
    echo '<style>
    .wp-block{
        max-width: 95% !important;
    }
    .acf-block-body .acf-block-fields {
      border: 2px solid #000 !important;
	  border-radius: 10px;
    }
	.editor-styles-wrapper {
		background-color: #FFF !important;
	}
	.button, .page-title-action {
		border-radius: 40px !important;
	}
  </style>';
}

/*
=====================
	Add theme options menu
=====================
*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position' 		=> 2
	));

	acf_add_options_sub_page([
		'page_title' => "Header",
		'menu_title' => __("Header"),
		'menu_slug' => "header",
		'parent' => 'theme-options'
	]);

	acf_add_options_sub_page([
		'page_title' => "Footer",
		'menu_title' => __("Footer"),
		'menu_slug' => "footer",
		'parent' => 'theme-options'
	]);

	acf_add_options_sub_page([
		'page_title' => "Scripts",
		'menu_title' => __("Scripts"),
		'menu_slug' => "scripts",
		'parent' => 'theme-options'
	]);

}


/*
=====================
	ACF Maps block
=====================
*/
function map_acf_init() {
	$api_key = get_field('google_map_api_key', 'option');
	acf_update_setting('google_api_key', $api_key);
}
add_action('acf/init', 'map_acf_init');



/*
=====================
	Add custom block category
=====================
*/
add_filter('block_categories', function ($categories, $post) {
	$arr = array_merge(
		array(
			array(
				'slug' => 'hero',
				'title' => 'Hero',
			),
			array(
				'slug' => 'slider',
				'title' => 'Slider',
			),
			array(
				'slug' => 'content',
				'title' => 'Content',
			),
		),
		$categories
	);
	return $arr;
}, 10, 2);

if (function_exists('acf_register_block_type')) {
	add_action('acf/init', 'register_acf_block_types');
}


/*
=====================
	Gutenberg blocks
=====================
*/
function register_acf_block_types()
{

	// form
	acf_register_block_type(array(
		'name' => 'form',
		'title' => __('Form'),
		'description'   => __('Contact Form'),
		'render_template' => 'components/blocks/form.php',
		'category' => 'content',
		'icon' => 'block-default',
		'keywords' => array('Contact', 'Form'),
		'mode' => 'edit',
		'example'  => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'is_preview'    => true
				)
			)
		)
	));

	// map
	acf_register_block_type(array(
		'name' => 'map',
		'title' => __('Map'),
		'description'   => __('Map component'),
		'render_template' => 'components/blocks/map.php',
		'category' => 'content',
		'icon' => 'block-default',
		'keywords' => array('Map', 'Location'),
		'mode' => 'edit',
		'example'  => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'is_preview'    => true
				)
			)
		)
	));

	// ajax test
	acf_register_block_type(array(
		'name' => 'ajax-test',
		'title' => __('Ajax Test'),
		'description'   => __('Ajax Test component'),
		'render_template' => 'components/blocks/ajax-test.php',
		'category' => 'content',
		'icon' => 'block-default',
		'keywords' => array('Ajax', 'Test'),
		'mode' => 'edit',
		'example'  => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'is_preview'    => true
				)
			)
		)
	));

	// filters
	acf_register_block_type(array(
		'name' => 'filters',
		'title' => __('Filters'),
		'description'   => __('Filters component'),
		'render_template' => 'components/blocks/filters.php',
		'category' => 'content',
		'icon' => 'block-default',
		'keywords' => array('Filters', 'Search'),
		'mode' => 'edit',
		'example'  => array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'is_preview'    => true
				)
			)
		)
	));

}


/*
=====================
	Remove default blocks / only show:
=====================
*/
add_filter( 'allowed_block_types_all', 'allowed_block_types', 10, 2 );

function allowed_block_types( $allowed_blocks, $post ) {

	$all_blocks = [
		'acf/form',
		'acf/map',
		'acf/ajax-test',
		'acf/filters',
	];

	return $all_blocks;
}

<?php
// ...existing code...

if (function_exists('acf_add_local_field_group')) {

    acf_add_local_field_group([
        'key' => 'group_lumely_service',
        'title' => 'Lumely Service Page',
        'location' => [[[
            'param' => 'page_template',
            'operator' => '==',
            'value' => 'templates/lumely-service.php',
        ]]],
        'fields' => [
            ['key'=>'field_service_slug','label'=>'Service slug (for body class)','name'=>'service_slug','type'=>'text','instructions'=>'Example: render-enhancement, virtual-staging, design-options'],
            ['key'=>'field_hero_kicker','label'=>'Hero kicker','name'=>'hero_kicker','type'=>'text'],
            ['key'=>'field_hero_title','label'=>'Hero title','name'=>'hero_title','type'=>'text','required'=>1],
            ['key'=>'field_hero_subtitle','label'=>'Hero subtitle','name'=>'hero_subtitle','type'=>'textarea','rows'=>3],
            ['key'=>'field_hero_bg','label'=>'Hero background','name'=>'hero_background','type'=>'image','return_format'=>'array','preview_size'=>'medium','library'=>'all'],
            ['key'=>'field_hero_cta','label'=>'Hero CTA','name'=>'hero_cta','type'=>'link'],

            [
                'key'=>'field_badges','label'=>'Badges','name'=>'badges','type'=>'repeater',
                'layout'=>'row','button_label'=>'+ Add badge',
                'sub_fields'=>[
                    ['key'=>'field_badges_label','label'=>'Label','name'=>'label','type'=>'text'],
                ]
            ],
            [
                'key'=>'field_features','label'=>'Features','name'=>'features','type'=>'repeater',
                'min'=>3,'layout'=>'block','button_label'=>'+ Add feature',
                'sub_fields'=>[
                    ['key'=>'field_feature_icon','label'=>'Icon','name'=>'icon','type'=>'image','return_format'=>'array','preview_size'=>'thumbnail'],
                    ['key'=>'field_feature_title','label'=>'Title','name'=>'title','type'=>'text'],
                    ['key'=>'field_feature_text','label'=>'Text','name'=>'text','type'=>'textarea','rows'=>3],
                ]
            ],
            [
                'key'=>'field_gallery','label'=>'Gallery','name'=>'gallery','type'=>'repeater',
                'layout'=>'block','button_label'=>'+ Add image',
                'sub_fields'=>[
                    ['key'=>'field_gallery_img','label'=>'Image','name'=>'image','type'=>'image','return_format'=>'array','preview_size'=>'medium'],
                    ['key'=>'field_gallery_caption','label'=>'Caption','name'=>'caption','type'=>'text'],
                ]
            ],
            [
                'key'=>'field_process','label'=>'Process','name'=>'process','type'=>'repeater',
                'layout'=>'block','button_label'=>'+ Add step',
                'sub_fields'=>[
                    ['key'=>'field_process_title','label'=>'Step title','name'=>'step_title','type'=>'text'],
                    ['key'=>'field_process_text','label'=>'Step text','name'=>'step_text','type'=>'textarea','rows'=>2],
                ]
            ],
            [
                'key'=>'field_cta_block','label'=>'Bottom CTA','name'=>'cta_block','type'=>'group',
                'sub_fields'=>[
                    ['key'=>'field_cta_title','label'=>'Title','name'=>'title','type'=>'text'],
                    ['key'=>'field_cta_text','label'=>'Text','name'=>'text','type'=>'textarea','rows'=>2],
                    ['key'=>'field_cta_button','label'=>'Button','name'=>'button','type'=>'link'],
                ]
            ],
            [
                'key'=>'field_faq','label'=>'FAQs','name'=>'faq','type'=>'repeater','button_label'=>'+ Add Q&A',
                'sub_fields'=>[
                    ['key'=>'field_faq_q','label'=>'Question','name'=>'question','type'=>'text'],
                    ['key'=>'field_faq_a','label'=>'Answer','name'=>'answer','type'=>'wysiwyg','tabs'=>'visual','toolbar'=>'basic','media_upload'=>0],
                ]
            ],
        ],
    ]);
}
