<div class="scroll" id="bodyright">
    <h2>View Normal Order From Here</h2>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th>No.</th>
                <!-- <th>Order ID</th>     increment---->
                <!-- <th>User ID</th> -->
                <!-- <th>User Name</th>       -->
                <!-- <th>cart ID</th> -->
                <th>Product ID</th>
                <th>Added Date</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Weight</th>
                <th>Price (RS)</th>
                <th>Quantity</th>
                <!-- <th>Order Type</th> -->
                <th>Sub Total (RS)</th>
            </tr>

            <?php include("include/deliverfunction.php");
                  // echo no_order();
                  echo view_order();

            ?>


        </table>
    </form>
</div>
