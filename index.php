<?php

require 'zklibrary.php';

$zk = new ZKLibrary('192.168.20.46', 4370);
$zk->connect();
$zk->disableDevice();

$users = $zk->getUser();


?>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<style>
  #heading{
    font-size: 49px;
    text-align: center;
    color: wheat;
    text-shadow: 3px 3px 3px black;
  }

</style>


<div id="heading">AfriQ Network Solutions</div>

<table class="table table-striped table-dark"  >
<thead>
  <tr>
     
    <th width="25">No</th>
    <th scope="col">DefaultID</th>
      <th scope="col">UserID</th>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
      <th scope="c">Password</th>
  </tr>
</thead>
<tbody>
<?php
$no = 0;
foreach($users as $key => $user)
{
  $no++;
  ?>
  <tr>
    <td align="right"><?php echo $no; ?></td>
    <td><?php echo $key; ?></td>
    <td><?php echo $user[0]; ?></td>
    <td><?php echo $user[1]; ?></td>
    <td><?php echo $user[2]; ?></td>
    <td><?php echo $user[3]; ?></td>
  </tr>
  <?php
}
?>
</tbody>
</table>
<?php

$zk->enableDevice();
$zk->disconnect();

?>