<?php 

$time = 0;
if( isset($_GET['time']) && is_numeric($_GET['time']) && $_GET['time'] > 0 )
	$time = $_GET['time'];

$title 	 = '';
$img_src = '';

function get_data() {
	global $title;
	global $img_src;
	
	$url = 'http://thecodinglove.com/random';
	$source = file_get_contents( $url );
	$source = str_replace("\r", "", str_replace("\n","", trim($source)) );	
	$pattern = '/class\="post"id\="post1"\>(.+)\<\!-- end NORMAL TEXT POST --\>/';
	preg_match($pattern, $source, $matches, PREG_OFFSET_CAPTURE, 2);
	$data = isset($matches[1][0]) ? $matches[1][0] : '';
	
	$title_pattern = '/\<h3\>(.+)\<\/h3\>/';
	preg_match($title_pattern, $data, $matches, PREG_OFFSET_CAPTURE, 2);
	$title = isset($matches[1][0]) ? $matches[1][0] : 'Cannot get content';

	$img_url_pattern = '/<img src\="([^"]+)">/';
	preg_match($img_url_pattern, $data, $matches2, PREG_OFFSET_CAPTURE, 2);
	$img_src = isset($matches2[1][0]) ? $matches2[1][0] : '';
}

get_data();

?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" href="../../favicon.ico">
        <title>The coding love !</title>
		
        <!-- Bootstrap core CSS -->
        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		
		<!--[ CSS ]-->
		<style type="text/css">
			body{
				background-color: #eaeaea;
			}
			.source_image{
				margin: 0 auto;
			}
			.config_area{
				max-width: 270px; 
				margin: 0 auto;
			}
			input#time{
				color: #333;
				width: 40px
			}
		</style>
    </head>
    <body>
        <div class="container">
		
			<div class="row">
				
				<div class="col-md-12 text-center">
					
					<h1><?php echo $title; ?></h1>
					
					<img src="<?php echo $img_src; ?>" alt="" class="img-responsive source_image" />
					
				</div>
				
			</div>
		
			<br />
			<br />
			<br />
			
			<footer>
				
				<div class="row">
				
					<div class="col-md-12 text-center">
						<a href="javascript:;" class="btn btn-success next_btn" onclick="reload_page();">
							NEXT
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
						
						<br />
						<br />
						<br />
						<br />
						<br />
						
						<div class="alert alert-info config_area">
							<form action="">
								Get next one after 
								<input type="number" name="time" id="time" value="<?php echo $time; ?>"/>
								second(s)
								<br />
								<br />
								<p class="text-center">
									<small>Set 0 for disable auto get next</small>
								</p>
								
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
						
					</div>
					
				</div>
				
			</footer>
		
        </div>
        <!-- /container -->
		
		<script type="text/javascript">
			
			//reload
			function reload_page() {
				window.location.reload();
			}
			
			<?php if($time): ?>
			
				//set timeout if auto next set
				setTimeout(function(){ 
					window.location.reload();
				}, <?php echo $time*1000; ?> );
				
			<?php endif; ?>

		</script>
		
    </body>
</html>