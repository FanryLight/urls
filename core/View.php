<?php
class View
{
    /**
     * @param string $view
     * @param string $message
     * @param array $data
     */
    function generate($view, $data = null, $message = null)
    {
        include 'view/'.$view.'.php';
    }
}