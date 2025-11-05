<?php
// Copyright (c) 2025 The Khronos Group Inc.
// Copyright (c) 2016 Frédéric Guillot
//
// SPDX-License-Identifier: MIT

namespace Kanboard\Plugin\TagAutomaticAction;

use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\TagAutomaticAction\Action\TaskAssignTagCol;
use Kanboard\Plugin\TagAutomaticAction\Action\TaskAssignTagColSwimlane;

class Plugin extends Base
{
    public function initialize()
    {

        $this->actionManager->register(new TaskAssignTagColSwimlane($this->container));
        $this->actionManager->register(new TaskAssignTagCol($this->container));
    }

    public function getPluginName()
    {
        return 'TagAutomaticAction';
    }

    public function getPluginAuthor()
    {
        return 'Rylie Pavlik';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginDescription()
    {
        return 'Automatic actions for assigning tags';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/rpavlik/kanboard-plugin-auto-tag';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.46';
    }
}
