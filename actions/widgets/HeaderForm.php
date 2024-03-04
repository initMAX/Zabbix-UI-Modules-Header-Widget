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

namespace Modules\Header\Actions\Widgets;

use CWidgetField;
use CWidgetFieldCheckBox;
use CWidgetFieldCheckBoxList;
use CWidgetFieldColor;
use CWidgetFieldIntegerBox;
use CWidgetFieldSelect;
use CWidgetFieldTextArea;
use CWidgetForm;

class HeaderForm extends CWidgetForm
{
    const WIDGET_TYPE = 'header';

    public function __construct($data, $templateid)
	{
        parent::__construct($data, $templateid, static::WIDGET_TYPE);
        
        $this->data = self::convertDottedKeys($this->data);

		// Header content
		$field_content = (new CWidgetFieldTextArea('content', _('Content')))
			->setFlags(CWidgetField::FLAG_LABEL_ASTERISK);

		if (array_key_exists('content', $this->data))
		{
			$field_content->setValue($this->data['content']);
		}

		$this->fields[$field_content->getName()] = $field_content;

		// Show as HTML
		$field_show_as_html = (new CWidgetFieldCheckBox('show_as_html', _('Show text as HTML')))
			->setDefault(0);

		if (array_key_exists('show_as_html', $this->data)) {
			$field_show_as_html->setValue($this->data['show_as_html']);
		}

		$this->fields[$field_show_as_html->getName()] = $field_show_as_html;

		// Font
		$field_font = (new CWidgetFieldSelect('font', _('Font'), [
			0 => 'Arial',
			1 => 'Georgia'
		]))
			->setDefault(9);

		if (array_key_exists('font', $this->data)) {
			$field_font->setValue($this->data['font']);
		}

		$this->fields[$field_font->getName()] = $field_font;	

		// Show fontsize
		$field_font_size = (new CWidgetFieldIntegerBox('font_size', _('Font size'), 
			8, // Minimum
			50 // Maximum
		))
			->setFlags(CWidgetField::FLAG_LABEL_ASTERISK)
			->setDefault(12);

		if (array_key_exists('font_size', $this->data)) {
			$field_font_size->setValue($this->data['font_size']);
		}

		$this->fields[$field_font_size->getName()] = $field_font_size;

		// Font color
		$field_font_color = (new CWidgetFieldColor('font_color', _('Font color')))
			->setFlags(CWidgetField::FLAG_LABEL_ASTERISK)
			->setDefault('');
		
		if (array_key_exists('font_color', $this->data)) {
			$field_font_color->setValue($this->data['font_color']);
		}

		$this->fields[$field_font_color->getName()] = $field_font_color;

		// Font style
		$field_font_style = new CWidgetFieldCheckBoxList('font_style', _('Font style'));

		if (array_key_exists('font_style', $this->data)) {
			$field_font_style->setValue($this->data['font_style']);
		}

		$this->fields[$field_font_style->getName()] = $field_font_style;
		
		// Background color
		$field_background_color = new CWidgetFieldColor('background_color', _('Background color'));
		
		if (array_key_exists('background_color', $this->data)) {
			$field_background_color->setValue($this->data['background_color']);
		}

		$this->fields[$field_background_color->getName()] = $field_background_color;
    }
}
