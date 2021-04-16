<div class="scroll" id="bodyright">
    <h2>View Returned Items From Here</h2>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th>No.</th>
                <!-- <th>Cart ID</th> -->
                <!-- <th>User ID</th> -->
                <th>User Name</th>
                <th>Condition</th>
                <th>Image</th>
                <th>Status</th>
                <th>Deliver Date</th>
            </tr>

            <?php include("include/deliverfunction.php"); echo returned();?>

        </table>
    </form>
</div>
