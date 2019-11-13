<?php 

class dbConnection{
    private $con;
    private $dataAdapter;
    private $row;
    function openCon(){
        if($GLOBALS['dbType']=="MYSQL")
            $con = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['databaseName']);
        else if($GLOBALS['dbType']=="SQLSVR"){
            $con = mssql_connect($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass']);
            mssql_selectdbType($GLOBALS['databaseName'], $con);
        }else{

         $con = pg_connect("host=".$GLOBALS['host']." dbname=".$GLOBALS['databaseName']." user=".$GLOBALS['user']." password=".$GLOBALS['pass']." port=".$GLOBALS['port']);

     }
 }

 function exeQuery($sql){
    if($GLOBALS['dbType']=="MYSQL"){
        $dataAdapter = $con->query($sql);
        $array = array();
        while($d = mysqli_fetch_array($dataAdapter)){
            $array[] = $d;
        }
    }
    else if($GLOBALS['dbType']=="SQLSVR"){
        $sql=str_replace("now()","getdate()",$sql);
        $dataAdapter = mssql_query ($sql, $con);
        $array = array();
        while($d = mssql_fetch_array($dataAdapter)){
            $array[] = $d;
        }
        
    }
    else{
        $dataAdapter = pg_query($sql);
        //$row = pg_fetch_array($dataAdapter);
        $array = array();
        while($d = pg_fetch_array($dataAdapter)){
            $array[] = $d;
        }
        

    }
    return $array;
}

function exeNonQuery($sql){
    if($GLOBALS['dbType']=="MYSQL"){
        $dataAdapter = $con->query($sql);
    }
    else if($GLOBALS['dbType']=="SQLSVR"){
        $sql=str_replace("now()","getdate()",$sql);
        $dataAdapter = mssql_query ($sql, $con);
    }
    else{
        $dataAdapter = pg_query($sql);
    }

}

function readDB(){
   if($GLOBALS['dbType']=="MYSQL"){
     $row=mysqli_fetch_array($dataAdapter);
 }
 else if($GLOBALS['dbType']=="SQLSVR"){
     $row = mssql_fetch_array($dataAdapter);
 }else{
     $row = pg_fetch_array($dataAdapter);
 }

 return $row;
}
}
/*

function openCon(){
    if($GLOBALS['dbType']=="MYSQL")
        $con = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['databaseName']);
    else if($GLOBALS['dbType']=="SQLSVR"){
        $con = mssql_connect($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass']);
               mssql_selectdbType($GLOBALS['databaseName'], $con);
    }else{
       $con = pg_connect("host=localhost dbname=db_bdi user=postgres password=fid123!! port=5432");
       
    }
    return $con;
   
}

function exeQuery($con,$sql){
    if($GLOBALS['dbType']=="MYSQL"){
        $dataAdapter = $con->query($sql);
    }
    else if($GLOBALS['dbType']=="SQLSVR"){
        $sql=str_replace("now()","getdate()",$sql);
        $dataAdapter = mssql_query ($sql, $con);
    }
    else{
        $dataAdapter = pg_query($sql);
    }
	////mysqli_close($con);
    return $dataAdapter;
}

function readDB($dataAdapter){
     if($GLOBALS['dbType']=="MYSQL"){
           $row=mysqli_fetch_array($dataAdapter);
     }
     else if($GLOBALS['dbType']=="SQLSVR"){
           $row = mssql_fetch_array($dataAdapter);
     }else{
           $row = pg_fetch_array($dataAdapter);
     }
      
    return $row;
}

*/
?>