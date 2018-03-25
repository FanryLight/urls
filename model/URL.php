<?php

class URL implements JsonSerializable
{
    private $id;
    private $path;
    private $code;
    private $title;
    private $date;
	

    public function __construct($path, $id = null)
    {
        $this->path = $path;
		$this->code = 0;
		$this->title = 'undefined';
		$this->date = date('Y-m-d H:i:s', time());
        $this->id = $id;
    }

	public function jsonSerialize() {
		return [
			'path' => $this->path,
			'code' => $this->code,
			'title' => $this->title,
			'date' => $this->date,
		];
	}

    public function save() {
        $dbConnector = DBConnector::getInstance();
        if ($this->id) {
            $query = "UPDATE urls SET path = ?, code = ?, title = ?, date = ? WHERE id = $this->id";
        } else {
            $query = "INSERT INTO urls (path, code, title, date) VALUES (?, ?, ?, ?)";
        }
		
        $stmt = $dbConnector->prepare($query);
        $stmt->execute([$this->path, $this->code, $this->title, $this->date]);
        if (!$this->id) {
            $this->id = $dbConnector->lastInsertId();
        }
    }

    public static function findById($id) {
        $query = "SELECT * FROM urls WHERE id = $id";
        return self::findByQuery($query);
    }
	
	public static function getLastURLs() {
		$query = "SELECT * FROM urls u WHERE date = (SELECT MAX(s.date) FROM urls s WHERE u.path LIKE s.path AND s.code > 0) GROUP BY u.path";
		$dbConnector = DBConnector::getInstance();
        $stmt = $dbConnector->query($query);
        if (!$stmt) {
            return [];
        }
		return $stmt->fetchAll();
	}
	
	public function getInfo() {
		$query = "SELECT code, DATE(date) AS time, COUNT(*) AS count FROM urls
					WHERE path like ? AND code > 0
					GROUP BY time, code";
		$dbConnector = DBConnector::getInstance();
        $stmt = $dbConnector->prepare($query);
        $stmt->execute([$this->path]);
        if (!$stmt) {
            return [];
        }
		return $stmt->fetchAll();
	}

    private static function findByQuery($query) {
        $dbConnector = DBConnector::getInstance();
        $stmt = $dbConnector->query($query);
        if (!$stmt) {
            return null;
        }
        $info = $stmt->fetch();
        if ($info) {
            $url = new self($info['path'], $info['id']);
            $url->code = $info['code'];
            $url->title = $info['title'];
            $url->date = $info['date'];
            return $url;
        }
        return null;
    }

	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function setCode($code) {
		$this->code = $code;
	}

    public function getPath() {
        return $this->path;
    }

    public function getId() {
        return $this->id;
    }

}