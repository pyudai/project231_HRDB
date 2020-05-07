        <?php
            $con = mysqli_connect("localhost", "root", "yourpasswd", "hr_database");

            if (mysqli_connect_error()) {
                echo "Failed to Connect to MySQL : " . mysqli_connect_error();
            }
        ?>