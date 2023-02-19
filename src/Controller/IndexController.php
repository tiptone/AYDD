<?php

namespace Tiptone\Aydd\Controller;

use Tiptone\Aydd\View\View;

/**
 * Class IndexController
 * @package Tiptone\Aydd\Controller
 */
class IndexController extends AbstractController
{
    public function indexAction()
    {
        return new View(['title' => 'YOGA']);
    }
}
