<?php
/**
 * Created by IntelliJ IDEA.
 * User: billy
 * Date: 01.06.2017
 * Time: 19:21
 */

namespace View;

abstract class BaseView implements View
{
    /**
     * @param array $vars
     * @return string
     */
    abstract public function renderBody(array $vars);

    /**
     * @inheritdoc
     */
    public function render(array $vars = [])
    {
        $vars['body'] = $this->renderBody($vars);

        return $this->renderTemplate("base", $vars);
    }

    /**
     * @param string $template Template name
     * @param array $vars Varibles
     *
     * @return string
     */
    protected function renderTemplate($template, array $vars = [])
    {
        $path = __DIR__ . "/../Resources/templates/$template.html";

        @$contents = file_get_contents($path);

        if (!$contents) {
            throw new \RuntimeException("Template '$path' doesnt exist");
        }

        foreach ($vars as $varName => $varValue) {
            $contents = str_replace("{{ $varName }}", $varValue, $contents);
        }

        return $contents;
    }
}