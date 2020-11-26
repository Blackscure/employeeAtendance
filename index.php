<?php

require 'zklibrary.php';

$zk = new ZKLibrary('192.168.20.46', 4370);
$zk->connect();
$zk->disableDevice();

$users = $zk->getUser();

?>
  <table border="1" cellpadding="5" cellspacing="2" style="float: left; margin-right: 10px;">
            <tr>
                <th colspan="5">Data User</th>
            </tr>
            <tr>
                <th>UID</th>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Password</th>
                <th>time</th>
            </tr>
            <?php
            try {
                
                //$zk->setUser(1, '1', 'Admin', '', LEVEL_ADMIN);
                $user = $zk->getUser();
                sleep(1);
                while(list($uid, $userdata) = each($user)):
                    if ($userdata[2] == LEVEL_ADMIN)
                        $role = 'ADMIN';
                    elseif ($userdata[2] == LEVEL_USER)
                        $role = 'USER';
                    else
                        $role = 'Unknown';
                ?>
                <tr>
                    <td><?php echo $uid ?></td>
                    <td><?php echo $userdata[0] ?></td>
                    <td><?php echo $userdata[1] ?></td>
                    <td><?php echo $role ?></td>
                    <td><?php echo $userdata[3] ?>&nbsp;</td>
                </tr>
                <?php
                endwhile;
            } catch (Exception $e) {
                header("HTTP/1.0 404 Not Found");
                header('HTTP', true, 500); // 500 internal server error                
            }
            //$zk->clearAdmin();
            ?>
        </table>

<table border="1" cellpadding="5" cellspacing="2">
            <tr>
                <th colspan="6">Data Attendance</th>
            </tr>
            <tr>
                <th>Index</th>
                <th>UID</th>
                <th>ID</th>
                <th>Status</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            $attendance = $zk->getAttendance();
            sleep(1);
            while(list($idx, $attendancedata) = each($attendance)):
                if ( $attendancedata[2] == 14 )
                    $status = 'Check Out';
                else
                    $status = 'Check In';
            ?>
            <tr>
                <td><?php echo $idx ?></td>
                <td><?php echo $attendancedata[0] ?></td>
                <td><?php echo $attendancedata[1] ?></td>
                <td><?php echo $status ?></td>
                <td><?php echo date( "d-m-Y", strtotime( $attendancedata[3] ) ) ?></td>
                <td><?php echo date( "H:i:s", strtotime( $attendancedata[3] ) ) ?></td>
            </tr>
            <?php
            endwhile
            ?>
        </table>
<?php

$zk->enableDevice();
$zk->disconnect();

?>