<?php
/**
 * @author  DevofWP
 * @since   1.0
 * @version 1.2
 */

namespace Walyatravels\Elementor\Addons;

use Elementor\Controls_Manager;
use Walyatravels\Helper\Fns;
use WALYA\Helpers\Fns as ThemeFns;
use Walyatravels\Abstracts\ElementorBase;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Post Class
 */
class Projects extends ElementorBase {

	/**
	 * Class Constructor
	 *
	 * @param $data
	 * @param $args
	 *
	 * @throws \Exception
	 */
	public function __construct( $data = [], $args = null ) {
		$this->walya_name = esc_html__( 'Packages', 'walyatravels' );
		$this->walya_base = 'walya-packages';
		parent::__construct( $data, $args );
	}

	/**
	 * Register Controls
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->content( $this );
		$this->thumbnail_settings( $this );
		$this->title_settings( $this );
		$this->excerpt_settings( $this );
		$this->meta_settings( $this );
		$this->readmore_settings( $this );
		$this->post_card_settings( $this );
	}

	/**
	 * Content Tab
	 *
	 * @param $object
	 *
	 * @return void
	 */
	protected function content( $object ) {
		// widget title
		$object->start_controls_section(
			'walya_post_grid',
			[
				'label' => esc_html__( 'Project Grid', 'walyatravels' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$object->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'walyatravels' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Grid 1', 'walya' ),
					'grid-2'  => __( 'Grid 2', 'walya' ),
					'grid-3'  => __( 'Grid 3', 'walya' ),
					'grid-4'  => __( 'Grid 4', 'walya' ),
					'list'    => __( 'List 1', 'walya' ),
					'list-2'  => __( 'List 2', 'walya' ),
				],

			]
		);
		$object->add_responsive_control(
			'grid_column',
			[
				'label'          => esc_html__( 'Grid Column', 'walyatravels' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '6',
				'mobile_default' => '12',
				'options'        => Fns::column_list(),

			]
		);

		$object->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'walyatravels' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1' => esc_html__( 'H1', 'walyatravels' ),
					'h2' => esc_html__( 'H2', 'walyatravels' ),
					'h3' => esc_html__( 'H3', 'walyatravels' ),
					'h4' => esc_html__( 'H4', 'walyatravels' ),
					'h5' => esc_html__( 'H5', 'walyatravels' ),
					'h6' => esc_html__( 'H6', 'walyatravels' ),
				],
			]
		);

		$object->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'walyatravels' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'walyatravels' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'walyatravels' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'walyatravels' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .article-inner-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$object->add_control(
			'field_visibility',
			[
				'label'     => __( 'Field Visibility', 'walyatravels' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$object->add_control(
			'thumbnail_visibility',
			[
				'label'   => esc_html__( 'Thumbnail Visibility', 'walyatravels' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$object->add_control(
			'excerpt_visibility',
			[
				'label'   => esc_html__( 'Excerpt Visibility', 'walyatravels' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$object->add_control(
			'meta_visibility',
			[
				'label'   => esc_html__( 'Meta Visibility', 'walyatravels' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$object->add_control(
			'readmore_visibility',
			[
				'label'   => esc_html__( 'Read More Visibility', 'walyatravels' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$object->add_control(
			'query_visibility',
			[
				'label'     => __( 'Query Settings', 'walyatravels' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$object->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Per Page', 'walyatravels' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'walyatravels' ),
				'description' => __( 'Enter number of post to show.', 'walyatravels' ),
				'default'     => '6',
			]
		);

		$object->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'walyatravels' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'walyatravels' ),
					'by_category' => __( 'By Category', 'walyatravels' ),
					'by_id'       => __( 'By Post ID', 'walyatravels' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'walyatravels' ),
			]
		);

		$object->add_control(
			'categories',
			[
				'type'                 => 'raw-select2',
				'label'                => esc_html__( 'Choose Categories', 'shopbuilder' ),
				'source_name'          => 'taxonomy',
				'source_type'          => 'walya-project-category',
				'multiple'             => true,
				'label_block'          => true,
				'minimum_input_length' => 1,
				'condition'            => [
					'post_source' => 'by_category',
				],
			]
		);

		$object->add_control(
			'post_id',
			[
				'type'                 => 'raw-select2',
				'label'                => __( 'Enter post IDs', 'walyatravels' ),
				'description'          => __( 'Enter the post IDs separated by comma', 'walyatravels' ),
				'source_name'          => 'post',
				'source_type'          => 'walya-project',
				'multiple'             => true,
				'label_block'          => true,
				'minimum_input_length' => 3,
				'condition'            => [
					'post_source' => 'by_id',
				],
			]
		);

		$object->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'walyatravels' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'walyatravels' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'walyatravels' ),
			]
		);

		$object->add_control(
			'exclude',
			[
				'type'                 => 'raw-select2',
				'label'                => __( 'Exclude posts', 'walyatravels' ),
				'description'          => __( 'Choose posts for exclude', 'walyatravels' ),
				'source_name'          => 'post',
				'source_type'          => 'walya-project',
				'multiple'             => true,
				'label_block'          => true,
				'minimum_input_length' => 3,
			]
		);

		$object->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'walyatravels' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'           => __( 'Date', 'walyatravels' ),
					'ID'             => __( 'Order by post ID', 'walyatravels' ),
					'author'         => __( 'Author', 'walyatravels' ),
					'title'          => __( 'Title', 'walyatravels' ),
					'modified'       => __( 'Last modified date', 'walyatravels' ),
					'parent'         => __( 'Post parent ID', 'walyatravels' ),
					'comment_count'  => __( 'Number of comments', 'walyatravels' ),
					'menu_order'     => __( 'Menu order', 'walyatravels' ),
					'meta_value'     => __( 'Meta value', 'walyatravels' ),
					'meta_value_num' => __( 'Meta value number', 'walyatravels' ),
					'rand'           => __( 'Random order', 'walyatravels' ),
				],
			]
		);

		$object->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'walyatravels' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC'  => __( 'ASC', 'walyatravels' ),
					'DESC' => __( 'DESC', 'walyatravels' ),
				],
			]
		);


		$object->end_controls_section();
	}

	/**
	 * Thumbnail Settings
	 *
	 * @param $object
	 *
	 * @return void
	 */
	protected function thumbnail_settings( $object ) {
		// Thumbnail style
		//========================================================
		$object->start_controls_section(
			'thumbnail_style',
			[
				'label'     => __( 'Thumbnail Style', 'walyatravels' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'thumbnail_visibility' => 'yes'
				]
			]
		);

		$object->add_control(
			'thumbnail_size',
			[
				'label'   => esc_html__( 'Image Size', 'walyatravels' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => Fns::image_size_lists(),
			]
		);

		$object->add_responsive_control(
			'image_height',
			[
				'label'      => __( 'Image Aspect (Out of 10)', 'walyatravels' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 20,
						'step' => .5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .post-thumbnail-wrap.post-grid .post-thumbnail' => 'aspect-ratio: 10 / {{SIZE}};',
				],
			]
		);

		$object->add_control(
			'thumb_box_radius',
			[
				'label'      => __( 'Thumbnail Radius', 'walyatravels' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .post-thumbnail-wrap .post-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		// Start Icon Style Tab.
		$object->start_controls_tabs(
			'icon_style_tabs'
		);

		// Normal Style.
		$object->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'walyatravels' ),
			]
		);

		$object->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'overlay_bg',
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Overlay Background', 'walyatravels' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}}.is-overlay-yes .post-thumbnail-wrap .post-thumbnail::before',
			]
		);

		$object->end_controls_tab();

		// Hover Style
		$object->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'walyatravels' ),
			]
		);

		$object->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'overlay_bg_hover',
				'fields_options' => [
					'background' => [
						'label' => esc_html__( 'Overlay Background:hover', 'walyatravels' ),
					],
				],
				'types'          => [ 'classic', 'gradient' ],
				'selector'       => '{{WRAPPER}}.is-overlay-yes .post-thumbnail-wrap .post-thumbnail::after',
			]
		);
		$object->end_controls_tab();

		$object->end_controls_tabs();
		// End Icon Style Tab.


		$object->end_controls_section();
	}

	/**
	 * Title Settings
	 *
	 * @param $object
	 *
	 * @return void
	 */
	protected function title_settings( $object ) {

		// Title Settings
		//=====================================================================
		$object->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'walyatravels' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$object->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .blog-post-card .entry-title',
			]
		);

		$object->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'walyatravels' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .blog-post-card .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '14',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$object->start_controls_tabs(
			'title_style_tabs'
		);

		$object->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'walyatravels' ),
			]
		);

		$object->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-card .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$object->end_controls_tab();

		$object->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'walyatravels' ),
			]
		);

		$object->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Hover Color', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-card .entry-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$object->end_controls_tab();

		$object->end_controls_tabs();

		$object->end_controls_section();
	}

	/**
	 * Excerpt Settings
	 *
	 * @param $object
	 *
	 * @return void
	 */
	protected function excerpt_settings( $object ) {
		// Content Settings
		//=====================================================================

		$object->start_controls_section(
			'content_style',
			[
				'label'     => __( 'Excerpt Style', 'walyatravels' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'excerpt_visibility' => 'yes'
				]
			]
		);

		$object->add_control(
			'content_limit',
			[
				'label'   => __( 'Excerpt Limit', 'walyatravels' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '15',
			]
		);

		$object->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .article-inner-wrapper .entry-content',
			]
		);

		$object->add_control(
			'content_spacing',
			[
				'label'              => __( 'Excerpt Spacing', 'walyatravels' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .article-inner-wrapper .entry-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$object->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .article-inner-wrapper .entry-content' => 'color: {{VALUE}}',
				],
			]
		);

		$object->end_controls_section();
	}

	/**
	 * Meta Settings
	 *
	 * @param $object
	 *
	 * @return void
	 */
	protected function meta_settings( $object ) {


		$object->start_controls_section(
			'meta_info_style',
			[
				'label'     => __( 'Meta Settings', 'walyatravels' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'meta_visibility' => 'yes'
				]
			]
		);

		$this->add_control(
			'meta_list',
			[
				'label'       => __( 'Choose Meta', 'walyatravels' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => ThemeFns::blog_meta_list(),
				'label_block' => true,
				'description' => __( 'Select post meta.', 'walyatravels' ),
			]
		);


		$object->add_control(
			'meta_author',
			[
				'label'   => esc_html__( 'Author Avatar', 'walyatravels' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => false,
			]
		);

		$object->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_meta_typography',
				'selector' => '{{WRAPPER}} .blog-box .post-content .post-meta a',
			]
		);

		$object->add_control(
			'above_cat_radius',
			[
				'label'      => __( 'Above Category Radius', 'walyatravels' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-post-card .separate-meta a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$object->start_controls_tabs(
			'post_meta_style_tabs'
		);

		$object->start_controls_tab(
			'post_meta_normal_tab',
			[
				'label' => __( 'Normal', 'walyatravels' ),
			]
		);


		$object->add_control(
			'meta_color',
			[
				'label'     => __( 'Meta Color', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .walya-post-meta' => 'color: {{VALUE}}',
				],
			]
		);

		$object->add_control(
			'author_color',
			[
				'label'     => __( 'Author Color', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .walya-post-meta .author a' => 'color: {{VALUE}}',
				],
			]
		);

		$object->end_controls_tab();

		$object->start_controls_tab(
			'post_meta_hover_tab',
			[
				'label' => __( 'Hover', 'walyatravels' ),
			]
		);

		$object->add_control(
			'link_hover_color',
			[
				'label'     => __( 'Meta Color:hover', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .walya-post-meta a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$object->end_controls_tab();

		$object->end_controls_tabs();

		$object->end_controls_section();
	}

	/**
	 * Read More Settings
	 *
	 * @param $object
	 *
	 * @return void
	 */
	protected function readmore_settings( $object ) {

		//Read More Style
		//====================

		$object->start_controls_section(
			'readmore_style',
			[
				'label'     => __( 'Read More Style', 'walyatravels' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'readmore_visibility' => 'yes'
				]
			]
		);


		$object->add_control(
			'readmore_text',
			[
				'label'       => __( 'Button Text', 'walyatravels' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Read More', 'walyatravels' ),
				'placeholder' => __( 'Type your title here', 'walyatravels' ),
			]
		);

		$object->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'readmore_typography',
				'selector' => '{{WRAPPER}} .blog-post-card .entry-footer .btn',
			]
		);

		$object->add_control(
			'readmore_spacing',
			[
				'label'              => __( 'Button Spacing', 'walyatravels' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .blog-post-card .entry-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$object->add_control(
			'readmore_padding',
			[
				'label'      => __( 'Button Padding', 'walyatravels' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-post-card .entry-footer .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$object->add_control(
			'btn_border_radius',
			[
				'label'      => __( 'Border Radius', 'walyatravels' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-post-card .entry-footer .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$object->add_control(
			'show_btn_icon',
			[
				'label'        => __( 'Show Button Icon', 'walyatravels' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'walyatravels' ),
				'label_off'    => __( 'Hide', 'walyatravels' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$object->add_control(
			'btn_icon',
			[
				'label'            => __( 'Choose Icon', 'walyatravels' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'recommended'      => [
					'fa-solid'   => [
						'chevron-right',
						'angle-right',
						'angle-double-right',
						'caret-right',
						'arrow-right',
						'caret-square-right',
						'long-arrow-alt-right'
					],
					'fa-regular' => [
						'caret-square-right',
						'arrow-right',
					],
				],
				'skin'             => 'inline',
				'label_block'      => false,
				'condition'        => [
					'show_btn_icon' => 'yes',
				],
			]
		);


		//Button style Tabs
		$object->start_controls_tabs(
			'readmore_style_tabs'
		);

		$object->start_controls_tab(
			'readmore_style_normal_tab',
			[
				'label' => __( 'Normal', 'walyatravels' ),
			]
		);

		$object->add_control(
			'readmore_color',
			[
				'label'     => __( 'Text Color', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-card .entry-footer .btn' => 'color: {{VALUE}}',
				],
			]
		);

		$object->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-card .entry-footer .btn :is(i, svg)' => 'color: {{VALUE}}',
				],
			]
		);

		$object->add_control(
			'readmore_bg',
			[
				'label'     => __( 'Background Color', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-card .entry-footer .btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$object->end_controls_tab();

		$object->start_controls_tab(
			'readmore_style_hover_tab',
			[
				'label' => __( 'Hover', 'walyatravels' ),
			]
		);

		$object->add_control(
			'readmore_color_hover',
			[
				'label'     => __( 'Text Color:hover', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-card .entry-footer .btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$object->add_control(
			'icon_color_hover',
			[
				'label'     => __( 'Icon Color:hover', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-card .entry-footer .btn:hover :is(i, svg)' => 'color: {{VALUE}}',
				],
			]
		);

		$object->add_control(
			'readmore_bg_hover',
			[
				'label'     => __( 'Background Color:hover', 'walyatravels' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-post-card .entry-footer .btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$object->end_controls_tab();

		$object->end_controls_tabs();
		$object->end_controls_section();

	}

	/**
	 * Post Card Styles
	 *
	 * @param $object
	 *
	 * @return void
	 */
	protected function post_card_settings( $object ) {
		$object->start_controls_section(
			'post_card_style',
			[
				'label' => __( 'Post Card Style', 'walyatravels' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'card_bg',
				'selector' => '{{WRAPPER}} .article-inner-wrapper',
				'types'    => [ 'classic', 'gradient' ],
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label'      => __( 'Padding', 'walyatravels' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .article-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$object->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'walyatravels' ),
				'selector' => '{{WRAPPER}} .article-inner-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'label'    => __( 'Border', 'walyatravels' ),
				'selector' => '{{WRAPPER}} .article-inner-wrapper',
			]
		);

		$object->add_control(
			'main_box_radius',
			[
				'label'      => __( 'Border Radius', 'walyatravels' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .article-inner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$object->end_controls_section();
	}

	/**
	 * Content Render
	 *
	 * @return void
	 */
	protected function render() {
		$data = $this->get_settings();

		$args = [
			'post_type'           => 'walya-project',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $data['post_limit'],
			'post_status'         => 'publish',
		];

		if ( ! empty ( $data['orderby'] ) ) {
			$args['orderby'] = $data['orderby'];
		}

		if ( ! empty( $data['order'] ) ) {
			$args['order'] = $data['order'];
		}

		if ( $data['post_source'] == 'by_category' && ! empty( $data['categories'] ) ) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'walya-project-category',
					'field'    => 'term_id',
					'terms'    => $data['categories'],
				],
			];
		}

		if ( $data['post_source'] == 'by_id' && ! empty( $data['post_id'] ) ) {
			$args['post__in'] = $data['post_id'];
		}

		if ( ! empty( $data['exclude'] ) ) {
			$args['post__not_in'] = $data['exclude'];
		}

		if ( $data['offset'] ) {
			$args['offset'] = $data['offset'];
		}

		$query = new \WP_Query( $args );

		$common_class = 'blog-post-card walya-project-item';
		$blog_style   = 'blog-' . $data['layout'];
		$masonry      = false ? 'masonry-item' : '';
		$post_classes = ThemeFns::class_list( [
			'blog-post-card',
			$common_class,
			$blog_style,
			$masonry,
			Fns::grid_column( $data )
		] );
		?>
		<div class="walya-el-project-wrapper project-grid <?php echo esc_attr( $data['layout'] ) ?>">
			<?php if ( $query->have_posts() ) : ?>
				<div class="row">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<article data-post-id="<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
							<?php Fns::get_template( "elementor/projects/project-{$data['layout']}", $data ); ?>
						</article>
					<?php
					endwhile; ?>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<?php
	}

}