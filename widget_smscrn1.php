<?php header('Access-Control-Allow-Origin: *'); 
$path_url = "http://www.seekahoo.com/seekahoo_widgets/review_widget/";
$vals = $_REQUEST['vals'];
$exp = explode(":",$_REQUEST['vals']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Seekahoo - Review Widget</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="seekahoo-widget">
	
	<!-- Owl Carousel Assets -->
	<link href="<?php echo $path_url; ?>owl_carousel/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo $path_url; ?>owl_carousel/css/owl.theme.css" rel="stylesheet">
	
</head>

<body>
<?php
//mysql_connect("localhost","root","$33kahoo!");
//mysql_select_db("sample_widget");
date_default_timezone_set('America/Los_Angeles');
?>
<style type="text/css">
	.widget_content{font-family:Calibri;font-size:12px;}
	.divider{clear:both;height:1px;background:#ccc;width:100%;margin-top:5px;margin-bottom:5px}
	div{
			border: 0px solid black;
	}
	#wd_id{
		clear:both;
	}
	.owl-prev{
		position:absolute;
		top:35%;
		left:2px;
		background-image: url("<?php echo $path_url; ?>images/previous.png") !important;
		width:16px;
		height:32px;
	}
	.owl-next{
		position:absolute;
		top:35%;
		right:2px;
		background-image: url("<?php echo $path_url; ?>images/next.png") !important;
		width:16px;
		height:32px;
	}
	.owl-pagination{
		display:none;
	}
	.seek_widget{
		border:1px solid #e9e9e9;
		width:auto;
		position:relative;
		padding-bottom:5px;
	}
	.widget_text{
		/*float:left;*/
		width:90%;
		margin-top:10px;
	}
	.widget_title{
		display:table;
		margin:15px;
		padding:0px;
	}
	.widget_title h2{
		float:right;
		margin: 0 0 0 5px;
		color:#116a9d;
		font-size:18px;
	}
	.seek_widget{
			width:<?php echo $exp[3]; ?>
	}
	.owl-carousel{
	}
	.review_slide{
		float: left;
		width: 100%;
	}
	.review_slide{
		text-align:center;
	}
	.review_slide img{
		margin-left:-45px;
		float:none !important;
	}
	@media screen and (max-width: 600px) {
		div{
			border: 0px solid blue;
		}
		.seek_widget{
			width:auto;
		}
		/*.widget_text{
			width:250px;
		}*/
		
	}
	@media screen and (max-width: 520px) {
		div{
			border: 0px solid black;
		}
		.review_text{
			display: block;position: relative;top:5px;left: -25px;
		}
		
		.widget_text{
			margin-left:0px;
			width:88%;
			/*text-align:left;*/
		}
		.review_slide{
			text-align:center;
		}
		.review_slide img{
			margin-left:-45px;
			float:none !important;
		}
	}
	@media screen and (max-width: 440px) {
		div{
			border: 0px solid gray;
		}
		.widget_text{
			width:87%;
		}
	}
	@media screen and (max-width: 320px) {
		div{
			border: 0px solid green;
		}
		.widget_text{
			width:84%;
		}
	}
	
</style>
<div class="widget_content">
<table>
<?php	
			//print_r($_REQUEST['vals']);
			
			//print_r($exp);
			$user_id = $exp[0];
			$con_name = $exp[1];
			$con_tag_name = $exp[2];
			$fields_string = '';
			$api_url = "http://54.68.101.97/seekahoo/index.php/";
			$image_url = "https://s3-us-west-2.amazonaws.com/seekahoo-bucket/";
			$url = $api_url.'widget/get_web_user_overall_details';
			$fields = array(
				'user_id'=> $user_id,
				'page_size'=> 50,
				'scroll_position'=> 0
				);
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string,'&');

			$ch = curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_POST,count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//execute post
			
		     $result_overall = curl_exec($ch);
		   //exit;
		     $dat3 = json_decode($result_overall);
				//echo("<pre>");
				//print_r($dat3->data->reviews);
			$like_count = 0;
			foreach($dat3->data->reviews as $key=>$value){
					$like_count = $like_count+$value->Likescnt;
			}
			$review_count=count($dat3->data->reviews);
			//print_r($dat3->data->reviews);
?>
</table>
<!--height:400px; overflow-y:scroll; overflow-x: hidden;-->
<div class="seek_widget" style="">
	<div style="" class="widget_title"><img src="<?php echo $path_url; ?>images/hand1.png" style="position:relative;" /> 
	<h2 style="">(<?php echo $review_count; ?>)<span class="review_text"> <a href="https://seekahoo.com/pros/reviews/<?php echo $con_tag_name; ?>" style="color:#f89934;text-decoration:none;" target="_blank" style="z-index:1000;">#Reviews for <?php echo substr($con_name,0,15);if(strlen($con_name)>15){ echo "..."; } //echo $con_name; ?></a></span></h2><a href="http://www.seekahoo.com" target="_blank"><img style="width:100px;position:absolute;right:10px;top:10px;" src="<?php echo $path_url; ?>images/seekahoo_logo.png"/></a></div>
	<div id="owl-demo" class="owl-carousel">
		<?php foreach($dat3->data->reviews as $key=>$value){ ?>
			<div style="display:table;margin:0 22px 20px;padding:0px;clear:both;color: #353434;font-size:14px;width:100%" class="item">
			<div class="review_slide">
				<a href="https://seekahoo.com/pros/reviews/<?php echo $con_tag_name; ?>" style="margin:0 15px;" target="_blank"><img src="<?php echo $image_url.$value->media_thumb_url; ?>" style="float:left;padding:5px;border:1px solid #e9e9e9;" width="190" height="190"/></a>
				<div style="" class="widget_text">
					<div style="display:table;width:100%";><p style="margin:0;"><?php echo date('F j, Y', strtotime($value->post_created_date));?></p><p style="margin:0;"><?php echo $value->location; ?></p></div>
					<p style="clear:both;"><?php echo substr($value->caption,0,200);if(strlen($value->caption)>200){ echo "..."; } ?></p>
				</div>
			</div>
		</div>
		<?php }
		?>
	</div>
</div>
</div>
	<!--<script src="<?php echo $path_url; ?>owl_carousel/js/owl.carousel.js">--></script>
  </body>
</html>