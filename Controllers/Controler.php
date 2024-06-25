<?php
declare(strict_types=1);

require_once('Views/view.php');
require_once('Database/Database.php');
require_once('Controllers/Request.php');
class Controller
{
    private Database $database;
    private Request $request;

    private array $array = [];
    public function __construct(Database $database, Request $request)
    {
        $this->database=$database;
        $this->request=$request;
      
    }
    public function ShowLoginForm()
    {
        
        View::render('loginForm.php',$this->array);
    }

    public function Login($login,$password)

    {
        $result=$this->database->CheckUser($login,$password);
        if($result==true)
        {
            $_SESSION['user']=$login;
            header('Location: index.php/?action=show');
            
        }
        else{
        require('layouts/pages/loginForm.php');
    }
}

public function show()
{
   if($this->request->getParam('authors'))
   {
    $page = 'showPost.php';
    $id=$this->database->getIdByName($this->request->getParam('authors'));
    $notes= $this->database->getPost($id);
    $Authors= $this->database->getNames();
    View::render($page,$notes,$Authors);
   }
   else{
    $page = 'showPost.php';
    $notes = $this->database->getPost($_SESSION['id']);
    $Authors= $this->database->getNames();
   
   
    View::render($page,$notes,$Authors);
   }
}


public function edit()
{
    if($this->request->postParam('title'))
    {
        $notes=[
            'title' => $this->request->postParam('title'),
            'description' =>  $this->request->postParam('description'),
            'id' => $this->request->getParam('id'),
            
        ];
        
        $this->database->UpdatePost($notes);
        header('Location: index.php/?action=show');
    }
    $page = 'editPost.php';
    $notes=$this ->database->getEditPost($_GET['id']);
    View::render($page,$notes);
}



public function add ()
{
if($this->request->postParam('title'))
{
    $notes=[
        'title' => $this->request->postParam('title'),
        'description' => $this->request->postParam('description'),
        'user_id' => $_SESSION['id']
    ];
   
    $this->database->addPost($notes);
    header('Location: index.php/?action=show');
}
else{
    $page='addNnotes.php';
    View::render($page);
}
}
public function comment ()
{
 
  if($this->request->postParam('text'))
  {
    $data=[
        'id' => $this->request->getParam('id'),
        'user_id' => $this->request->getParam('userid'),
        'text' => $this->request->postParam('text')


    ];
  
    $this->database->addComment($data);
    $page='showPost.php';
    header('Location: /');
  }
  else{
    $page='addComent.php';
    View::render($page);
  }
}


public function logout() : void {
 

// Unset all of the session variables.
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the login page or any other desired page.
header('Location: localhost');



}


public function addUser ()
{
if($this->request->postParam('email'))
{
    $data=[
        'name' => $this->request->postParam('name'),
        'lastname' => $this->request->postParam('lastname'),
        'email' => $this->request->postParam('email'),
        'password' => $this->request->postParam('password')
    ];
   $this->database->addUser($data);
  header('Location: index.php/?action=show');

}
else
{

    View::render('addUser.php');
}



}

public function showAll()
 {
    $page = 'showAll.php';
    $notes = $this->database->getPost();
   
    View::render($page,$notes);
    
}


public function showComment() : void 
{
    $id = $this->request->getParam('id');
    $post=$this->database->getEditPost($id);
    
    $comments = $this->database->GetComment($id);
    
    $page='showComent.php';
    View::render($page,$post,$comments);
}











    public function run()
    {
        $action = $this->request->getParam('action') ?? 'show';
     
            if(isset($_SESSION['user']))
            {
               
                $this->$action();
                
               
              
                
                
            }
           else  if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$this->request->postParam('email'))
                {
                    
                    $this->Login($_POST['user'],$_POST['password']);
                }
                else if($action ==='addUser')
                {
                    
                    $this->$action();
                }
                else if($action ==='showAll')
                {
                    $this->$action();
                }
            else{
                
                View::render('loginForm.php',$this->array);
            }
    } }




?>