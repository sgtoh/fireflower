<?php 
class LoginsController extends Controller
{
	public function signinAction()
	{
		if($this->session->isAuthenticated()){
			return $this->redirect('/logins/index');
		}
		
		return $this->render(array(
			'user_name'=>'',
			'password'=>'',
			'_token' =>$this->generateCsrfToken('/logins/signin'),
		));
	}
	
	public function signupAction()
	{
		return $this->render(array(
			'_token' =>$this->generateCsrfToken('/logins/signup'),
		));
	}
	
	public function registerAction()
	{
		if(!$this->request->isPost()){
			$this->forward404();
		}
		
		$token=$this->request->getPost('_token');
		
		if(!$this->checkCsrfToken('/logins/signup',$token)){
			return $this->redirect('/logins/signup');
		}
		
		$user_name=$this->request->getPost('user_name');
		$password=$this->request->getPost('password');
		
		$errors=array();
		
		if(!strlen($user_name)){
			$errors[]='ユーザーIDを入力してください';
		}
		else if(!preg_match('/^\w{3,20}$/',$user_name)){
			$errors[]='ユーザーIDは半角英数字およびアンダースコアを3～20文字以内で入力してください';
		}
		else if(!$this->db_manager->get('Fire_user')->isUniqueUserName($user_name)){
			$errors[]='そのユーザーIDは既に使用されています';
		}
		
		if(!strlen($password)){
			$errors[]='パスワードを入力してください';
		}
		else if(4>strlen($password)|| strlen($password)>30){
			$errors[]='パスワードは4～30文字以内で入力してください';
		}
		
		
		
		if(count($errors)===0){
			$this->db_manager->get('Fire_user')->insert($user_name,$password);
			$this->session->setAuthenticated(true);
			
			$user=$this->db_manager->get('Fire_user')->fetchByUserName($user_name);
			$this->session->set('user',$user);
		
			return $this->redirect('/logins/index');
		}	
		return $this->render(array(
				'user_name'=>$user_name,
				'password'=>$password,
				'errors'=>$errors,
				'_token'=>$this->generateCsrfToken('/logins/signup'),
			),'signup');
		
	}
	
	
	public function inter_accountAction()
	{
		if($this->session->isAuthenticated()){
			return $this->redirect('/logins/index');
		}
		
		if(!$this->request->isPost()){
			$this->forward404();
		}
		
		$token=$this->request->getPost('_token');
		
		if(!$this->checkCsrfToken('/logins/signin',$token)){
			return $this->redirect('/logins/signin');
		}
		
		$user_name=$this->request->getPost('user_name');
		$password=$this->request->getPost('password');
		
		$errors=array();
		
		if(!strlen($user_name)){
			$errors[]='ユーザーIDを入力してください';
		}
		else if(!preg_match('/^\w{3,20}$/',$user_name)){
			$errors[]='ユーザーIDは半角英数字およびアンダースコアを3～20文字以内で入力してください';
		}
		
		if(!strlen($password)){
			$errors[]='パスワードを入力してください';
		}
		else if(4>strlen($password)|| strlen($password)>30){
			$errors[]='パスワードは4～30文字以内で入力してください';
		}
		
		
		if(count($errors)===0){
			$user_repository=$this->db_manager->get('Fire_user');
			$user=$user_repository->fetchByUserName($user_name);
			
			if(!$user||($user['password']!==$user_repository->hashpassword($password))){
				$errors[]='ユーザーIDかパスワードが正しくありません';
			}
			else{
				$this->session->setAuthenticated(true);
				$this->session->set('user',$user);
				
				return $this->redirect('/logins/index');
			}
		}
			
		return $this->render(array(
				'user_name'=>$user_name,
				'password'=>$password,
				'errors'=>$errors,
				'_token'=>$this->generateCsrfToken('/logins/signin'),
			),'signin');	
	}
	
	public function indexAction()
	{
		$user=$this->session->get('user');
		return $this->render(array(
			'user'=>$user,
			'user_name'=>$user['user_name'],
			'_token' =>$this->generateCsrfToken('/logins/signup'),
		
		));
	}
	

}


?>