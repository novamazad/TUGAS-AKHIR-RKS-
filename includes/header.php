<?php
     ?>
    <?php
        require_once 'includes/connection.php';
        $quantity = 0;
        $page = $_SESSION["page"];
        if(isset($_COOKIE["shopping_cart"]))
        {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        

        foreach($cart_data as $keys => $values)
            $quantity += $values["item_quantity"];
        }
	?>
    <div id="top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pt-2 offer">
                   <a href="index.php"><i class="fa fa-book">&nbsp;Elearning UNIVERSITAS</i></a>
                    
                </div>
                <div class="col-md-6">
                    <?php if (!isset($_SESSION["login"])) : ?>
                    <ul class="menu">
                        <?php if ($page != "register")  : ?>
                        <li><a href="register.php">Register</a></li>
                        <?php endif ?>
                        <?php if ($page != "login")  : ?>
                        <li><a href="login.php">Login</a></li>
                        <?php endif ?>
                    </ul>
                    <?php endif ?>
                    <?php if (isset($_SESSION["login"])) : ?>
                    <ul class="menu">
                        <li><a href="">Welcome, <?php echo $_SESSION['username'] ?></a></li>
                        <li><a href="logout.php"><button class="btn btn-sm btn-danger">Log Out</button></a></li>
                    </ul>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ($page != "login" && $page != "register"): ?>
    <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navigation">
                <div class="padding-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Shopping Cart</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="clearfix">
                <?php if ($page == "index") : ?>
                    <a href="cart.php" class="btn btn-primary navbar-btn right">
                        <i class="fa fa-shopping-cart"></i>
                        <span><?php echo $quantity; ?> Barang Di Keranjang</span>
                    </a>
                <?php endif ?>
            </div>
        </div>
    </nav>
    <?php endif ?>