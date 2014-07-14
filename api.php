<?php

define('count_per_page', 20);

class Baseinfo {
	function __construct($arg=False){
		try {
			$this->db = new PDO('mysql:dbname=swzl_ecjtu_net;host=127.0.0.1', 'swzl_ecjtu_net', 'EcjtuNetSwzl_17#409');
		}catch (PDOException $e) {
		    $this->output_msg = 'Database error';
		}
		if ($arg===False) {
			//pass..
		}elseif (is_array($arg)) {
			$this->fields = $arg;
		}else{
			$arg = intval($arg);
			$result = $this->db->query('SELECT * FROM ' . $this->table . 
				' INNER JOIN `category` ' .
				'ON category.cid = ' . $this->table . '.category ' . 
				'WHERE ' . $this->table . '.' . $this->id . " = $arg")
				->fetch(PDO::FETCH_ASSOC);
			if (!$result) {
				$this->output_msg = 'Not Found';
			}else{
				$result['id'] = $result[$this->id];
				unset($result[$this->id]);
				$result['type'] = $this->type;
				$this->fields = $result;
				$this->output_msg = json_encode($this->fields);
			}
		}
	}
	function __toString(){
		return $this->output_msg;
	}
	function find($args, $page, $count=False){
		if (!is_array($args)) {
			$count = $page;
			$page = $args;
			$args = array();
		}
		$sql = 'SELECT * FROM ' . $this->table . 
				' INNER JOIN `category` 
				ON category.cid = ' . $this->table . '.category ';
		if ($args) {
			$sql .= ' WHERE ';
		}
		if (isset($args['key'])) {
			$key = $args['key'];
			$sql .= " name LIKE %$key%";
		}
		if (isset($args['after'])) {
			$time = strtotime($args['after']);
			$sql .= " time>$time ";
		}
		if (isset($args['category'])) {
			$sql .= " category = " . $args['category'];
		}
		$page = intval($page);
		$count = intval($count);
		$begin = ($page-1) * $count;
		if ($page>0 && $count>0) {
			$sql .= " LIMIT $begin,$count ";
			$result = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			if (!$result) {
				$this->output_msg = 'Cannot find';
			}else{
				foreach ($result as $key => $value) {
					$result[$key]['id'] = $result[$key][$this->id];
					unset($result[$key][$this->id]);
					$result[$key]['type'] = $this->type;
				}
				$this->output_msg = json_encode(array(
					'count'=>count($result),
					'list'=>$result
				));
			}
		}
		return $this;
	}
	function save(){
		if (!isset($this->fields)) {
			return false;
		}else{
			$fields = array();
			foreach ($this->fields as $key => $value) {
				$fields[':'.$key] = $value;
			}
			$result = $this->db->prepare('INSERT INTO ' . $this->table . '(category,name,place,time,description,owner,phone) 
				VALUES((SELECT `cid` FROM `category` WHERE `cname` = :cname),:name,:place,:time,:description,:owner,:phone)')
				->execute($fields);
			if (!$result) {
				$this->output_msg = 'Insert Error';
			}
			return $this;
		}
	}
	function output(){
		return $this->output_msg;
	}
}

class Found extends Baseinfo{
	protected $type = 'found';
	protected $id = 'fid';
	protected $table = 'found';
}

class Lost extends Baseinfo{
	protected $type = 'lost';
	protected $id = 'lid';
	protected $table = 'lost';
}

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
\Slim\Route::setDefaultConditions(array(
    'id' => '[0-9]+',
    'page' => '[0-9]+'
));
$app = new \Slim\Slim();
$app->get('/index', function () use ($app) {
	echo 'hello';
	var_dump($app->request->get());
});

$app->get('/found/:id', function ($id) {
	echo new Found($id);
	return true;
});

$app->get('/lost/:id', function ($id) {
	echo new Lost($id);
	return true;
});

$app->get('/losts(/:page)', function ($page=1) {
	$lost = new Lost();
	echo $lost->find($page, count_per_page);
	return true;
});

$app->get('/founds(/:page)', function($page=1) {
	$found = new Found();
	echo $found->find($page, count_per_page);
	return true;
});

$app->post('/lost', function () use ($app) {
	$post = $app->request->post();
	foreach ($post as $key => $value) {
		$post[$key] = strip_tags($value);
	}
	$lost = new Lost($post);
	echo json_encode($lost->save()->output());
	return true;
});

$app->post('/found', function () use ($app) {
	$post = $app->request->post();
	foreach ($post as $key => $value) {
		$post[$key] = strip_tags($value);
	}
	$found = new Found($post);
	echo json_encode($found->save()->output());
	return true;	
});

$app->get('/lost', function () use ($app) {
	$get = $app->request->get();
	foreach ($get as $key => $value) {
		$get[$key] = strip_tags($value);
	}
	$lost = new Lost();
	echo $lost->find($get, $page, $config['count_per_page']);
	return true;
});

$app->get('/found', function () use ($app) {
	$get = $app->request->get();
	foreach ($get as $key => $value) {
		$get[$key] = strip_tags($value);
	}
	$found = new found();
	echo $found->find($get, $page, $config['count_per_page']);
	return true;
});

$app->run();

?>