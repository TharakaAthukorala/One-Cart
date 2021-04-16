<center>
    <div id="search">
            <form action="search.php" method="get" enctype="multipart/form-data">
                <input type="text" name='user_input' placeholder="Search From Here....!">
                <button name='search' id="search_btn">Search</button>
                <button id="cart_btn"><a href='cart.php'>Cart <?php echo cart_count();?> </a></button>
            </form>
        </div> <!----End of search---->
        </center>