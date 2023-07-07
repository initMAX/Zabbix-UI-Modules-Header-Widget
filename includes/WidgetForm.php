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

namespace Modules\Header\Includes;

use Modules\Header\Widget;
use Zabbix\Widgets\CWidgetField;
use Zabbix\Widgets\CWidgetForm;
use Zabbix\Widgets\Fields\CWidgetFieldCheckBox;
use Zabbix\Widgets\Fields\CWidgetFieldCheckBoxList;
use Zabbix\Widgets\Fields\CWidgetFieldColor;
use Zabbix\Widgets\Fields\CWidgetFieldIntegerBox;
use Zabbix\Widgets\Fields\CWidgetFieldSelect;
use Zabbix\Widgets\Fields\CWidgetFieldTextArea;

/**
 * Header widget form.
 */
class WidgetForm extends CWidgetForm {

	protected function normalizeValues(array $values): array {
		$values = self::convertDottedKeys($values);

		return $values;
	}

	public function addFields(): self {
		return $this
			->addField(
				(new CWidgetFieldTextArea('content', _('Content')))
					->setFlags(CWidgetField::FLAG_LABEL_ASTERISK)
			)
			->addField(
				new CWidgetFieldCheckBox('allow_html_tags_in_content', _('Allow HTML tags in content'))
			)
			->addField(
				$this->createFontSelect('font_family')
					->setDefault(3)
			)
			->addField(
				(new CWidgetFieldIntegerBox('font_size', _('Font size'), 0, 100))
					->setDefault(20)
			)
			->addField(
				new CWidgetFieldColor('font_color', _('Font color'))
			)
			->addField(
				new CWidgetFieldCheckBoxList('font_style', _('Font style'), [
					Widget::FONT_STYLE_BOLD => _('Bold'),
					Widget::FONT_STYLE_UNDERLINE => _('Underline'),
					Widget::FONT_STYLE_ITALIC => _('Italic'),
				])
			)
			->addField(
				new CWidgetFieldColor('background_color', _('Background color'))
			)
			;
	}

	function createFontSelect(string $name): CWidgetFieldSelect {
		return (new CWidgetFieldSelect($name, _('Font family'), [
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
		]));
	}
}
