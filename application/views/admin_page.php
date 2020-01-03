<html>
    <?php
    if (isset($this->session->userdata['logged_in'])) {
        $id = ($this->session->userdata['logged_in']['id']);
        $role = ($this->session->userdata['logged_in']['role']);
        $uker = ($this->session->userdata['logged_in']['uker']);
    } else {
        header("location: login");
    }
    ?>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="profile">
            <?php
                echo "Hello <b id='welcome'><i>" . $id . "</i> !</b>";
                echo "<br/>";
                echo "<br/>";
                echo "Welcome to Admin Page";
                echo "<br/>";
                echo "<br/>";
                echo "Your Username is " . $id;
                echo "<br/>";
                echo "Your role is " . $role;
                echo "<br/>";
                echo "Your uker is " . $uker;
                echo "<br/>";
            ?>
            <b id="logout"><a href="logout">Logout</a></b>
        </div>
        <br/>
    </body>
</html>