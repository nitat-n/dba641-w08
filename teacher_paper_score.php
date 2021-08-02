<?php
    header('Content-Type: application/json');
    $username = "root";
    $password = "";
    $host = "localhost";
    $database = "dbadb";

    $server = mysqli_connect($host,$username,$password,$database);
    mysqli_set_charset($server,"utf8");
    $myquery =  "Select rr.id r_id, round(sum(pt.pbt_score),2) teacher_paper_score 
    from researcher rr join publish_teacher pt on rr.id = pt.pbt_tea_id 
    group by pt.pbt_tea_id  
    order by rr.id;";

    $query = mysqli_query($server,$myquery);
    if(!$query){
        echo mysqli_error();
        die;
    }

    $data = array();
    for ($x = 0; $x < mysqli_num_rows($query); $x++) {
        $data[] = mysqli_fetch_assoc($query);
      }

    echo json_encode($data);
    mysqli_close($server);
?>