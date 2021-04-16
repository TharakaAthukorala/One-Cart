<div class="scroll" id="bodyright">
    <h2>View all Users</h2>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>

                <th>Email</th>
                <th>City</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Added Date</th>
            </tr>

            <?php include("include/deliverfunction.php"); echo view_user();?>

        </table>
    </form>
</div>
