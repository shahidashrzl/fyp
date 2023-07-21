<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-indigo w3-card" id="myNavbar">

        &nbsp;<a href="index.php" class="w3-bar-item1"><img src="images/logofyp.png" height="60"></a>


        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">


            <a href="index.php" class="w3-bar-item w3-button">HOME</a>


            <a href="service.php" class="w3-bar-item1 w3-button">SERVICES</a>


            <a onclick="document.getElementById('id01').style.display='block'"
                class="w3-padding w3-round-xlarge w3-border w3-border-white w3-blue w3-bar-item1 w3-button w3-margin-right">
                CUSTOMER <i class="fa fa-fw fa-lg fa-user"></i></a>

            <a href="login-sp.php" class="w3-bar-item1 w3-button">SERVICE PROVIDER</a>

        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->


        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
            onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>


    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-basil w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none"
    id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>

    <a href="service.php" onclick="w3_close()" class="w3-bar-item w3-button">SERVICES</a>
    <a onclick="document.getElementById('id01').style.display='block' ; w3_close();" class="w3-bar-item w3-button">CUSTOMER</a>
    <a href="login-sp.php" onclick="w3_close()" class="w3-bar-item w3-button">SERVICE PROVIDER</a>

</nav>


<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
        <header class="w3-container w3-center">
            <span onclick="document.getElementById('id01').style.display='none'"
                class="w3-button w3-display-topright w3-circle">&times;</span>
            <h2><b>CUSTOMER LOGIN </b></h2>
            Sign in to your account
        </header>
        <hr>
        <div class="w3-container w3-padding w3-margin">

            <form action="" method="post">
                <div class="w3-section">
                    <label>Email *</label>
                    <input class="w3-input w3-border w3-round" type="email" name="email" required>
                </div>
                <div class="w3-section">
                    <label>Password *</label>
                    <input class="w3-input w3-border w3-round" type="password" name="password" maxlength="20" required>
                </div>
                <input name="act" type="hidden" value="login">
                <button type="submit"
                    class="w3-button w3-block w3-padding-large w3-blue w3-wide w3-margin-bottom w3-round">Login</button>
            </form>
            <div class="w3-center">No account ? <a href="#" onclick="document.getElementById('id01').style.display='none';
		 document.getElementById('id02').style.display='block';" class="w3-text-blue">REGISTER HERE</a></div>
        </div>

        <footer class="w3-container ">
            &nbsp;
        </footer>
    </div>
</div>


<div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
        <header class="w3-container w3-center">
            <span onclick="document.getElementById('id02').style.display='none'"
                class="w3-button w3-display-topright w3-circle">&times;</span>
            <h2><b>CUSTOMER REGISTRATION</b></h2>
            Sign up new account
        </header>
        <hr>
        <div class="w3-container w3-padding w3-margin">

            <form action="" method="post">
                <div class="w3-section">
                    <label>Name *</label>
                    <input class="w3-input w3-border w3-round" type="text" name="name" required>
                </div>
                <div class="w3-section">
                    <label>Email *</label>
                    <input class="w3-input w3-border w3-round" type="email" name="email" required>
                </div>
                <div class="w3-section">
                    <label>Password *</label>
                    <input class="w3-input w3-border w3-round" type="password" name="password" maxlength="20" required>
                </div>
                <div class="w3-section">
                    <label>Mobile Phone *</label>
                    <input class="w3-input w3-border w3-round" type="text" name="phone" required>
                </div>

                <input name="act" type="hidden" value="add">
                <button type="submit"
                    class="w3-button w3-block w3-padding-large w3-blue w3-wide w3-margin-bottom w3-round">Register</button>
            </form>
            <div class="w3-center">Already registered ? <a href="#" onclick="document.getElementById('id01').style.display='block';
		 document.getElementById('id02').style.display='none'" class="w3-text-blue">LOGIN HERE</a></div>
        </div>

    </div>
</div>