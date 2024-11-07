<?php 
include'../include/connection.php';

if (isset($_SESSION['admlogin'])) {
    header("Location:product-list.php");
    exit();
}


if (isset($_POST['logi']))
 {
        $username=$_POST['uid'];
        $password=md5($_POST['pwd']);
        
         $query = sprintf("SELECT * FROM `super_admin` WHERE admin_id='%s' AND admin_pas='%s'",
                          $conn->real_escape_string($username),
                          $conn->real_escape_string($password));

        $res = $conn->query($query);

        if ($res->num_rows == 1) {

                $row=mysqli_fetch_assoc($res);
                
                $_SESSION['admlogin']=$username;
                
                $_SESSION["user"] = $row;
             
                
                if($row['role']=='seller') 
                {
                    echo'<script> alert("Login Successful");window.location ="new-order.php";
                    </script>';
                }
                if($row['role']=='digital') 
                {
                    echo'<script> alert("Login Successful");window.location ="seo-list.php";
                    </script>';
                }
                 if($row['role']=='employee') 
                {
                    
                    echo'<script> alert("Login Successful");window.location ="product-list.php";
                    </script>';
                }
                else
                {
                    //echo'<script>alert("Login Successful"); window.location = "dashboard.php";</script>';
                    header("location:dashboard.php");
                  
                }
       

        } else {
            

            ?>  
                    <script type="text/javascript">
                    alert("Username Or Password are Wrong");
                    window.location = "index.php";
                    </script>
        <?php

        }

    }

?>
