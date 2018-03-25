<?php

class SiteController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Route('/')
     */
    public function indexAction() {
        $this->getView()->generate('site');
    }
	
	public function notFoundAction() {
		 $this->getView()->generate('404');
	}
}