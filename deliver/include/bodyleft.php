<nav class="sidebar">
    <div class="text">Content Management</div>
        <!-- <img src="images/slider/1.1.jpg" alt=""> -->
        <ul>
            <li><a href="indexdeliver.php?home">Home</a></li>
            <li><a href="indexdeliver.php?viewall_products">View All Products</a></li>


            <!-- <li><a href="indexdeliver.php?view_order">View Orders</a></li> -->
            <li><a href="#" class="serv-btn">View Orders<span class="fas fa-caret-down second"></span></a>
                <ul class="serv-show">
                <li><a href="indexdeliver.php?view_normal">View Normal Orders</a></li>
                <li><a href="indexdeliver.php?view_urgent">View Urgent Orders</a></li>
                </ul>
            </li>


            <li><a href="indexdeliver.php?view_user">View Users</a></li>
            <li><a href="#" class="serv-btn">Status<span class="fas fa-caret-down second"></span></a>
                    <ul class="serv-show">
                    <li><a href="indexdeliver.php?add_status">Add Deliver Status</a></li>
                    <li><a href="indexdeliver.php?view_status">View Deliver Status</a></li>
                    </ul>
            </li>
            <li><a href="indexdeliver.php?returned">Returned Items</a></li>
            <li><a href="indexdeliver.php?newMap">View Map</a></li>

        </ul>
</nav>
<script>
         $('.serv-btn').click(function()
         {
             $('nav ul .serv-show').toggleClass('show1');
             $('nav ul .second').toggleClass('rotate');
         });
         $('nav ul li').click(function()
         {
             $(this).addClass("active").siblings().removeClass("active");
         })
</script>

    <?php

        if(isset($_GET['home'])){
            include("home.php");
        }
        if(isset($_GET['viewall_products'])){
            include("viewall_products.php");
        }


        if(isset($_GET['view_normal'])){
            include("view_normal.php");
        }

                if(isset($_GET['view_Normalorder_VIEW'])){
                    include("view_Normalorder_VIEW.php");
                }

        if(isset($_GET['view_urgent'])){
            include("view_urgent.php");
        }
                if(isset($_GET['view_Urgentorder_VIEW'])){
                    include("view_Urgentorder_VIEW.php");
                }

        if(isset($_GET['view_user'])){
            include("view_user.php");
        }


        if(isset($_GET['add_status'])){
            include("add_status.php");
        }

        if(isset($_GET['view_status'])){
            include("view_status.php");
        }

        if(isset($_GET['newMap'])){
            include("newMap.php");
        }

        if(isset($_GET['returned'])){
            include("returned.php");
        }
    ?>
