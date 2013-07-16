<?php

// +----------------------------------------------------------------------+
// | Copyright 2013  Madpixels  (email : visualizer@madpixels.net)        |
// +----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License, version 2, as  |
// | published by the Free Software Foundation.                           |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to the Free Software          |
// | Foundation, Inc., 51 Franklin St, Fifth Floor, Boston,               |
// | MA 02110-1301 USA                                                    |
// +----------------------------------------------------------------------+
// | Author: Eugene Manuilov <eugene@manuilov.org>                        |
// +----------------------------------------------------------------------+


/**
 * Base class for sidebar settings of linear based charts.
 *
 * @category Visualizer
 * @package Render
 * @subpackage Sidebar
 *
 * @since 1.0.0
 * @abstract
 */
abstract class Visualizer_Render_Sidebar_Linear extends Visualizer_Render_Sidebar_Graph {

	/**
	 * The array of available curve types.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 * @var array
	 */
	protected $_curveTypes;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @param array $data The data what has to be associated with this render.
	 */
	public function __construct( $data = array() ) {
		parent::__construct( $data );

		$this->_curveTypes = array(
			''         => '',
			'none'     => esc_html__( 'Straight line without curve', Visualizer_Plugin::NAME ),
			'function' => esc_html__( 'The angles of the line will be smoothed', Visualizer_Plugin::NAME ),
		);
	}

	/**
	 * Renders line settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _renderLineSettings() {
		self::_renderGroupStart( esc_html__( 'General Line Settings', Visualizer_Plugin::NAME ) );
			self::_renderSectionStart();
				self::_renderTextItem(
					esc_html__( 'Line Width', Visualizer_Plugin::NAME ),
					'lineWidth',
					$this->lineWidth,
					esc_html__( 'Data line width in pixels. Use zero to hide all lines and show only the points.', Visualizer_Plugin::NAME ),
					2
				);

				self::_renderTextItem(
					esc_html__( 'Point Size', Visualizer_Plugin::NAME ),
					'pointSize',
					$this->pointSize,
					esc_html__( 'Diameter of displayed points in pixels. Use zero to hide all points.', Visualizer_Plugin::NAME ),
					0
				);

				self::_renderSelectItem(
					esc_html__( 'Curve Type', Visualizer_Plugin::NAME ),
					'curveType',
					$this->curveType,
					$this->_curveTypes,
					esc_html__( 'Determines whether the series has to be presented in the legend or not.', Visualizer_Plugin::NAME )
				);

				self::_renderSelectItem(
					esc_html__( 'Focus Target', Visualizer_Plugin::NAME ),
					'focusTarget',
					$this->focusTarget,
					array(
						''         => '',
						'datum'    => esc_html__( 'Focus on a single data point.', Visualizer_Plugin::NAME ),
						'category' => esc_html__( 'Focus on a grouping of all data points along the major axis.', Visualizer_Plugin::NAME ),
					),
					esc_html__( 'The type of the entity that receives focus on mouse hover. Also affects which entity is selected by mouse click.', Visualizer_Plugin::NAME )
				);
			self::_renderSectionEnd();
		self::_renderGroupEnd();
	}

	/**
	 * Renders concreate series settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 * @param int $index The series index.
	 */
	protected function _renderSeries( $index ) {
		self::_renderSelectItem(
			esc_html__( 'Visible In Legend', Visualizer_Plugin::NAME ),
			'series[' . $index . '][visibleInLegend]',
			isset( $this->series[$index]['visibleInLegend'] ) ? $this->series[$index]['visibleInLegend'] : '',
			array(
				''  => '',
				'0' => esc_html__( 'No', Visualizer_Plugin::NAME ),
				'1' => esc_html__( 'Yes', Visualizer_Plugin::NAME ),
			),
			esc_html__( 'Determines whether the series has to be presented in the legend or not.', Visualizer_Plugin::NAME )
		);

		self::_renderTextItem(
			esc_html__( 'Line Width', Visualizer_Plugin::NAME ),
			'series[' . $index . '][lineWidth]',
			isset( $this->series[$index]['lineWidth'] ) ? $this->series[$index]['lineWidth'] : '',
			esc_html__( 'Overrides the global line width value for this series.', Visualizer_Plugin::NAME ),
			2
		);

		self::_renderTextItem(
			esc_html__( 'Point Size', Visualizer_Plugin::NAME ),
			'series[' . $index . '][pointSize]',
			isset( $this->series[$index]['pointSize'] ) ? $this->series[$index]['pointSize'] : '',
			esc_html__( 'Overrides the global point size value for this series.', Visualizer_Plugin::NAME ),
			0
		);

		self::_renderSelectItem(
			esc_html__( 'Curve Type', Visualizer_Plugin::NAME ),
			'series[' . $index . '][curveType]',
			isset( $this->series[$index]['curveType'] ) ? $this->series[$index]['curveType'] : '',
			$this->_curveTypes,
			esc_html__( 'Determines whether the series has to be presented in the legend or not.', Visualizer_Plugin::NAME )
		);

		self::_renderColorPickerItem(
			esc_html__( 'Color', Visualizer_Plugin::NAME ),
			'series[' . $index . '][color]',
			isset( $this->series[$index]['color'] ) ? $this->series[$index]['color'] : null,
			null
		);
	}

}