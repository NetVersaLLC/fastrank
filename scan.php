<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Fast Rank</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/style.css" rel="stylesheet">
        <script src="//static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try{ clicky.init(100601920); }catch(e){}</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100601920ns.gif" /></p></noscript></head>
	<body>
	<?php include 'header.php'; ?>
		<section>
			<article class="main_content">
				<div class="header_nav_div"></div>
				<div class="sub_main_content">
					<div class="container pt_40">
						<p class="scan_title">Directory Listing Scan Results</p>
						<div class="scan_container">
							<div class="scan_error_content">
								<p class="scan_error_title">0</p>
								<p class="scan_error_txt">Location Data<br/>Errors Detected</p>
							</div>
							<img src="images/scan_arrow.png" width="24" height="44" class="scan_arrow_img"/>
							<input type="button" value="Update" class="scan_update_btn"/>
						</div>
						<div class="clearfix"></div>
						<p class="scan_error_sub"><?php $_GET['address'] ?></p>
						<a href="#" class="scan_error_phone"><?php $_GET['phone'] ?></a>
						<p class="scan_error_phone_txt">(This isn't my business informaion)</p>
						<div class="clearfix"></div>
						<script type="text/javascript">
  function loadSite(data){
    console.log(data);
    try {
			if (data['error'] == null) {
				res = data['result'];
				$('#'+data['site']).html(res[0]);
				res = data['result'];
				val = parseInt($('.scan_error_title').html(), 10);
				if (res[0] != 'listed') {
					val += 20;
				}
				$('.scan_error_title').html(val);
			} else if (data != null) {
				$('#'+data['site']).html('Error');
				res = data['result'];
				if (res != null) {
					val = parseInt($('.scan_error_title').html(), 10);
					if (res[0] != 'listed') {
						val += 20;
					}
					$('.scan_error_title').html(val);
				}
			}
		} catch (err) {
			console.log(err)
		}
  }
  function loadSites(data){
    $('#sites').html('<table><tbody id="sitestable"></tbody></table>')
    $.each(data, function(i,e){
      $('#results').append('<tr><td class="scan_td_1">'+e+'</td><td class="scan_td_2"></td><td class="scan_td_3"><div class="scan_error_found">NOT FOUND</div></td><td class="scan_td_4"></td><td class="scan_td_5">Not standing out</td><td class="scan_td_6"><div class="scan_wrong_number"><span><img src="images/scan_close.png" width="11" height="11"></span><p id="'+e+'">Searching...</p></div></td></tr>');
      name    = window.myName;
      zip     = window.myZip;
      address = window.myAddress;
      city    = window.myCity;
      phone    = window.myPhone;
       $.ajax({
	url: 'http://sync.fastrank.net/scan/sites/'+e+'.json?callback=loadSite&name='+name+'&zip='+zip+'&address='+address+'&city='+city+'&phone='+phone,
	dataType: 'jsonp',
	jsonpCallback: 'loadSite'
      });
    });
  }


  $(document).ready(function(){
    window.myName    = escape('<?php echo $_GET["name"] ?>');
    window.myZip     = escape('<?php echo $_GET["zip"] ?>');
    window.myAddress = escape('<?php echo $_GET["address"] ?>');
    window.myCity    = escape('<?php echo $_GET["city"] ?>');
    window.myPhone   = escape('<?php echo $_GET["phone"] ?>');
    $.getJSON('http://sync.fastrank.net/scan/sites.json&callback=loadSites', loadSites)
  });

$(document).ready(function(){
	$('#emailsub').submit(function() {		
  		var email = $('#email').val()
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    	if (!pattern.test(email)){
    		$('#email_required').modal()
	    	return false;
		}
  		var request = $.ajax({
        	url: "/emailsub.php",
        	type: "post",
        	dataType: "text",
        	data: { email : email },
        	success: function(response, textStatus, jqXHR){        		
        		if (response == "Failed") {
        			alert("Something went wrong.")
        		} else {        			
        			$("#submitemail").attr("disabled", "disabled");
        			$('#subscribe_success').modal()
        			
        		}
        	}
    	});

  		return false;
	});
});

						</script>
						<table class="scan_error_table">
							<thead>
								<tr>
									<td></td>
									<td>Business Name</td>
									<td>Address</td>
									<td>Phone</td>
									<td>Special Offer</td>
									<td>Status</td>
								</tr>
							</thead>
							<tbody id="results">
							</tbody>
						</table>
						<div class="clearfix"></div>
						<p class="scan_error_sub">Sign up with your email below and get a report with your listing status in over 40 directories!</p>
						<div class="clearfix"></div>
						<p class="scan_error_sub">
<form class="form-search" id="emailsub" method="post" action="#">
  <input type="text" class="input-medium search-query" id="email" name="email" value="">
  <button type="submit" class="btn" id="submitemail">Sign Up</button>
</form>
</p>
						<div class="clearfix pt_40"></div>
					</div>						
				</div>

			</article>
		</section>
		<?php include 'footer.php'; ?>


<div id="email_required" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Email Required" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="EmailRequiredLabel">Invalid Email</h3>
  </div>
  <div class="modal-body">
    <h4 style="color:red">Please enter a valid email address!</h4>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>    
  </div>
</div>

<div id="subscribe_success" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Success" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="successLabel">Success!</h3>
  </div>
  <div class="modal-body">
    <h4>You have been subscribed! A report will be sent to your email shortly.</h4>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>    
  </div>
</div>



	</body>
</html>
