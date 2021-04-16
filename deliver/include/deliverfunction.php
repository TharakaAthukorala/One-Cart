<?php

    function viewall_products(){
        include("include/db.php");

        $fetch_pro=$con->prepare("SELECT * FROM products");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        $i=1;

        while($row=$fetch_pro->fetch()):
            echo "<tr>
                    <td style='min-width:50px'>".$i++."</td>
                    <td style='min-width:135px'>".$row['pro_name']."</td>
                    <td style='min-width:135px'>
                        <img src='../images/pro_img/".$row['pro_img1']."' />
                        <img src='../images/pro_img/".$row['pro_img2']."' />
                    </td>
                    <td>".$row['pro_weight']."</td>
                    <td style='min-width:135px'>".$row['pro_description']."</td>
                    <td style='min-width:185px'>".$row['pro_moredescription']."</td>
                    <td style='min-width:80px'>".$row['pro_price']."</td>
                    <td style='min-width:185px'>".$row['pro_keyword']."</td>
                    <td style='min-width:150px'>".$row['pro_added_date']."</td>

                 </tr>";
        endwhile;
    }

    function view_order1(){
        include("include/db.php");

        $fetch_cart=$con->prepare("SELECT * FROM cart");
        $fetch_cart->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cart->execute();
        // $row_cart=$fetch_cart->fetch();
        // $id1=$row_cart['pro_id'];
        // $id2=$row_cart['userid'];
        $row_check=$fetch_cart->rowCount();

        $fetch_user=$con->prepare("SELECT u_id, u_name FROM user"); // WHERE u_id='$id2'
        $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user->execute();
        $row_user=$fetch_user->fetch();


        if($row_check > 0){

            $i=1;

            while($row_cart=$fetch_cart->fetch()):
                $id1=$row_cart['pro_id'];

                $fetch_pro=$con->prepare("SELECT pro_id, pro_name, pro_img1, pro_weight, pro_price FROM products WHERE pro_id='$id1'");
                $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
                $fetch_pro->execute();
                $row_pro=$fetch_pro->fetch();

                $sub_total=$row_pro['pro_price'] * $row_cart['qnty'];

                echo "<tr>
                        <td style='min-width:90px'>".$i++."</td>
                        <td style='min-width:90px'>".$row_user['u_id']."</td>
                        <td style='min-width:130px'>".$row_user['u_name']."</td>
                        <td style='min-width:90px'>".$row_cart['cart_id']."</td>
                        <td style='min-width:100px'>".$row_pro['pro_id']."</td>
                        <td style='min-width:150px'>".$row_cart['addDate']."</td>
                        <td style='min-width:150px'>".$row_pro['pro_name']."</td>
                        <td style='min-width:135px'>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                        </td>
                        <td>".$row_pro['pro_weight']."</td>
                        <td>".$row_pro['pro_price']."/=</td>
                        <td>".$row_cart['qnty']."</td>
                        <td>".$row_cart['urgent']."</td>
                        <td>".$sub_total."/=</td>

                    </tr>";

            endwhile;
        }
        else{
          echo "<center><h2>Nothing To Display.</br>
                            No One Order Foods From Your Shop....!!!</h2></center>";
        }
    }

    function add_status(){
        include("include/db.php");

        // $fetch_user=$con->prepare("SELECT * FROM user");
        // $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
        // $fetch_user->execute();
        // $row_user=$fetch_user->fetch();

        if(isset($_POST['add_status'])){
            $cart_id=$_POST['cart_id'];

            $user_id=$_POST['user_id'];

            $user_name=$_POST['user_name'];

            $condi=$_POST['condi'];

            $img=$_FILES['img']['name'];
            $img_tmp=$_FILES['img']['tmp_name'];
            move_uploaded_file($img_tmp, "../images/condition/$img");

            $status=$_POST['status'];

            $add_sta=$con->prepare("INSERT INTO deliverstatus(user_name, condi, img, status, deli_date)
                                    VALUES('$user_name', '$condi', '$img', '$status', NOW())"); //WHERE user_id = ''

            if($add_sta->execute()){
                echo "<script>alert('Delivery Information Added Successfully !')</script>";
            }
            else{
                echo "<script>alert('Delivery Information Not Added Successfully !')</script>";
            }
        }
        // else {
        //   echo "string";
        // }
    }

    function view_status(){
        include("include/db.php");

        $fetch_pro=$con->prepare("SELECT * FROM deliverstatus");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        $i=1;

        while($row=$fetch_pro->fetch()):

          // $temp = $fetch_pro['user_name'];
          //
          // $fetch_user=$con->prepare("SELECT * FROM user");// WHERE u_id='$temp'
          // $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
          // $fetch_user->execute();//
          // $row_user=$fetch_user->fetch();

            echo "<tr>
                    <td style='min-width:50px'>".$i++."</td>


                    <td style='min-width:155px'>".$row['user_name']."</td>
                    <td>".$row['condi']."</td>
                    <td style='min-width:85px'>
                        <img src='../images/condition/".$row['img']."' />
                    </td>
                    <td>".$row['status']."</td>
                    <td style='min-width:150px'>".$row['deli_date']."</td>

                 </tr>";
        endwhile;
    }

    function edit_status(){
        include("include/db.php");

        if(isset($_GET['edit_status'])){
            $m_id=$_GET['edit_status'];

            $fetch_pro=$con->prepare("SELECT * FROM deliverstatus WHERE m_id='$m_id'");
            $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $fetch_pro->execute();
            $row=$fetch_pro->fetch();

            echo "<form method='post' enctype='multipart/form-data'>
                <table>
                    <tr>
                        <td>Edit Name:</td>
                        <td><Input type='text' name='m_name' value='".$row['m_name']."' /></td>
                    </tr>
                    <tr>
                        <td>Edit NIC:</td>
                        <td><Input type='text' name='m_nic' value='".$row['m_nic']."' /></td>
                    </tr>
                    <tr>
                        <td>Update Person Image:</td>
                        <td>
                            <Input type='file' name='m_img' />
                            <img src='../images/manager/".$row['m_img']."' style='width:60px; height:60px' />
                        </td>
                    </tr>
                    <tr>
                        <td>Edit Email:</td>
                        <td><Input type='text' name='m_email' value='".$row['m_email']."' /></td>
                    </tr>
                    <tr>
                        <td>Edit Address:</td>
                        <td><Input type='text' name='m_add' value='".$row['m_add']."' /></td>
                    </tr>
                    <tr>
                        <td>Edit Contact No:</td>
                        <td><Input type='text' name='m_phone' value='".$row['m_phone']."' /></td>
                    </tr>

                </table>
                <center><button name='edit_manager'>Edit Manager</button></center>
            </form>";

            if(isset($_POST['edit_manager'])){
                $m_name=$_POST['m_name'];

                $m_nic=$_POST['m_nic'];

                $m_img=$_FILES['m_img']['name'];
                $m_img_tmp=$_FILES['m_img']['tmp_name'];
                move_uploaded_file($m_img_tmp, "../images/manager/$m_img");

                $m_email=$_POST['m_email'];
                $m_add=$_POST['m_add'];
                $m_phone=$_POST['m_phone'];

                $edit_mana=$con->prepare("UPDATE manager SET m_name='$m_name', m_nic='$m_nic', m_img='$m_img',  m_email='$m_email', m_add='$m_add',
                                                 m_phone='$m_phone' WHERE m_id='$m_id'");

                if($edit_mana->execute()){
                    echo "<script>alert('Manager Updated Successfully !')</script>";
                    echo "<script>window.open('indexadmin.php?view_manager', '_self')</script>";
                }
            }
        }
    }

    function delete_status(){
        include("include/db.php");

        $delete_manager_id=$_GET['delete_status'];
        $delete_mana=$con->prepare("DELETE FROM deliverstatus WHERE m_id='$delete_manager_id'");

        if($delete_mana->execute()){
            echo "<script>alert('Manager Removed Successfully !')</script>";
            echo "<script>window.open('indexadmin.php?view_manager', '_self')</script>";
        }
    }

    function viewall_cart(){
        include("include/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM cart");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        while($row=$fetch_cat->fetch()):
            echo"<option value='".$row['cart_id']."'>".$row['cart_id']."</option>";
        endwhile;
    }

    function viewall_userid(){
        include("include/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM user");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        while($row=$fetch_cat->fetch()):
            echo"<option value='".$row['u_id']."'>".$row['u_id']."</option>";
        endwhile;
    }

    function viewall_name(){
        include("include/db.php");

        $fetch_user=$con->prepare("SELECT * FROM user");
        $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user->execute();

        while($row=$fetch_user->fetch()):
            echo"<option value='".$row['u_name']."'>".$row['u_name']."</option>";
        endwhile;
    }
    function categoryCount(){
        include("include/db.php");

        $fetch_cart=$con->prepare("SELECT * FROM stock");
        $fetch_cart->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cart->execute();
        $row_cart=$fetch_cart->fetch();
        $row_check=$fetch_cart->rowCount();

        echo "$row_check";
    }

    function vieworderCount(){
        include("include/db.php");

        $fetch_cart=$con->prepare("SELECT * FROM cart");
        $fetch_cart->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cart->execute();
        $row_cart=$fetch_cart->fetch();
        $row_check=$fetch_cart->rowCount();

        echo "$row_check";
    }

    function viewall_id(){
        include("include/db.php");

        $fetch_user=$con->prepare("SELECT * FROM user");
        $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user->execute();

        while($row=$fetch_user->fetch()):
            echo"<option value='".$row['u_id']."'>".$row['u_id']."</option>";
        endwhile;
    }

    function viewall_cartid(){
        include("include/db.php");

        $fetch_user=$con->prepare("SELECT * FROM cart");
        $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user->execute();

        while($row=$fetch_user->fetch()):
            echo"<option value='".$row['cart_id']."'>".$row['cart_id']."</option>";
        endwhile;
    }

    function view_user(){
        include("include/db.php");

        $fetch_pro=$con->prepare("SELECT * FROM user");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        $i=1;

        while($row=$fetch_pro->fetch()):
            echo "<tr>
                    <td style='min-width:50px'>".$i++."</td>
                    <td style='min-width:135px'>".$row['u_name']."</td>

                    <td>".$row['u_email']."</td>
                    <td>".$row['u_city']."</td>
                    <td>".$row['u_add']."</td>
                    <td>".$row['u_phone']."</td>
                    <td style='min-width:150px'>".$row['u_reg_date']."</td>

                 </tr>";
        endwhile;
    }

    function returned(){       //check it deliver Status
        include("include/db.php");

        $fetch_pro=$con->prepare("SELECT * FROM deliverstatus WHERE status = 'Returned'");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        $i=1;

        while($row=$fetch_pro->fetch()):
            echo "<tr>
                    <td style='min-width:50px'>".$i++."</td>


                    <td style='min-width:135px'>".$row['user_name']."</td>
                    <td>".$row['condi']."</td>
                    <td style='min-width:135px'>
                        <img src='../images/condition/".$row['img']."' />
                    </td>
                    <td>".$row['status']."</td>
                    <td style='min-width:150px'>".$row['deli_date']."</td>

                 </tr>";
        endwhile;
    }

    function view_Normalorder(){
      include("include/db.php");

      $fetch_order=$con->prepare("SELECT * FROM ordertest WHERE urgent='Normal Order'");
      $fetch_order->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_order->execute();

      $fetch_cart=$con->prepare("SELECT * FROM cart");
      $fetch_cart->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_cart->execute();
      // $row_cart=$fetch_cart->fetch();
      // $id1=$row_cart['pro_id'];
      // $id2=$row_cart['userid'];
      $row_check=$fetch_cart->rowCount();

      $fetch_user=$con->prepare("SELECT u_id, u_name FROM user"); // WHERE u_id='$id2'
      $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_user->execute();
      $row_user=$fetch_user->fetch();

      $fetch_map=$con->prepare("SELECT longtitude, latitude FROM getaddress");
      $fetch_map->setFetchMode(PDO:: FETCH_ASSOC);;
      $fetch_map->execute();
      $row_map=$fetch_map->fetch();

      if($row_check > 0){

          $i=1;
          $net_total=0;

          while($row_cart=$fetch_cart->fetch()):
              $id1=$row_cart['pro_id'];

              $fetch_pro=$con->prepare("SELECT pro_id, pro_name, pro_img1, pro_weight, pro_price FROM products WHERE pro_id='$id1'");
              $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
              $fetch_pro->execute();
              $row_pro=$fetch_pro->fetch();

              $sub_total=$row_pro['pro_price'] * $row_cart['qnty'];
              $net_total=$net_total+$sub_total;
          endwhile;

          while($row_order=$fetch_order->fetch()):

              echo "<tr>
                      <td style='min-width:100px'>".$i++."</td>
                      <td style='min-width:100px'>".$row_order['u_id']."</td>
                      <td style='min-width:130px'>".$row_user['u_name']."</td>
                      <td style='min-width:150px'>".$row_order['o_date']."</td>
                      <td>".$row_order['urgent']."</td>
                      <td><b>RS $net_total /= </b></td>
                      <td style='min-width:80px'><a href='indexdeliver.php?view_Normalorder_VIEW=".$row_order['u_id']."'>View<a/></td>
                      <td style='min-width:80px'><a href='https://www.google.com/maps/dir/?api=1&destination=".$row_map['latitude'].",".$row_map['longtitude']."'>Delivery<a/></td>
                      <td style='min-width:80px'><a href='./delete_order.php'>DELETE<a/></td>
                  </tr>";

          endwhile;

      }
      else{
        echo "<center><h2>Nothing To Display.</br>
                          No One Order Foods From Your Shop....!!!</h2></center>";
      }
    }

    function view_Urgentorder(){
      include("include/db.php");

      $fetch_order=$con->prepare("SELECT * FROM ordertest WHERE urgent='Urgent Order'");
      $fetch_order->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_order->execute();

      $fetch_cart=$con->prepare("SELECT * FROM cart");
      $fetch_cart->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_cart->execute();
      // $row_cart=$fetch_cart->fetch();
      // $id1=$row_cart['pro_id'];
      // $id2=$row_cart['userid'];
      $row_check=$fetch_cart->rowCount();

      $fetch_user=$con->prepare("SELECT u_id, u_name FROM user"); // WHERE u_id='$id2'
      $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
      $fetch_user->execute();
      $row_user=$fetch_user->fetch();

      $fetch_map=$con->prepare("SELECT longtitude, latitude FROM getaddress");
      $fetch_map->setFetchMode(PDO:: FETCH_ASSOC);;
      $fetch_map->execute();
      $row_map=$fetch_map->fetch();


      if($row_check > 0){

          $i=1;
          $net_total=0;

          while($row_cart=$fetch_cart->fetch()):
              $id1=$row_cart['pro_id'];

              $fetch_pro=$con->prepare("SELECT pro_id, pro_name, pro_img1, pro_weight, pro_price FROM products WHERE pro_id='$id1'");
              $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
              $fetch_pro->execute();
              $row_pro=$fetch_pro->fetch();

              $sub_total=$row_pro['pro_price'] * $row_cart['qnty'];
              $net_total=$net_total+$sub_total;
          endwhile;

          while($row_order=$fetch_order->fetch()):

              echo "<tr>
                      <td style='min-width:100px'>".$i++."</td>
                      <td style='min-width:100px'>".$row_order['u_id']."</td>
                      <td style='min-width:130px'>".$row_user['u_name']."</td>
                      <td style='min-width:150px'>".$row_order['o_date']."</td>
                      <td>".$row_order['urgent']."</td>
                      <td><b>RS $net_total /= </b></td>
                      <td style='min-width:80px'><a href='indexdeliver.php?view_Urgentorder_VIEW=".$row_order['u_id']."'>View<a/></td>
                      <td style='min-width:80px'><a href='delete_order.php'>Deliver<a/></td>
                  </tr>";

          endwhile;

      }
      else{
        echo "<center><h2>Nothing To Display.</br>
                          No One Order Foods From Your Shop....!!!</h2></center>";
      }
    }

    function view_order(){
        include("include/db.php");

        $fetch_cart=$con->prepare("SELECT * FROM cart");
        $fetch_cart->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cart->execute();
        // $row_cart=$fetch_cart->fetch();
        // $id1=$row_cart['pro_id'];
        // $id2=$row_cart['userid'];
        $row_check=$fetch_cart->rowCount();

        $fetch_user=$con->prepare("SELECT u_id, u_name FROM user"); // WHERE u_id='$id2'
        $fetch_user->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_user->execute();
        $row_user=$fetch_user->fetch();


        if($row_check > 0){

            $i=1;
            $net_total=0;

            while($row_cart=$fetch_cart->fetch()):
                $id1=$row_cart['pro_id'];

                $fetch_pro=$con->prepare("SELECT pro_id, pro_name, pro_img1, pro_weight, pro_price FROM products WHERE pro_id='$id1'");
                $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
                $fetch_pro->execute();
                $row_pro=$fetch_pro->fetch();

                $sub_total=$row_pro['pro_price'] * $row_cart['qnty'];
                $net_total=$net_total+$sub_total;

                echo "<tr>
                        <td style='min-width:100px'>".$i++."</td>
                        
                        <td style='min-width:100px'>".$row_pro['pro_id']."</td>
                        <td style='min-width:150px'>".$row_cart['addDate']."</td>
                        <td style='min-width:150px'>".$row_pro['pro_name']."</td>
                        <td style='min-width:135px'>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                        </td>
                        <td>".$row_pro['pro_weight']."</td>
                        <td>".$row_pro['pro_price']."/=</td>
                        <td>".$row_cart['qnty']."</td>

                        <td>".$sub_total."/=</td>

                    </tr>";

            endwhile;
        }
        else{
          echo "<center><h2>Nothing To Display.</br>
                            No One Order Foods From Your Shop....!!!</h2></center>";
        }
    }

    function getIp() {                           //get user ids
        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }

    function delete_normal_order(){
        include("include/db.php");

        // $getid = getIp();

        // $query = $con->prepare("DELETE FROM odertest WHERE urgent='Normal Order'");
        $query = $con->prepare("DELETE FROM ordertest WHERE urgent='Normal Order'");


        if($query->execute()){
            echo "<script>alert('Order is Deleted Successfully !')</script>";
            echo "<script>window.open('indexdeliver.php?view_normal', '_self')</script>";
        }
        else{
            echo "Not";
        }
    }

 ?>
