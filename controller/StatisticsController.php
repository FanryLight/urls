<?php

class StatisticsController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Route('/statistics')
     */
    public function indexAction() {
		$data = URL::getLastURLs();
		$this->getView()->generate('statistics', $data);
    }
	
	
	public function chartAction() {
		if (empty($_GET['id'])) {
			Route::ErrorPage404();
		}
		if (!$url = URL::findById($_GET['id'])) {
			Route::ErrorPage404();
		}
		$data = $url->getInfo();
		$info = [];
		$columns = [];
		foreach ($data as $row) {
			$info[$row['time']][$row['code']] = $row['count'];
			$columns[] = $row['code'];
		}
		$columns = array_unique($columns);
		$this->getView()->generate('chart', ['info' => $info, 'columns' => $columns, 'title' => $url->getPath()]);
	}
}