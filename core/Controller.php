<?php
abstract class Controller {

    private $view;

    function __construct()
    {
        $this->view = new View();
    }

    /**
     * @return View
     */
    public function getView() {
        return $this->view;
    }
}