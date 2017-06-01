<?php
/**
 * Created by IntelliJ IDEA.
 * User: billy
 * Date: 01.06.2017
 * Time: 19:21
 */

namespace View;


interface View
{
    /**
     * @param array $vars
     * @return string
     */
    public function render(array $vars = []);
}