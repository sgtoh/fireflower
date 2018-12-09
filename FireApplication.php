<?php


class FireApplication extends Application
{
	protected $login_action=array('account','signin');
	
	public function getRootDir()
	{
		return dirname(__FILE__);
	}
	
	protected function registerRoutes()
	{
		return array(
			'/'=>array('controller'=>'home','action'=>'index'),
			'/home'=>array('controller'=>'home','action'=>'index'),
			'/detail'=>array('controller'=>'detail','action'=>'index'),
			'/record'=>array('controller'=>'record','action'=>'index'),
			'/logins' =>array('controller'=>'logins','action'=>'signin'),
			'/logins/:action' =>array('controller'=>'logins'),
		);
	}
	
	protected function configure()
	{
		$this->db_manager->connect('master',array(
			'dsn'=>'mysql:dbname=fire_db;host=localhost',
			'user'=>'root',
			'password'=>'/*このコメントアウト文を消してから、パスワードを記入してください*/',	
		));
	}



}