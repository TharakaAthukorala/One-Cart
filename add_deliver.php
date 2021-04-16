<div id="bodyright">
    <h2>Add New Delivery Person From Here</h2>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Enter Name Of The Delivery Person:</td>
                <td><Input type="text" name="d_name" placeholder="Name" required/></td>
            </tr>
            <tr>
                <td>Enter NIC No:</td>
                <td><Input type="text" name="d_nic" placeholder="908876543" pattern='[0-9]{9}|[0-9]{12}' maxlength="12" size="12" required/></td>
            </tr>
            <tr>
                <td>Add Image:</td>
                <td><Input type="file" name="d_img" required/></td>
            </tr>
            <tr>
                <td>Enter Email:</td>
                <td><Input type="email" name="d_email" placeholder="Email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z](2,4}$" required/></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><textarea type="text" name="d_add" id="" cols="" rows="3" placeholder="Address Here ...."required></textarea></td>
            </tr>
            <tr>
                <td>Contact No:</td>
                <td><Input type="tel" name="d_phone" placeholder='Ex: 0771231231' pattern='[0-9]{3}[0-9]{3}[0-9]{4}' size='12' maxlength='12' required/></td>
                 <!-- pattern='[0-9]{3}-[0-9]{3}-[0-9]{4}' -->
            </tr>

            <tr>
                <td>Password:</td>
                <td><Input type="password" name="d_pass_1" placeholder="*********" required/></td>
            </tr>
            <tr>
                <td>Confirm password:</td>
                <td><Input type="password" name="d_pass_2" placeholder="*********" required/></td>
            </tr>


        </table>
        <center><button name="add_deliver">Add Deliver</button></center>
    </form>
</div>

<?php
    include("include/managerfunction.php");
    echo add_deliver();
?>
