<?php declare(strict_types = 0);
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
 * Header widget form view
 *
 * @var CView $this
 * @var array $data
 */
$fields = $data['dialogue']['fields'];

$form = $data['form'];

$scripts = [];

$form_grid = CWidgetHelper::createFormGrid(
	$data['dialogue']['name'],
	$data['dialogue']['type'],
	$data['dialogue']['view_mode'],
	$data['known_widget_types'],
	$data['templateid'] === null ? $fields['rf_rate'] : null,
);

// Content
$form_grid->addItem([
	CWidgetHelper::getLabel($fields['content']),
	CWidgetHelper::getTextArea($fields['content'])
]);

// Show text as HTML
$form_grid->addItem([
	CWidgetHelper::getLabel($fields['show_as_html']),
	CWidgetHelper::getCheckBox($fields['show_as_html'])
]);

// Font
$form_grid->addItem([
	CWidgetHelper::getLabel($fields['font']),
	CWidgetHelper::getSelect($fields['font'])
]);

// Font size
$form_grid->addItem([
	CWidgetHelper::getLabel($fields['font_size']),
	CWidgetHelper::getIntegerBox($fields['font_size'])
]);

// Font color
$form_grid->addItem([
	CWidgetHelper::getLabel($fields['font_color']),
	CWidgetHelper::getColor($fields['font_color'], true)
		->addClass('form-field')
]);

// Font style
$form_grid->addItem([
	CWidgetHelper::getLabel($fields['font_style']),
	CWidgetHelper::getCheckBoxList($fields['font_style'], [
		0 => _('Bold'),
		1 => _('Italic'),
		2 => _('Underline')
	]),
]);

// Background color
$form_grid->addItem([
	CWidgetHelper::getLabel($fields['background_color']),
	CWidgetHelper::getColor($fields['background_color'], true)
		->addClass('form-field')
]);

$form->addItem($form_grid);

$form->addItem(new CScriptTag((new CView('widgets/header.form.view.js', $data))->getOutput()));

$form->addItem(
	(new CScriptTag('widget_configuration_form.init('.json_encode([
		'form_id' => $form->getId()
	]).')'))->setOnDocumentReady()
);

// $scripts[] = (new CView('widgets/header.form.view.js', $data))->getOutput();
// $widget_view['scripts'] = [
// 	(new CView('widgets/header.form.view.js', $data))->getOutput()
// ];

// return [
// 	'form' => $form,
// 	'scripts' => $scripts
// ];
