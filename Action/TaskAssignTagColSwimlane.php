<?php
// Copyright (c) 2025 The Khronos Group Inc.
// Copyright (c) 2016 Frédéric Guillot
//
// SPDX-License-Identifier: MIT

namespace Kanboard\Plugin\TagAutomaticAction\Action;

use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;

/**
 * Assign tag on movement
 *
 * @package action
 * @author  Rylie Pavlik
 */
class TaskAssignTagColSwimlane extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Assign a tag when the task is moved to another column and swimlane');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_CREATE,
            TaskModel::EVENT_MOVE_COLUMN,
        );
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array(
            'column_id' => t('Column'),
            'swimlane_id' => t('Swimlane'),
            'tag' => t('Tag'),
        );
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'task_id',
            'task' => array(
                'project_id',
                'column_id',
                'swimlane_id',
            ),
        );
    }

    /**
     * Execute the action
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        $values = array(
            'id' => $data['task_id'],
            'project_id' => $data['task']['project_id'],
            'tags_only_add_new' => 1,
            'tags' => array($this->getParam('tag'),)
        );
        return $this->taskModificationModel->update($values);
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return $data['task']['column_id'] == $this->getParam('column_id') &&
            $data['task']['swimlane_id'] == $this->getParam('swimlane_id');
    }
}
