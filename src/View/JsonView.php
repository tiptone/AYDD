<?php

namespace Tiptone\Aydd\View;

use Tiptone\Aydd\View\View;

/**
 * Class JsonView
 * @package Tiptone\Aydd\View
 */
class JsonView extends View
{
    /**
     * Serialize to JSON
     * @return string
     */
    public function serialize()
    {
        $variables = $this->getVariables();

        reset($variables);

        if (count($variables) === 1 && key($variables) === 'json') {
            $data = array_pop($variables);

            return json_encode($data, JSON_PRETTY_PRINT);
        } else {
            return json_encode($variables, JSON_PRETTY_PRINT);
        }
    }
}
