<?php
if (!function_exists('connection'))
{
    function connection ()
    {
        return mysqli_connect('127.0.0.1','root','','php11am');
    }
}

if (!function_exists('insert'))
{
    function insert($tableName='',$data=array())
    {
     $increment=1;
     $getValue='';
     foreach ($data as $key=>$value){
         $getValue.="'$value'";
         if ($increment<count($data)){
             $getValue.=',';
         }
         $increment++;
     }

     $columns=implode(',',array_keys($data));
      $query="INSERT INTO {$tableName}($columns)VALUES($getValue)";
      return mysqli_query(connection(),$query);
    }
}

if (!function_exists('update'))
{
    function update($tableName='',$data=array(),$criteria='')
    {
       $increment=1;
       $setColumnsValues='';
       foreach ($data as $key=>$value){
           $setColumnsValues.=$key.'='."'$value'";
           if ($increment<count($data)){
               $setColumnsValues.=',';
           }
           $increment++;
       }

        $query="UPDATE {$tableName} SET {$setColumnsValues} WHERE $criteria";
        return mysqli_query(connection(),$query);
    }
}

if (!function_exists('delete'))
{
    function delete($tableName='',$criteria='')
    {
       $query="DELETE FROM {$tableName} WHERE $criteria";
      return mysqli_query(connection(),$query);
    }
}

if (!function_exists('select'))
{
    function select($tableName='',$columns='*',$criteria='',$clause='')
    {
      if (empty($columns)){
          $columns.='*';
      }

       $query="SELECT {$columns} FROM {$tableName}";
      if (!empty($criteria)){
          $query.=" WHERE $criteria";
      }
      if (!empty($clause)){
          $query.=" $clause";
      }
      return mysqli_query(connection(),$query);
    }
}





?>