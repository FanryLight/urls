<?php

class SenderController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Route('/sender/send')
     */
    public function sendAction() {
		if (empty($_POST['data'])) {
			echo json_encode(['error' => 'No data']);
			return;
		}
        $data = json_decode($_POST['data']);
		$data = preg_replace("/[\n]{2,}/i", "\n", $data);
		$data = trim($data, "\n");
		$data = explode("\n", $data);
		$urls = [];
		$result = [];
		foreach ($data as $path) {
			if (filter_var($path, FILTER_VALIDATE_URL)) {
				$url = new URL($path);
				$url->save();
				$urls[] = $url;
				$result[] = ['path' => $path, 'id' => $url->getId()];
			}
		}
		echo $result ? json_encode($result) : json_encode(['error' => 'Wrong data']);
		foreach ($urls as $url) {
			$this->send($url);
		}
    }
	
	/**
     * Route('/sender/check')
     */
	public function checkAction() {
		if (empty($_GET['id'])) {
			echo json_encode(['error' => 'No data']);
			return;
		}
		if ($url = URL::findById($_GET['id'])) {
			echo json_encode($url);
		} else {
			echo json_encode(['error' => 'Wrong id']);
		}
	}
	
	private function send($url) {
		if ($curl = curl_init()) {
			curl_setopt($curl, CURLOPT_URL, $url->getPath());
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			$out = curl_exec($curl);
			$url->setCode(curl_getinfo($curl)['http_code']);
			curl_close($curl);
			
			$title = '';
			$dom = new DOMDocument();
			if(@$dom->loadHTML('<?xml encoding="utf-8" ?>'.$out)) {
				$list = $dom->getElementsByTagName("title");
				if ($list->length > 0) {
					$title = $list->item(0)->textContent;
				}
			}
			if ($title) 
				$url->setTitle($title);
			
			$url->save();
		}
	}
}