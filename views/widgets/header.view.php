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
 * @var CView $this
 */

use Modules\Header\Helpers\Html\CDivHtml;

// Predefined list of fonts
$font_map = [
	'Arial, sans-serif',
	'Georgia, serif'
];

// Fields
$content = $data['fields']['content'];
$show_as_html = $data['fields']['show_as_html'];
$font = $data['fields']['font'];
$font_size = $data['fields']['font_size'];
$font_color = $data['fields']['font_color'];
$font_style = $data['fields']['font_style'];
$font_style_bold = in_array(0, $font_style);
$font_style_italic = in_array(1, $font_style);
$font_style_underline = in_array(2, $font_style);
$background_color = $data['fields']['background_color'];

// Div style
$div_style = new ArrayObject();
$div_style->append('display: flex');
$div_style->append('width: 100%');
$div_style->append('height: 100%');
$div_style->append('font-family: '. $font_map[$font]);
$div_style->append('font-size: '. $font_size .'px');
$div_style->append('font-weight: '. ($font_style_bold ? 'bold' : 'normal'));
$div_style->append('font-style: '. ($font_style_italic ? 'italic' : 'normal'));
$div_style->append('text-decoration: '. ($font_style_underline ? 'underline' : 'none'));
$div_style->append('color: #' . $font_color);
$div_style->append('background-color: #'. $background_color);
$div_style->append('justify-content: center');
$div_style->append('align-items: center');

// Div
$header = new CDivHtml($content);
$header->addStyle(implode('; ', (array) $div_style));

// Output body
if($show_as_html === 0)
{
	$body = $header->toString();
}
else
{
	$body = '<div style=\''. implode('; ', (array) $div_style) . '\'>' . $content . '</div>';
}

// Compose output
$output = [
	'name' => $data['name'],
	'body' => $body
];

if (($messages = getMessages()) !== null)
{
	$output['messages'] = $messages->toString();
}

if ($data['user']['debug_mode'] == GROUP_DEBUG_MODE_ENABLED)
{
	CProfiler::getInstance()->stop();
	$output['debug'] = CProfiler::getInstance()->make()->toString();
}

echo json_encode($output);
