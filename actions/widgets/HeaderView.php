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

use CControllerWidget;
use CControllerResponseData;

class HeaderView extends CControllerWidget
{

	public function __construct() {
		parent::__construct();

		$this->setType(HeaderForm::WIDGET_TYPE);
		$this->setValidationRules([
			'name' => 'string',
			'fields' => 'json',
			'initial_load' => 'in 0,1'
		]);
	}

	protected function doAction() 
	{
		$fields = $this->getForm()->getFieldsData();

		$this->setResponse(new CControllerResponseData([
			'name' => $this->getInput('name', $this->getDefaultName()),
			'initial_load' => (bool) $this->getInput('initial_load', 0),
			'fields' => [
				'content' => $fields['content'],
				'show_as_html' => $fields['show_as_html'],
				'font' => $fields['font'],
				'font_size' => $fields['font_size'],
				'font_color' => $fields['font_color'],
				'font_style' => $fields['font_style'],
				'background_color' => $fields['background_color']
			],
			'user' => [
				'debug_mode' => $this->getDebugMode()
			]
		]));
	}

}
