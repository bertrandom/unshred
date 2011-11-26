<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$solution_id = md5(time());
		
		if (isset($_POST['slice_order'])) {
						
			$slices = explode(",", $_POST['slice_order']);
			
			if (count($slices) == 20) {

				$params = '';

				foreach ($slices as $slice) {
					$params .= (int)$slice . '.jpg ';
				}

				file_put_contents('/var/www/recollect/unshred.recollect.com/out/order.txt', $params);
				file_put_contents('/var/www/recollect/unshred.recollect.com/out/solution_' . $solution_id . '.txt', $params);
				
				$order = $slices;
				
			}
						
		}
		
	} else {
		
		$order = range(1,20);
		
	}

?>
<!doctype html public>
<head>
  	<meta charset="utf-8">
  	<title dir="ltr">Unshred</title>
	<link rel="stylesheet" href="bootstrap.min.css">
	<style type="text/css">
		.paddy {
			margin-top: 10px;
		}
	</style>
	<script src="jquery-1.6.2.min.js" type="text/javascript"></script>
	<script src="jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap-alerts.js" type="text/javascript"></script>
	<?php if ($_SERVER['REQUEST_METHOD'] != 'POST'): ?>
	<script type="text/javascript">
		
		$(function() {
			
			$( "#sortable" ).sortable({
				update: function(event, ui) {
					
					var slices = document.getElementById('sortable').children;
					
					var slice_order = [];
					
					for (i = 0; i < slices.length; i++) {
						slice_order[slice_order.length] = slices[i].id.replace('slice', '');
					}
					
					document.getElementById('slice_order').value = slice_order.join(',');
					
				}
			});
			$( "#sortable" ).disableSelection();
			
		});
		
	</script>
	<?php endif; ?>
</head>
<body>
	
<div class="container">

  <div class="content">
	  <div class="row paddy">
		<div class="span16" style="text-align: center;">
		
		<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
		
			<div class="alert-message success fade in" data-alert="alert">
				<a class="close" href="#">×</a>
				<p>
					<strong>Thanks!</strong> Your solution has been recorded.
				</p>
			</div>
		
			<h1>Your solution ID: <?php echo $solution_id; ?></h1>
		
		<?php else: ?>

	    	<h1>Drag the slices around until the photo looks right</h1>
		
		<?php endif; ?>
		
		</div>
	  </div>
    <div class="row">
      <div class="span16" style="text-align: center;">
		<div id="sortable">
			<?php foreach ($order as $i): ?><img id="slice<?php echo $i; ?>" src="<?php echo $i; ?>.jpg" /><?php endforeach; ?>
		</div>
      </div>
    </div>
	
	<?php if ($_SERVER['REQUEST_METHOD'] != 'POST'): ?>
	
    <div class="row paddy">
      <div class="span16" style="text-align: center;">
		<form name="solution" action="/" method="POST">
			<input type="hidden" id="slice_order" name="slice_order" value="<?php echo implode(',', $order); ?>" />
			<button class="btn large primary btn_done">I'm done!</button>
		</form>
      </div>
    </div>

	<?php endif; ?>
	
  </div>

</div> <!-- /container -->	

</body>