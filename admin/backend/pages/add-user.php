<?php

$errors=['name'=>'','username'=>'','email'=>'','password'=>'','confirm_password'=>''];
$name=$username=$email='';
if (!empty($_POST) && $_SERVER['REQUEST_METHOD']==='POST')
{
  foreach ($_POST as $key=>$value)
  {
    if (empty($_POST[$key]))
    {
        $errors[$key]=$key.' field is required';
    }
  }
  $name=$_POST['name'];
  $username=$_POST['username'];
    $usernameQuery=select('users','*',"username='$username'");
    $totalname = mysqli_num_rows($usernameQuery);
    if ($totalname>0)
    {
        $errors['username']=$username.'already exists';
    }
  $email=$_POST['email'];
  $emailQuery=select('users','*',"email='$email'");
  $totalEmail = mysqli_num_rows($emailQuery);
  if ($totalEmail>0)
  {
      $errors['email']=$email.'already exists';
  }

  $password=md5($_POST['password']);
  $c_password=md5($_POST['confirm_password']);
  if ($password!=$c_password)
  {
      $errors['password']='password not matched';
  }

  if (!filter_var($email,FILTER_VALIDATE_EMAIL))
  {
      $errors['email']='email not validated';
  }
  if (!array_filter($errors)) {
      $data['name'] = $name;
      $data['username'] = $username;
      $data['email'] = $email;
      $data['password'] = $password;
     if (insert('users',$data))
     {
         $_SESSION['success']='successfully inserted';
         redirect_to('admin/users');
     }else{
         $_SESSION['error']='Data insertion failed';
         redirect_back();
     }

  }
}

?>
<div class="container-fluid">
    <div class="content">
        <h1><i class="glyphicon glyphicon-plus"></i><?= $title ?>&ensp;&ensp;
            <a href="<?= admin_url('users')?>"><i class="fa fa-hand-o-right"></i> users</a> </h1>
        <?= messages();?>
       <form action="" method="post">
           <div class="form-group form-group-xm">
               <label for="name">Name:</label>
               <input type="text" id="name" name="name" value="<?=$name ?>" class="form-control" placeholder="enter name"/>
               <a style="color: red;"><?=$errors['name']?></a>
            </div>

           <div class="form-group form-group-sm">
               <label for="username">Username:</label>
               <input type="text" id="username" name="username" value="<?=$username ?>" class="form-control" placeholder="enter username"/>
               <a style="color: red;"><?=$errors['username']?></a>
           </div>

           <div class="form-group form-group-sm">
               <label for="email">email:</label>
               <input type="text" id="email" name="email" value="<?=$email ?>" class="form-control" placeholder="enter email"/>
               <a style="color: red;"><?=$errors['email']?></a>
           </div>

           <div class="form-group form-group-sm">
               <label for="password">Password:</label>
               <input type="password" id="password" name="password" class="form-control" placeholder="enter password"/>
               <a style="color: red;"><?=$errors['password']?></a>
           </div>

           <div class="form-group form-group-sm">
               <label for="confirm_password">confirm password:</label>
               <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="enter confirm password"/>
               <a style="color: red;"><?=$errors['confirm_password']?></a>
           </div>

           <div class="form-group form-group-sm">
               <input type="submit" class="btn btn-success btn-sm" value="submit">
           </div>

       </form>
</div>
</div>