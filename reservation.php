<?php 

	include_once('../config.php');//database
	$db = new Database();

?>

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Boat Booking</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/jquery.dataTables.css">

		 <!--pagination-->
	    <link rel="stylesheet" href="../bootstrap/css/jquery.dataTables.css"><!--searh box positioning-->
	    <script src="../bootstrap/	js/jquery.dataTables2.js"></script>


	</head>

	<style type="text/css">
		.navbar { margin-bottom:0px !important; }
		.carousel-caption { margin-top:0px !important }

		td.align-img {
			line-height: 3 !important;
		}

		
		.well
        {
            background: rgba(0,0,0,0.7);
            border: none;
    
        }
        .wellfix
        {
            background: rgba(0,0,0,0.7);
            border: none;
            height: 150px;
        }
		body
		{
			background-image: url('../img/background5.png');
			background-repeat: no-repeat;
			background-attachment: fixed;
		}
		p
		{
			font-size: 13px;
		}
        .pro_pic
        {
            border-radius: 50%;
            height: 50px;
            width: 50px;
            margin-bottom: 15px;
            margin-right: 15px;
        }
		
	</style>

	<body>

		<!-- begin whole content -->
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<img src="../img/boatlogo.png" height="50" width="50"> &nbsp;
					</div>
			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li><a href="#" style="font-family: Times New Roman; font-size: 30px;">Boat Booking</a></li>
						</ul>

						<ul class="nav navbar-nav" style="font-family: Times New Roman;">
							<li>
								<a href="index.php">Boats</a>
							</li>
							<li  class="active">
								<a href="myreservation.php">My Reservation</a>
							</li>
						</ul>
						
						<ul class="nav navbar-nav navbar-right" style="font-family: Times New Roman;">
							<li>
								<?php include_once('../includes/logout.php'); ?>
							</li>
						
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
		<!-- end -->

		<br />
		<br />
		<br />
		<br />
		
		<!-- main cntent -->
		
		
 <div class="container">
			
			<br />
			<br />

			
		 <br />
		 	 <table id="myTable" class="table table-striped" >  
				<thead>
					<th>TOURIST</th>
					<th>CONTACT</th>
					<th>ADDRESS</th>
					<th><center>IMAGE</center></th>
					<th>BOAT NAME</th>
					<th>OPERATOR NAME</th>
					<th>DESTINATION</th>
					<th>DATE</th>
					<th>TIME</th>
					<th>PRICE</th>
					<th>Accept/Cancel</th>
					
				</thead>
				<tbody>
					<?php 
			$sql = "SELECT * FROM reservation r INNER JOIN boats b ON b.b_id = r.b_id
			INNER JOIN tourist t ON t.tour_id = r.tour_id
			";
			$res = $db->getRows($sql);

			// echo print_r($res);

			foreach ($res as  $r) {

				$r_id = $r['r_id'];
				$tfn = $r['tour_fN'];
				$tmn = $r['tour_mN'];
				$tln = $r['tour_lN'];
				$tcontact = $r['tour_contact'];
				$taddress = $r['tour_address'];
				$img = $r['b_img'];
				$bn = $r['b_name'];
				$bon = $r['b_on'];
				$dstntn = $r['r_dstntn'];
				$bprice = $r['b_price'];
				$rdate = $r['r_date'];
				$rhr = $r['r_hr'];
				$rampm = $r['r_ampm'];

				$oras = $rhr.' '.$rampm;
		?>
					<tr>
						<td class="align-img"><?php echo $tfn.' '.$tmn.' '.$tln; ?></td>
						<td class="align-img"><?php echo $tcontact; ?></td>
						<td class="align-img"><?php echo $taddress; ?></td>
						<td class="align-img"><center><img src="<?php echo $img; ?>" width="50" height="50"></center></td>
						<td class="align-img"><?php echo $bn; ?></td>
						<td class="align-img"><?php echo $bon; ?></td>
						<td class="align-img"><?php echo $dstntn; ?></td>
						<td class="align-img"><?php echo $rdate; ?></td>
						<td class="align-img"><?php echo $oras; ?></td>
						
						<td class="align-img"><?php echo 'Php '.number_format($bprice, 2); ?></td>
					
						<td class="align-img">
  <button class="btn btn-success" onclick="acceptReservation(<?php echo $r_id; ?>)">Accept</button>
  <button class="btn btn-danger" onclick="cancelReservation(<?php echo $r_id; ?>)">Cancel</button>
</td>
<script>
function acceptReservation(id) {
  // Send a request to the server to accept the reservation with the given ID
  $.ajax({
    type: "POST",
    url: "accept_reservation.php",
    data: { reservation_id: id },
    success: function(response) {
      // Reload the page to show the updated reservations
      location.reload();
    }
  });
}

function cancelReservation(id) {
  // Send a request to the server to cancel the reservation with the given ID
  $.ajax({
    type: "POST",
    url: "cancel_reservation.php",
    data: { reservation_id: id },
    success: function(response) {
      // Reload the page to show the updated reservations
      location.reload();
    }
  });
}
</script>

					</tr>
					<?php
			}//end foreach loop of display all resevdbation


		?>



				</tbody>
			</table>

		 </div>

			
		<!-- main cntent -->

	</body>
 		<script src="../bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="../bootstrap/js/dataTables.js"></script>
 		<script src="../bootstrap/js/dataTables2.js"></script>
 		<script src="../bootstrap/js/bootstrap.js"></script>
 		    <!--pagination-->
    <link rel="stylesheet" href="../bootstrap/css/jquery.dataTables.css"><!--searh box positioning-->
    <script src="../bootstrap/js/jquery.dataTables2.js"></script>


    <script>
//script for pagination
$(document).ready(function(){
    $('#myTable').dataTable();
});
    </script>


		
		<!-- main cntent -->

	</body>
 		<script src="../bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="../bootstrap/js/dataTables.js"></script>
 		<script src="../bootstrap/js/dataTables2.js"></script>
 		<script src="../bootstrap/js/bootstrap.js"></script>
 		    <!--pagination-->
    <link rel="stylesheet" href="../bootstrap/css/jquery.dataTables.css"><!--searh box positioning-->
    <script src="../bootstrap/js/jquery.dataTables2.js"></script>






</html>



<?php 
$db->Disconnect();
?>