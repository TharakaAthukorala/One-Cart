<div class="scroll" id="bodyright">
    <h2>View All Urgent Orders From Here</h2>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th>No.</th>
                <!-- <th>Order ID</th>     increment---->
                <th>User ID</th>
                <th>User Name</th>      <!--user---->
                <!-- <th>cart ID</th>      cart---->
                <!-- <th>Product ID</th> -->
                <th>Odered Date Time</th>
                <!-- <th>Product Name</th>     products---->
                <!-- <th>Image</th>        products---->
                <!-- <th>Weight</th>       products---->
                <!-- <th>Price (RS)</th>    products---->
                <!-- <th>Quantity</th>      -->
                <th>Order Type</th>  <!--cart---->
                <th>Net Total (RS)</th>
                <th>View Order</th>
                <th>Delivery</th>
            </tr>

            <?php include("include/deliverfunction.php");
                  // echo no_order();
                  echo view_Urgentorder();

            ?>


        </table>
    </form>
</div>
