<?php
/**
 * Created by IntelliJ IDEA.
 * User: billy
 * Date: 01.06.2017
 * Time: 19:27
 */

namespace View\IssPosition;

use View\BaseView;

class ShowView extends BaseView
{
    /**
     * @inheritdoc
     */
    public function renderBody(array $vars)
    {
        return $this->renderTemplate('IssPosition/show', $vars);
    }
}