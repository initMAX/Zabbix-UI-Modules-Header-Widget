<?php

namespace Modules\Header\Includes;

use CTag;

class CDivHtml extends CTag
{
    public function __construct($items = null)
    {
        parent::__construct('div', true);

		$this->addItem($items);
    }

    public function addRawHtml($value)
	{
		array_push($this->items, $value);

		return $this;
	}
}
