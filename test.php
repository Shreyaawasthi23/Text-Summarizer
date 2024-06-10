<?php
session_start();

    if(isset($_POST['record'])){
        
        include("config.php");
        //echo "Hii";
        $id = $_POST['record'];
        $sql = "SELECT * FROM `usage_record` WHERE `record_id`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$id);
        if($stmt->execute()==TRUE){
            $res = $stmt->get_result();
            if($r = $res->fetch_array()){
                
                echo $r['usage_info'];
            }
        }
    }

    else if(isset($_POST['feedback'])){
        
        include("config.php");
        //echo "Hii";
        $a = array('1'=>0, '2'=>0, '3'=>0, '4'=>0, '5'=>0);
        $sql = "SELECT COUNT(*) as COUNT, rating FROM feedback GROUP BY rating";
        $stmt = $conn->prepare($sql);
        if($stmt->execute()==TRUE){
            $res = $stmt->get_result();

            while($r = $res->fetch_array()){
                $a[$r['rating']] = $r['COUNT'];
            }
        }
        echo json_encode($a);
    }

    else if(isset($_POST['usage'])){
        
        include("config.php");
        //echo "Hii";
        $a = array('f01'=>0, 'f02'=>0);
        $sql = "SELECT COUNT(*) as COUNT, func_used FROM usage_record GROUP BY func_used";
        $stmt = $conn->prepare($sql);
        if($stmt->execute()==TRUE){
            $res = $stmt->get_result();

            while($r = $res->fetch_array()){
                $a[$r['func_used']] = $r['COUNT'];
            }
        }
        echo json_encode($a);
    }

    else if(isset($_POST['fmsg'])){
        
        include("config.php");
        //echo "Hii";
        $id = $_POST['fmsg'];
        $sql = "SELECT * FROM `feedback` WHERE `feedback_id`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$id);
        if($stmt->execute()==TRUE){
            $res = $stmt->get_result();
            if($r = $res->fetch_array()){
                
                echo $r['message'];
            }
        }
    }

    else if(isset($_POST['status']) && isset($_POST['str'])){
        
        include("config.php");
        //echo "Hii";
        $id = $_POST['status'];
        $st = $_POST['str'];
        $sql = "UPDATE `functionality` SET `status`=? WHERE `func_id`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$st,$id);
        if($stmt->execute()==TRUE){
            echo 1;
        }
        else{
            echo 0;
        }
    }

?>