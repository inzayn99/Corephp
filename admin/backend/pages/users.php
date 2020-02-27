<?php
  $userQuery=select('users','','','ORDER BY uid DESC');
  if (isset($_POST['admin']) && $_SERVER['REQUEST_METHOD']==='POST')
  {
      $criteria=$_POST['criteria'];
      $data['user_type']='user';
      if (update('users',$data,"uid='$criteria'"))
      {
          $_SESSION['success']='user type was changed';
          redirect_back();
      }
  }

if (isset($_POST['user']) && $_SERVER['REQUEST_METHOD']==='POST')
{
    $criteria=$_POST['criteria'];
    $data['user_type']='admin';
     update('users',$data,"uid='$criteria'");
    {
        $_SESSION['success']='user type was changed';
        redirect_back();
    }
}

if (isset($_POST['active']) && $_SERVER['REQUEST_METHOD']==='POST')
{
    $criteria=$_POST['criteria'];
    $data['status']=0;
    if (update('users',$data,"uid='$criteria'"))
    {
        $_SESSION['success']='status  was changed';
        redirect_back();
    }
}

if (isset($_POST['inactive']) && $_SERVER['REQUEST_METHOD']==='POST')
{
    $criteria=$_POST['criteria'];
    $data['status']=1;
    if (update('users',$data,"uid='$criteria'"))
    {
        $_SESSION['success']='status was changed';
        redirect_back();
    }
}

if (isset($_POST['delete']) && $_SERVER['REQUEST_METHOD']==='POST')
{
    $criteria=$_POST['criteria'];
  $result=delete('users',"uid='$criteria'");
  if ($result==true)
  {
      $_SESSION['success']='successfully deleted';
      redirect_back();
  }
  else
  {
      $_SESSION['error']='deletion failed';
      redirect_back();
  }
}
//if (isset($_POST['edit']) && $_SERVER['REQUEST_METHOD']==='POST')
//{
//    $criteria=$_POST['criteria'];
//    $object=select('users','',"uid='$criteria'");
//    redirect_to('admin/add-user');
//}


?>
<!--content-->
<div class="container-fluid">
<div class="content">
   <h3><i class="fa fa-users"></i><?= $title ?>&nbsp;&nbsp;  <a href="<?= admin_url('add-user')?>"><i class="fa fa-hand-o-left"></i>  Add-users</a></h3>
    <br>
    <?= messages();?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>User Type</th>
            <th>status</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($userQuery as $key=>$users): ?>
        <tr>
            <td><?=++$key?></td>
            <td><?=ucfirst($users['name']);?></td>
            <td><?=ucfirst($users['username']);?></td>
            <td><?=$users['email'];?></td>
            <td>
               <form action="" method="post">
                   <input type="hidden" name="criteria" value="<?=$users['uid']?>">
                <?php if ($users['user_type']==='admin') :?>
                    <button name="admin" class="btn btn-success btn-xs">Admin</button>
                <?php else : ?>
                    <button name="user" class="btn btn-warning btn-xs">User</button>
                <?php endif ;?>

               </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="criteria" value="<?=$users['uid']?>">
                <?php if ($users['status']==1) :?>
                <button name="active" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                <?php else : ?>
                <button name="inactive" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                <?php endif ;?>
                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="criteria" value="<?=$users['uid']?>">
              <button name="edit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                <button name="delete" onclick="confirm('are you sure')" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>





