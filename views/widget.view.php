<?php
/*
** initMAX
** Copyright (C) 2021-2022 initMAX s.r.o.
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 3 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/

/**
 * Header widget view.
 *
 * @var CView $this
 * @var array $data
 */

use Modules\Header\Widget;
use Modules\Header\Includes\CDivHtml;

// Predefined list of fonts
$font_map = [
	0 => 'Georgia',
	1 => 'Palatino',
	2 => 'Times New Roman',
	3 => 'Arial',
	4 => 'Arial Black',
	5 => 'Comic Sans',
	6 => 'Impact',
	7 => 'Lucida Sans',
	8 => 'Tahoma',
	9 => 'Helvetica',
	10 => 'Verdana',
	11 => 'Courier New',
	12 => 'Lucida Console'
];

$header = new CDivHtml();

if ($this->data['fields_values']['allow_html_tags_in_content'] == 1) {
	$header->addRawHtml($this->data['fields_values']['content']);
}
else {
	$header->addItem($this->data['fields_values']['content']);
}

$wrapper = new CDiv($header);
$wrapper->addClass('dashboard-widget-header-wrapper');

$wrapper_style = new ArrayObject();
$wrapper_style->append('font-family: '. $font_map[$this->data['fields_values']['font_family']]);
$wrapper_style->append('font-size: '. $this->data['fields_values']['font_size'] .'px');
$wrapper_style->append('font-weight: '. ((in_array(Widget::FONT_STYLE_BOLD, $this->data['fields_values']['font_style'])) ? 'bold' : 'normal'));
$wrapper_style->append('font-style: '. ((in_array(Widget::FONT_STYLE_ITALIC, $this->data['fields_values']['font_style'])) ? 'italic' : 'normal'));
$wrapper_style->append('text-decoration: '. ((in_array(Widget::FONT_STYLE_UNDERLINE, $this->data['fields_values']['font_style'])) ? 'underline' : 'none'));
$wrapper_style->append('color: #' . $this->data['fields_values']['font_color']);
$wrapper_style->append('background-color: #'. $this->data['fields_values']['background_color']);

$wrapper->addStyle(implode('; ', (array) $wrapper_style));

$output = [];

if (array_key_exists('name', $this->data)) {
	$output['name'] = $this->data['name'];
}

$output['body'] = $wrapper->toString();

if ($messages = get_and_clear_messages()) {
	$output['messages'] = array_column($messages, 'message');
}

if (array_key_exists('user', $this->data) && $this->data['user']['debug_mode'] == GROUP_DEBUG_MODE_ENABLED) {
	CProfiler::getInstance()->stop();
	$output['debug'] = CProfiler::getInstance()->make()->toString();
}

echo json_encode($output, JSON_THROW_ON_ERROR);
