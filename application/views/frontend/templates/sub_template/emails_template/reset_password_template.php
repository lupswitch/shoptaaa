<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Shopta App</title>
		<link href="http://mailgun.github.io/transactional-email-templates/styles.css" media="all" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		
		<table class="body-wrap">
			<tr>
				<td></td>
				<td class="container" width="600" style="background-color:#f5f5f5;color:#333;padding:15px;">
					<div class="content">
						<table class="main" width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td class="content-wrap">
									<table width="100%" cellpadding="0" cellspacing="0">
									
										<tr>
											<td class="content-block" style="padding: 6px 0;line-height: 22px;font-size:16px">
												Hi <?php if(!empty($userdata['userName'] )) { echo $userdata['userName']; } else { echo "User"; }?>
											</td>
										</tr>
										
										<tr>
											<td class="content-block" style="padding: 6px 0;line-height: 22px;font-size:16px">
												We recieved a request to reset your password for your Shopta App
												info@shoptaapp.com. We are here to help!
												<p></p>
												Simply click on the button to set a new password :
											</td>
										</tr>
										
										<tr>
											<td class="content-block" style="padding: 6px 0;line-height: 22px;font-size:16px">
												<a href="<?php echo base_url('reset-password/').$userdata['password_token']; ?>" class="btn-primary" style="background-color: #4485f4;
												padding: 10px;width: 140px;display: table;text-align: center;color: #fff; text-decoration: none;">Reset Password</a>
											</td>
										</tr>
										
										<tr>
											<td class="content-block" style="padding: 6px 0;line-height: 22px;font-size:16px">
												if you didn't ask to change your password, don't worry! Your password
												is still safe and you can delete this email.
											</td>
										</tr>
										
										<tr>
											<td class="content-block" style="padding: 6px 0;line-height: 22px;font-size:16px">
												&mdash; The Shopta App
											</td>
										</tr>
										
									</table>
								</td>
							</tr>
						</table>
						<div class="footer">
							<table width="100%">
								<tr>
									<td class="aligncenter content-block" style="padding: 6px 0;line-height: 22px;font-size:16px">Powered by <a href="<?php echo base_url();?>">Shopta App</a></td>
								</tr>
							</table>
						</div></div>
				</td>
				<td></td>
			</tr>
		</table>
		
	</body>
</html>
