<?php

    function getIp() {                           //get user ids
        $ip = $_SERVER['REMOTE_ADDR'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ip;
    }



    function addcart(){
        include("include/db.php");

        if(isset($_POST['cart_btn'])){
            $pro_id=$_POST['pro_id'];
            $id=getIP();

            $check_cart=$con->prepare("SELECT * FROM cart WHERE pro_id='$pro_id' AND user_id='$id'");
            $check_cart->execute();

            $row_check=$check_cart->rowCount();

            if($row_check>=1){
                echo "<script>alert('This Product Already Added To Your Cart !!!');</script>";
            }
            else{
                $add_cart=$con->prepare("INSERT INTO cart(user_id, pro_id, qnty, urgent,addDate) VALUES('$id', '$pro_id', '1', ' ',NOW())");   //edited

                if($add_cart->execute()){
                    echo "<script>window.open('indexuser.php', '_self');</script>";
                }
                else{
                    echo "<script>alert('Try Again !!!');</script>";
                }
            }
        }
    }

    function cart_count(){
        include("include/db.php");

        $id=getIP();
        $get_cart_item=$con->prepare("SELECT * FROM cart WHERE user_id='$id'");
        $get_cart_item->execute();

        $count_cart=$get_cart_item->rowCount();

        echo $count_cart;
    }

    function cart_dis(){
        include("include/db.php");

        $id=getIP();
        $get_cart_item=$con->prepare("SELECT * FROM cart WHERE user_id='$id'"); //get ip
        $get_cart_item->setFetchMode(PDO:: FETCH_ASSOC);
        $get_cart_item->execute();

        $cart_empty=$get_cart_item->rowCount();

        if($cart_empty==0){
            include("emptycart.php");
        }
        else{

            if(isset($_POST['up_qnty'])){
                $qnty=$_POST['qnty'];

                foreach($qnty AS $key=>$value){
                    $update_qnty=$con->prepare("UPDATE cart SET qnty='$value' WHERE cart_id='$key'");

                    if($update_qnty->execute()){
                        echo "<script>window.open('cart.php', '_self');</script>";
                    }
                }
            }

            if(isset($_POST['up_urgent'])){
                $urgent=$_POST['urgent'];

                // foreach($urgent AS $key=>$value){
                //     $update_urgent=$con->prepare("UPDATE ordertest SET urgent='$value' WHERE cart_id='$key'");// new table
                //
                //     if($update_urgent->execute()){
                //         echo "<script>window.open('cart.php', '_self');</script>";
                //     }
                // }
                // INSERT INTO ordertest('urgent') VALUES('1');
                $i=0;
                // $id=getIP();

                $check_row = $con->prepare("SELECT * FROM ordertest WHERE u_id = '$id' AND urgent='Urgent Order' OR urgent='Normal Order'");// OR urgent='Normal Order'  AND urgent='$urgent'
                $check_row->execute();
                $row_check=$check_row->rowCount();

                if($row_check==0){
                    $update_urgent=$con->prepare("INSERT INTO ordertest(o_id, u_id, urgent, o_date) VALUES('$i++', '$id', '$urgent', NOW())");

                    if($update_urgent->execute()){
                          echo "<script>alert('Thank You For The Selecting The Order Option !')</script>";
                          echo "<script>window.open('cart.php', '_self');</script>";
                    }
                }

                elseif($row_check>=1){
                  $update_order = $con->prepare("UPDATE ordertest SET urgent='$urgent', o_date=NOW() WHERE u_id='$id'");
                  if($update_order->execute()){
                      echo "<script>alert('Updated Order Type !')</script>";
                      echo "<script>window.open('cart.php', '_self');</script>";
                  }
                }
            }

            echo "<table cellpadding='0' cellspacing='0'>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                        <th>Sub Total</th>
                    </tr>";

            $net_total=0;
            while($row=$get_cart_item->fetch()):
                $pro_id=$row['pro_id'];

                $get_pro=$con->prepare("SELECT * FROM products WHERE pro_id='$pro_id'");
                $get_pro->setFetchMode(PDO:: FETCH_ASSOC);
                $get_pro->execute();

                $row_pro=$get_pro->fetch();

                echo "<tr>
                        <td><img src='../images/pro_img/".$row_pro['pro_img1']."' /></td>
                        <td>".$row_pro['pro_name']."</td>
                        <td>".$row_pro['pro_weight']."</td>
                        <td><input type='number' name='qnty[".$row['cart_id']."]' value='".$row['qnty']."' /><input type='submit' name='up_qnty' value='Save' /></td>
                        <td>RS ".$row_pro['pro_price']."/=</td>

                        <td><button id='pro_btn1'><a href='delete.php?delete_id=".$row_pro['pro_id']."'>Delete</a></button></td>
                        <td>";
                            // $qnty=$row['qnty'];
                            // $pro_price=$row_pro['pro_price'];
                            $sub_total=$row_pro['pro_price'] * $row['qnty'];
                        echo "Rs ".$sub_total."/=";

                        $net_total=$net_total+$sub_total;
                        echo "</td>
                    </tr>";

            endwhile;

            // <td><label>Choose an Order Type : </label>
            //   <select name='urgent' id=''>
            //   <option value='Normal Order'>Normal Order</option>
            //   <option value='Urgent Order'>Urgent Order</option>
            //   </select>
            //   <br><br>
            //   <input type='submit' name='up_urgent' value='Save' /> </td>
            //
            // <td><input type='number' name='urgent[".$row['cart_id']."]' value='".$row['urgent']."' /><input type='submit' name='up_urgent' value='Save' /></td>
            // <td>Urgent Order <input type='radio' name='urgent' value='Urgent' /><input type='submit' name='up_urgent' value='Save' /></td>
            echo "<tr>

            <td><label>Choose an Order Type : </label>
              <select name='urgent' id='urgent'>
              <option value='Normal Order'>Normal Order</option>
              <option value='Urgent Order'>Urgent Order</option>
              </select>
              <input type='submit' name='up_urgent' value='Save' required /> </td>

                    <td></td>
                    <td><button id='pro_btn1'><a href='indexuser.php'>Continue Shopping</a></button></td>
                    <td><button id='pro_btn2'><a href='getaddress.php'>Check Out</a></button></td>
                    <td></td><td><b>Net Total =</b></td>
                    <td><b>RS $net_total /= </b></td>
                </tr>";
        }

        // echo $net_total;
    }

    function delete_cart_items(){
        include("include/db.php");

        if(isset($_GET['delete_id'])){
            $pro_id=$_GET['delete_id'];

            $delete_pro=$con->prepare("DELETE FROM cart WHERE pro_id='$pro_id'");

            if($delete_pro->execute()){
                echo "<script>alert('This Product Deleted From Your Cart Successfully !');</script>";
                echo "<script>window.open('cart.php', '_self');</script>";
            }
        }
    }
    function destroy_cart(){
        include("include/db.php");

    }

    // function urgent_order(){
    //     include("include/db.php");

    //     if(isset($_GET['urgent_id'])){
    //         $urgent=$_GET['urgent_id'];

    //         $urgent_view=$con->prepare("SELECT FROM cart WHERE pro_id='$urgent'");

    //         if($urgent_view->execute()){
    //             echo "<script>alert('This Product Deleted From Your Cart Successfully !');</script>";
    //             echo "<script>window.open('cart.php', '_self');</script>";
    //         }
    //     }
    // }

    function vegetables(){
        include("include/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM stock WHERE cat_id='1'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id=$row_cat['cat_id'];
        echo "<h3>".$row_cat['cat_name']."</h3>";

        $fetch_pro=$con->prepare("SELECT * FROM products WHERE cat_id='$cat_id' LIMIT 0, 12");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro=$fetch_pro->fetch()):
        // $pro_id=$row_pro['pro_id'];
            echo "<li>
                    <form method='post' enctype='multipart/form-data'>
                        <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                            <h4>".$row_pro['pro_name']."</h4>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                            <h4>".$row_pro['pro_weight']."</h4>
                            <h4>RS ".$row_pro['pro_price']."/=</h4>
                            <center>
                                <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
                                <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                                <button id='pro_btn' name='cart_btn'>Cart</button>

                            </center>
                        </a>
                    </form>
                 </li>";

            // echo "<h4>".$row_pro['pro_name']."</h4>";
        endwhile;
    }

    // function test1(){
    //     include("include/db.php");

    //     $fetch_cat=$con->prepare("SELECT * FROM stock WHERE cat_id='27'");
    //     $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
    //     $fetch_cat->execute();

    //     $row_cat=$fetch_cat->fetch();
    //     $cat_id=$row_cat['cat_id'];
    //     echo "<h3>".$row_cat['cat_name']."</h3>";

    //     $fetch_pro=$con->prepare("SELECT * FROM products WHERE cat_id='$cat_id' LIMIT 0, 12");
    //     $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
    //     $fetch_pro->execute();

    //     while($row_pro=$fetch_pro->fetch()):
    //     // $pro_id=$row_pro['pro_id'];
    //         echo "<li>
    //                 <form method='post' enctype='multipart/form-data'>
    //                     <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
    //                         <h4>".$row_pro['pro_name']."</h4>
    //                         <img src='../images/pro_img/".$row_pro['pro_img1']."' />
    //                         <h4>".$row_pro['pro_weight']."</h4>
    //                         <h4>RS ".$row_pro['pro_price']."/=</h4>
    //                         <center>
    //                             <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
    //                             <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
    //                             <button id='pro_btn' name='cart_btn'>Cart</button>

    //                         </center>
    //                     </a>
    //                 </form>
    //              </li>";

    //         // echo "<h4>".$row_pro['pro_name']."</h4>";
    //     endwhile;
    // }

    function meat(){
        include("include/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM stock WHERE cat_id='3'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id=$row_cat['cat_id'];
        echo "<h3>".$row_cat['cat_name']."</h3>";

        $fetch_pro=$con->prepare("SELECT * FROM products WHERE cat_id='$cat_id' LIMIT 0, 12");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro=$fetch_pro->fetch()):
        // $pro_id=$row_pro['pro_id'];
            echo "<li>
            <form method='post' enctype='multipart/form-data'>
                        <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                            <h4>".$row_pro['pro_name']."</h4>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                            <h4>".$row_pro['pro_weight']."</h4>
                            <h4>RS ".$row_pro['pro_price']."/=</h4>
                            <center>
                                <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
                                <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                                <button id='pro_btn' name='cart_btn'>Cart</button>

                            </center>
                        </a>
                        </form>
                 </li>";

            // echo "<h4>".$row_pro['pro_name']."</h4>";
        endwhile;
    }

    function fish(){
        include("include/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM stock WHERE cat_id='4'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id=$row_cat['cat_id'];
        echo "<h3>".$row_cat['cat_name']."</h3>";

        $fetch_pro=$con->prepare("SELECT * FROM products WHERE cat_id='$cat_id' LIMIT 0, 12");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro=$fetch_pro->fetch()):
        // $pro_id=$row_pro['pro_id'];
            echo "<li>
            <form method='post' enctype='multipart/form-data'>
                        <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                            <h4>".$row_pro['pro_name']."</h4>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                            <h4>".$row_pro['pro_weight']."</h4>
                            <h4>RS ".$row_pro['pro_price']."/=</h4>
                            <center>
                                <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
                                <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                                <button id='pro_btn' name='cart_btn'>Cart</button>

                            </center>
                        </a>
                        </form>
                 </li>";

            // echo "<h4>".$row_pro['pro_name']."</h4>";
        endwhile;
    }

    function rice(){
        include("include/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM stock WHERE cat_id='2'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id=$row_cat['cat_id'];
        echo "<h3>".$row_cat['cat_name']."</h3>";

        $fetch_pro=$con->prepare("SELECT * FROM products WHERE cat_id='$cat_id' LIMIT 0, 12");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro=$fetch_pro->fetch()):
        // $pro_id=$row_pro['pro_id'];
            echo "<li>
            <form method='post' enctype='multipart/form-data'>
                        <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                            <h4>".$row_pro['pro_name']."</h4>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                            <h4>".$row_pro['pro_weight']."</h4>
                            <h4>RS ".$row_pro['pro_price']."/=</h4>
                            <center>
                                <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
                                <button id='pro_btn'><a href='#'>Cart</a></button>

                            </center>
                        </a>
                        </form>
                 </li>";

            // echo "<h4>".$row_pro['pro_name']."</h4>";
        endwhile;
    }

    function gas(){
        include("include/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM stock WHERE cat_id='13'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id=$row_cat['cat_id'];
        echo "<h3>".$row_cat['cat_name']."</h3>";

        $fetch_pro=$con->prepare("SELECT * FROM products WHERE cat_id='$cat_id' LIMIT 0, 12");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro=$fetch_pro->fetch()):
        // $pro_id=$row_pro['pro_id'];
            echo "<li>
            <form method='post' enctype='multipart/form-data'>
                        <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                            <h4>".$row_pro['pro_name']."</h4>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                            <h4>".$row_pro['pro_weight']."</h4>
                            <h4>RS ".$row_pro['pro_price']."/=</h4>
                            <center>
                                <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
                                <button id='pro_btn'><a href='#'>Cart</a></button>

                            </center>
                        </a>
                        </form>
                 </li>";

            // echo "<h4>".$row_pro['pro_name']."</h4>";
        endwhile;
    }

    function test(){
        include("include/db.php");

        $fetch_cat=$con->prepare("SELECT * FROM stock WHERE cat_id='16'");
        $fetch_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_cat->execute();

        $row_cat=$fetch_cat->fetch();
        $cat_id=$row_cat['cat_id'];
        echo "<h3>".$row_cat['cat_name']."</h3>";

        $fetch_pro=$con->prepare("SELECT * FROM products WHERE cat_id='$cat_id' LIMIT 0, 12");
        $fetch_pro->setFetchMode(PDO:: FETCH_ASSOC);
        $fetch_pro->execute();

        while($row_pro=$fetch_pro->fetch()):
        // $pro_id=$row_pro['pro_id'];
            echo "<li>
            <form method='post' enctype='multipart/form-data'>
                        <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                            <h4>".$row_pro['pro_name']."</h4>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                            <h4>".$row_pro['pro_weight']."</h4>
                            <h4>RS ".$row_pro['pro_price']."/=</h4>
                            <center>
                                <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
                                <button id='pro_btn'><a href='#'>Cart</a></button>

                            </center>
                        </a>
                        </form>
                 </li>";

            // echo "<h4>".$row_pro['pro_name']."</h4>";
        endwhile;
    }

    function pro_details(){
        include("include/db.php");

        if(isset($_GET['pro_id'])){
            $pro_id=$_GET['pro_id'];

            $pro_fetch=$con->prepare("SELECT * FROM products WHERE pro_id='$pro_id'");
            $pro_fetch->setFetchMode(PDO:: FETCH_ASSOC);
            $pro_fetch->execute();

            $row_pro=$pro_fetch->fetch();

            $cat_id=$row_pro['cat_id'];

            echo "<div id='pro_img'>
                    <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                    <ul>
                        <li><img src='../images/pro_img/".$row_pro['pro_img2']."' /></li>
                        <li><img src='../images/pro_img/".$row_pro['pro_img1']."' /></li>
                    </ul>
                </div>
                <div id='pro_features'>
                    <h3>".$row_pro['pro_name']."</h3>
                    <ul>
                        <li>Net Weight - ".$row_pro['pro_weight']."</li>
                        <li>".$row_pro['pro_moredescription']."</li>
                        <li>".$row_pro['pro_description']." Foods From One Cart</li>

                    </ul>

                    <ul>
                        <li>Added date of the Item : ".$row_pro['pro_added_date']."</li>
                    </ul><br clear='all' />
                    <center>
                        <h4>Retail Price : RS ".$row_pro['pro_price']."/=</h4>
                        <form method='post'>
                            <input type='hidden' value='".$row_pro['pro_id']."' name='pro_id' />
                            <button name='buy_now'>Buy Now</button>
                            <button name='cart_btn'>Add to Cart</button>
                        </form>
                    </center>
                </div><br clear='all' />

                <div id='similar'>
                    <h3>Related Foods</h3>
                    <ul>";

                        echo addcart();

                        $sim_pro=$con->prepare("SELECT * FROM products WHERE pro_id!=$pro_id AND cat_id='$cat_id' LIMIT 0, 12");
                        $sim_pro->setFetchMode(PDO:: FETCH_ASSOC);
                        $sim_pro->execute();

                        while($row=$sim_pro->fetch()):
                            echo "<li>
                                    <a href='pro_detail.php?pro_id=".$row['pro_id']."'>
                                        <p>".$row['pro_name']."</p>
                                        <img src='../images/pro_img/".$row['pro_img1']."' />
                                        <p>".$row['pro_weight']."</p>
                                        <p>RS ".$row['pro_price']."/=</p>
                                    </a>
                                </li>";
                        endwhile;

                    echo"</ul>

                </div>";
        }
    }

    function all_cat(){
        include("include/db.php");
        //echo "Hello";

        $all_cat=$con->prepare("SELECT * FROM stock WHERE cat_name <>' '");
        $all_cat->setFetchMode(PDO:: FETCH_ASSOC);
        $all_cat->execute();

        while($row=$all_cat->fetch()):
            echo "<li><a href='cat_detail.php?cat_id=".$row['cat_id']."'>".$row['cat_name']."</a></li>";
        endwhile;
    }

    function cat_detail(){
        include("include/db.php");

        if(isset($_GET['cat_id'])){
            $cat_id=$_GET['cat_id'];
            $cat_pro=$con->prepare("SELECT * FROM products WHERE cat_id='$cat_id'");
            $cat_pro->setFetchMode(PDO:: FETCH_ASSOC);
            $cat_pro->execute();

            $cat_name=$con->prepare("SELECT * FROM stock WHERE cat_id='$cat_id'");
            $cat_name->setFetchMode(PDO:: FETCH_ASSOC);
            $cat_name->execute();

            $row=$cat_name->fetch();
            $row_main_cat=$row['cat_name'];
            echo "<h3>$row_main_cat</h3>";

            while($row_cat=$cat_pro->fetch()):
                // $pro_id=$row_pro['pro_id'];
                    echo "<li>
                                <a href='pro_detail.php?pro_id=".$row_cat['pro_id']."'>
                                    <h4>".$row_cat['pro_name']."</h4>
                                    <img src='../images/pro_img/".$row_cat['pro_img1']."' />
                                    <h4>".$row_cat['pro_weight']."</h4>
                                    <h4>RS ".$row_cat['pro_price']."/=</h4>
                                    <center>
                                        <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_cat['pro_id']."'>View</a></button>
                                        <button id='pro_btn'><a href='#'>Cart</a></button>
                                        <button id='pro_btn'><a href='#'>Whist List</a></button>
                                    </center>
                                </a>
                         </li>";

                    // echo "<h4>".$row_pro['pro_name']."</h4>";
                endwhile;
        }
    }

    function search(){
        include("include/db.php");

        if(isset($_GET['search'])){
        $user_input=$_GET['user_input'];

        $search=$con->prepare("SELECT * FROM products WHERE pro_name LIKE '%user_input%' OR pro_keyword LIKE '%$user_input%'");
        $search->setFetchMode(PDO::FETCH_ASSOC);
        $search->execute();

        echo "<div id='bodyleft'><ul>";

        if($search->rowCount()==0){
             echo "<h2>Product Not Found</h2>";
        }
        else{

        while($row_pro=$search->fetch()):
            echo "<li>
                        <a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>
                            <h4>".$row_pro['pro_name']."</h4>
                            <img src='../images/pro_img/".$row_pro['pro_img1']."' />
                            <h4>".$row_pro['pro_weight']."</h4>
                            <h4>RS ".$row_pro['pro_price']."/=</h4>
                            <center>
                                <button id='pro_btn'><a href='pro_detail.php?pro_id=".$row_pro['pro_id']."'>View</a></button>
                                <button id='pro_btn'><a href='#'>Cart</a></button>
                                <button id='pro_btn'><a href='#'>Whist List</a></button>
                            </center>
                        </a>
                 </li>";
        endwhile;
        }
        echo "</ul></div>";
        }
    }

    function getaddress(){
        include("include/db.php");

        if(isset($_POST['getaddress'])){
            $u_id = getIp();
            $fname = $_POST['fname'];
            $email = $_POST['email'];
            $u_address = $_POST['u_address'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $longitude = $_POST['longitude'];
            $latitude = $_POST['latitude'];

            $addDetails = $con->prepare("INSERT INTO getaddress(u_id, fname, email, u_address, city, zip, longitude, latitude) 
                                        VALUES('$u_id', '$fname', '$email', '$u_address', '$city', '$zip', '$longitude', '$latitude')");

            // echo "<script>alert('Not !')</script>";
            if($addDetails->execute()){
                echo "<script>alert('Your Location and Address Saved !')</script>";
            }
            else{
                echo "<script>alert('Not !')</script>";
            }
        }
    }

function getNetTotal(){
    include("include/db.php");
    $fetch_cart=$con->prepare("SELECT * FROM cart");
    $fetch_cart->setFetchMode(PDO::FETCH_ASSOC);
    $fetch_cart->execute();
    $net_total=0;
    while($row_cart=$fetch_cart->fetch()):
        $id1=$row_cart['pro_id'];
        $fetch_pro=$con->prepare("SELECT pro_id,pro_price FROM products WHERE pro_id='$id1'");
        $fetch_pro->setFetchMode(PDO::FETCH_ASSOC);
        $fetch_pro->execute();
        $row_pro=$fetch_pro->fetch();

        $sub_total=$row_pro['pro_price'] * $row_cart['qnty'];
        $net_total=$net_total+$sub_total;
    endwhile;
    return $net_total;
}

function cash(){
    include("include/db.php");

    $query = $con->prepare("UPDATE paymentdetails SET p_type='cash', p_date=NOW() WHERE u_id=0");
    if($query->execute()){
		echo "<script>alert('Your Cash Payment is Success !')</script>";
        echo "<script>window.open('indexuser.php', '_self')</script>";
	}
    else{
        echo "<script>alert('NOT !')</script>";
    }
}

?>
