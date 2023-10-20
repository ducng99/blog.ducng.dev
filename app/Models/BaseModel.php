<?php

namespace App\Models;

use App\Libraries\Storyblok;
use stdClass;

class BaseModel extends stdClass
{
    /**
     * The Storyblok UID
     */
    public string $_uid = '';

    /**
     * The component name
     */
    public string $component = '';

    /**
     * Storyblok Bridge HTML comment
     */
    public string $_editable = '';

    /**
     * Parse data from Storyblok to properties
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value)
        {
            if (property_exists($this, $key))
            {
                if (is_array($value) && array_is_list($value))
                {
                    $this->$key = [];

                    foreach ($value as $nestedComponent)
                    {
                        if (!empty($nestedComponent['component']))
                        {
                            $componentModelClass = Storyblok::getModelFromComponent($nestedComponent['component']);
                            $this->$key[] = new $componentModelClass($nestedComponent);
                        }
                        else
                        {
                            // Not a nested component, just a regular array
                            $this->$key[] = $nestedComponent;
                        }
                    }
                }
                else
                {
                    $this->$key = $value;
                }
            }
        }
    }
}
