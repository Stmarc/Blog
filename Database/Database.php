<?php
declare(strict_types=1);



class Database

{
    private PDO $conn;


    public function __construct(array $config)
    {
        $this->CreateConnection($config);
        
        
    }



  public function CreateConnection(array $config)
  {
  
    
    $dsn = "mysql:dbname={$config['database']};host={$config['host']}";

    $this->conn = new PDO(
      $dsn,
      'root',
      '',
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
      
    );
   

   
    
    
    
  }
 
  
public  function checkUser($login, $password) : bool
{
   
    $sql = "SELECT *  FROM user WHERE user='$login' AND password='$password' LIMIT 1";
    
    $result = $this->conn->query($sql);
  
    $row=$result->fetch(PDO::FETCH_ASSOC);
    
    
    if($row['id'])
    {
      $_SESSION['id'] = $row['id'];
      return true;
    }

    else{
      header('Location: index.php');
    }

  
}


public function getNames() : array
{
  $sql = "SELECT user from user ";
  $result=$this->conn->query($sql);
  while($row = $result->fetch(PDO::FETCH_ASSOC))
  {


    $data[] = [
      'userName' => $row['user']
              ];
    
    
    }
 
    return $data;

}


public function addComment(array $data) :void
{
$sql ="INSERT INTO `comments`(`post_id`, `user_id`, `description`,`Date`) VALUES ('$data[id]','$data[user_id]','$data[text]','".date('Y-m-d h:i:s')."')" ;

$this->conn->query($sql);



}

  public function getPost($id='user_id') : array
  {
    $sql = "SELECT  *,posts.id as 'postId' from posts inner JOIN user ON posts.user_id=user.id  WHERE user_id=$id order by Date desc";
   

    $result=$this->conn->query($sql);
    $data=[];
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {


      $data[] = [
        'user_id' => $row['user_id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'id' => $row['postId'],
        'Date' => $row['Date'],
        'user' => $row['user']
    ];
      
      
      }
      
      
      
       
        return $data;
  } 


  public function getEditPost($id) : array
  {
  
    $sql = "SELECT * FROM posts WHERE id=$id";
    $result=$this->conn->query($sql);
    $data = $result->fetch(PDO::FETCH_ASSOC);

    return $data;
  }
public function GetComment($id): array
{
$sql = "SELECT user,description,Date FROM `comments` INNER JOIN user ON user.id = comments.user_id where post_id=$id order by Date desc";


$result=$this->conn->query($sql);
    $data=[];
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {


      $data[] = [
        'user' => $row['user'],
        'description' => $row['description'],
        'Date' => $row['Date']
      
      ];
      }
      
      
return $data;
}

  public function getIdByName($name)
  {
    $sql = "SELECT id FROM user WHERE user='$name'";
    $result=$this->conn->query($sql);
    
    $row=$result->fetch(PDO::FETCH_ASSOC);

    return $row['id'];
    
    exit;
  }

  public function UpdatePost($data) : void
  {
   
    
    $sql = "UPDATE posts SET title ='$data[title]' , description='$data[description]'  WHERE id=$data[id]";
    $this->conn->query($sql);

  }
  public function addPost($data)
  {
  
    $sql = "INSERT INTO posts (user_id,title,description,Date) VALUES ($data[user_id],'$data[title]','$data[description]','".date('Y-m-d h:i:s')."') ";
  
   
    $this->conn->query($sql);
    
  }

  public function addUser($data) : void
  {
    $sql = "INSERT INTO `user`(`user`, `password`) VALUES ('$data[name]',MD5('$data[password]'))";
 
   
    $this->conn->query($sql);

  }
}