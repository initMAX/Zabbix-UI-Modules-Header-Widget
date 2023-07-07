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
 * Problems widget form view.
 *
 * @var CView $this
 * @var array $data
 */

(new CWidgetFormView($data))
    ->addField(
        new CWidgetFieldTextAreaView($data['fields']['content'])
    )
    ->addField(
        new CWidgetFieldCheckBoxView($data['fields']['allow_html_tags_in_content'])
    )
    ->addField(
        new CWidgetFieldSelectView($data['fields']['font_family'])
    )
    ->addField(
        new CWidgetFieldColorView($data['fields']['font_color']),
        'js-row-bg-color'
    )
    ->addField(
        new CWidgetFieldIntegerBoxView($data['fields']['font_size'])
    )
    ->addField(
		new CWidgetFieldCheckBoxListView($data['fields']['font_style'])
    )
    ->addField(
        new CWidgetFieldColorView($data['fields']['background_color']),
    )
	->includeJsFile('widget.edit.js.php')
    ->addJavaScript('widget_header_form.init();')
	->show();
