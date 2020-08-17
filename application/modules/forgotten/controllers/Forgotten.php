<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotten extends AppController {
    
	public function __construct()
	{
        parent::__construct();
        $this->load->model('User_model', 'model_user');
		$this->load->model('UserActivity_model', 'model_user_activity');
		$this->lang->load('app/forgotten_lang');
    }
    public function index() {

		if ($this->user->isLogged()) {
			$this->redirect($this->url(''));
		}

		if($this->isAjaxRequest() && $this->isPost()) {
			
			$this->request = $this->xss_clean($this->input->post());

			if (!$this->request['email']) {
				$this->json['error']['warning'] = $this->lang->line('error_email');
			} elseif (!$this->model_user->getTotalUsersByEmail($this->request['email'])) {
				$this->json['error']['warning'] = $this->lang->line('error_email');
			}

			if (!$this->json) {
				$code = token(40);

				$this->model_user->editCode($this->request['email'], $code);

				if (isset($this->request['email'])) {

					$this->json['success']      = $this->lang->line('text_success');
					$subject                    = sprintf("Forogot password", html_entity_decode($this->lang->line('lang_name'), ENT_QUOTES, 'UTF-8'));
					$change_my_password_link    = url('reset?code='. $code) . "\n\n";
					$ip_address                 = sprintf($this->lang->line('text_ip'), $this->input->server('REMOTE_ADDR')) . "\n\n";
	
				
					$body  = '<html dir="ltr" lang="en">' . "\n";
					$body .= '  <head>' . "\n";
					$body .= '    <title>' . $subject . '</title>' . "\n";
					$body .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
					$body .= '  </head>' . "\n";
					$body .= '  <body style="margin:0; background-color: rgb(247, 242, 242);"><table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" class="main-template" bgcolor="#f7f2f2" style="background-color: rgb(247, 242, 242);">
					<tbody>
					<tr style="display:none !important; font-size:1px; mso-hide: all;">
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="590" class="templateContainer" style="max-width:590px!important; width: 590px;">
							<tbody>
								<tr>
								<td height="20"></td>
							</tr>
							<tr>
								<td height="20" bgcolor="#1065cf"></td>
							</tr>
							<tr>
								<td align="center" valign="top"><div style="background-color: rgb(255, 255, 255);"> </div></td>
							</tr>
							<tr>
							<td align="center" valign="top"><div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
								<table class="rnb-del-min-width" width="100%" cellpadding="0" border="0" cellspacing="0" style="min-width:100%;" name="Layout_2" id="Layout_2">
									<tbody>
									<tr>
										<td class="rnb-del-min-width" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class=" rnb-container" bgcolor="#ffffff" style="max-width: 100%; min-width: 100%; table-layout: fixed; background-color: rgb(255, 255, 255); border-radius: 0px; border-collapse: separate; padding-left: 20px; padding-right: 20px;">
											<tbody>
											<tr>
												<td height="20" style="font-size:1px; line-height:0px; mso-hide: all;">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top" class="rnb-container-padding" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="rnb-columns-container">
													<tbody>
													<tr>
														<th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" width="550" valign="top"> <table border="0" valign="top" cellspacing="0" cellpadding="0" align="left" class="rnb-col-1" width="550">
															<tbody>
															<tr>
																<td height="13" class="col_td_gap" style="font-size:1px; line-height:0px; mso-hide: all;">&nbsp;</td>
															</tr>
															<tr>
																<td style="font-size:14px; font-family:"Georgia",serif, sans-serif; color:#3c4858; line-height: 21px;"><div>
																	<h3 style="text-align: center; font-size: 21px; margin: 5px 0;">Hello</h3>
																	<a href="#" style=" font-size:18px; text-align:center; display:block; text-decoration:none; color:#1065cf;"> ' . html_entity_decode($this->request['email'], ENT_QUOTES, 'UTF-8') . '</a>
																	<p style="font-size:13px; line-height:18px; color:#888888; font-weight:300; text-align:center; font-family:Arial,Helvetica,sans-serif;">Someone has requested a link to change your password.("' . html_entity_decode($ip_address, ENT_QUOTES, 'UTF-8') . '")<br> You can do this throughthe button below.</p>
																	
																</div></td>
															</tr>
															<tr>
																<td height="13" class="col_td_gap" style="font-size:1px; line-height:0px; mso-hide: all;">&nbsp;</td>
															</tr>
															<tr>
																<td valign="top"><table cellpadding="0" border="0" align="center" cellspacing="0" class="rnb-btn-col-content" style="border-collapse: separate;margin:0 auto;">
																	<tbody>
																	<tr>
																		<td width="auto" valign="middle" bgcolor="#0861a6" align="center" height="42" style="font-size:15px; font-family:"Lucida Sans Unicode",Lucida Grande,sans-serif; text-align:center; color:#ffffff; font-weight:normal; padding-left:30px; padding-right:30px; background-color:#1065cf; border-radius:30px;border:none;"><span style="color:#ffffff; font-weight:normal;"> <a style="text-decoration:none; color:#ffffff; font-weight:normal;" href="'.html_entity_decode($change_my_password_link, ENT_QUOTES, 'UTF-8').'">Change my password</a> </span></td>
																	</tr>
																	</tbody>
																</table></td>
															</tr>
															</tbody>
														</table>
														</th>
													</tr>
													</tbody>
												</table></td>
											</tr>
											<tr>
												<td height="27" style="font-size:1px; line-height:0px; mso-hide: all;">&nbsp;</td>
											</tr>
											</tbody>
										</table></td>
									</tr>
									</tbody>
								</table>
								</div></td>
							</tr><tr>
							<td align="center" valign="top"><div style="background-color: rgb(255, 255, 255);">
								<table class="rnb-del-min-width rnb-tmpl-width" width="100%" cellpadding="0" border="0" cellspacing="0" style="min-width:590px;" name="Layout_3" id="Layout_3">
								<tbody>
									<tr>
									<td class="rnb-del-min-width" align="center" valign="top" bgcolor="#ffffff" style="min-width:590px; background-color: #ffffff; text-align: center;"><table width="590" class="rnb-container" cellpadding="0" border="0" align="center" cellspacing="0" bgcolor="#ffffff" style="padding-right: 20px; padding-left: 20px; background-color: rgb(255, 255, 255);">
										<tbody>
											<tr>
											<td height="10" style="font-size:1px; line-height:0px; mso-hide: all;">&nbsp;</td>
											</tr>
											<tr>
											<td><div style="font-size:13px; line-height:18px; color:#888888; font-weight:300; text-align:center; font-family:Arial,Helvetica,sans-serif;">
												<div>If you didn&quot;t request this, please ignore this email.
													<div>Your password will stay safe and won&quot;t be changed.</div>
												</div>
												</div></td>
											</tr>
											<tr>
											<td height="20" style="font-size:1px; line-height:0px; mso-hide: all;">&nbsp;</td>
											</tr>
										</tbody>
										</table></td>
									</tr>
								</tbody>
								</table>
							</div></td>
						</tr>
						<tr>
							<td align="center" valign="top"><div style="background: #fff;">
								<table class="rnb-del-min-width rnb-tmpl-width" width="100%" cellpadding="0" border="0" cellspacing="0" style="min-width:590px;" name="Layout_4" id="Layout_4">
								<tbody>
									<tr>
									<td class="rnb-del-min-width" align="center" valign="top" style="min-width:590px;"><table width="100%" cellpadding="0" border="0" align="center" cellspacing="0" bgcolor="#f1f1f1" style="padding-right: 20px; padding-left: 20px; background-color: #fff;">
										<tbody>
										<tr>
											<td  style="border-top:1px solid #ddd; margin-top:30px; width:100%;">&nbsp;</td>
											</tr>
											<tr>
											<td height="20" style="font-size:1px; line-height:0px; mso-hide: all;">&nbsp;</td>
											</tr>
											<tr>
											<td style="font-size:14px; color:#888888; font-weight:normal; text-align:center; font-family:Arial,Helvetica,sans-serif;"><div>
												<div style=" font-size:13px; line-height:21px; color:#888888; font-weight:300; margin-bottom:20px; text-align:center; font-family:Arial,Helvetica,sans-serif;">Email: info@globalgala.co.uk<br>UK: +44 771 828 666 | Egypt: +201022221915 </div>
												<div style="width:100%; text-align:center;">
													<ul style="list-style:none; margin:0; padding:0;">
														<li style="display:inline-block; margin-right:-5px;"><a href="#" target="_blank"><img src="https://cdn4.iconfinder.com/data/icons/social-icon-4/842/facebook-512.png" width="50"/></a></li>
														<li style="display:inline-block;"><a href="#" target="_blank"><img src="https://1stamendmentpartnership.org/wp-content/uploads/Twitter-logo.png" width="35"/></a></li>
														<li style="display:inline-block;"><a href="#" target="_blank"><img src="https://images.vexels.com/media/users/3/137380/isolated/preview/1b2ca367caa7eff8b45c09ec09b44c16-instagram-icon-logo-by-vexels.png" width="38"/></a></li>
													</ul>
												</div>
												</div></td>
											</tr>
											
											<tr>
											<td height="20" style="font-size:1px; line-height:0px; mso-hide: all;">&nbsp;</td>
											</tr>
										</tbody>
										</table></td>
										
									</tr>
								</tbody>
								</table>
								<table class="rnb-del-min-width rnb-tmpl-width" width="100%" cellpadding="0" border="0" cellspacing="0" style="min-width:590px;" name="Layout_4" id="Layout_4">
								<tbody>
									<tr>
									<td class="rnb-del-min-width" align="center" valign="top" style="min-width:590px;"><table width="100%" cellpadding="0" border="0" align="center" cellspacing="0" bgcolor="#ffffff" style="padding-right: 0px; padding-left: 0px; background-color: rgb(255, 255, 255);">
										<tbody>
											
											
											<tr>
											<td style="font-size:14px; color:#888888; font-weight:normal; text-align:center; font-family:Arial,Helvetica,sans-serif;"><div>
												<div style="font-size:13px; line-height:30px; color:#888888; background:#; margin-bottom:30px; font-weight:300; text-align:center; font-family:Arial,Helvetica,sans-serif;">© 2020 Ticketatguru.com</div>
												
												</div></td>
											</tr>
											
										</tbody>
										</table></td>
										
									</tr>
								</tbody>
								</table>
							</div></td>
						</tr>
						</tbody>
					</table></td>
				</tr>
				</tbody>
				</table></body>' . "\n";
					
					$body .= '</html>' . "\n";
					$mail                       = new Mail();
					$mail->protocol 		    = "mail";
					//$mail->parameter 		    = "";
					$mail->smtp_hostname 	    = "smtp.mailtrap.io";
					$mail->smtp_username 	    = "0fc4fb1ca6ca26";
					$mail->smtp_password 	    = "425dd2da83709c";
					$mail->smtp_port 		    = "2525";
					//$mail->smtp_timeout 	    = "";


					$mail->setTo($this->request['email']);
					$mail->setFrom("rakesh@gmail.com");
					$mail->setSender(html_entity_decode("Rakesh Maity"
					, ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setText(html_entity_decode($body, ENT_QUOTES, 'UTF-8'));
					$mail->send();

					$this->session->userdata('success',$this->lang->line('text_success'));

					// Add to activity log
					/*
					if ($this->lang->line('lang_customer_activity')) {
						$customer_info = $this->model_user->getCustomerByEmail($this->request('email'));
	
						if ($customer_info) {
	
							$activity_data = array(
								'id_customers' => $customer_info['id_customers'],
								'name'        => $customer_info['firstname'] . ' ' . $customer_info['lastname']
							);
	
							$this->customer_account_activity->addActivity('forgotten', $activity_data);
						}
					}
					*/
					$this->json['redirect'] = url('login');
				} else {
					$this->json['error']['warning'] = $this->lang->line('error_email');
				}
				
			}
			return $this->output
						->set_content_type('application/json')
						->set_status_header(200)
						->set_output(json_encode($this->json));
		}
		

		$this->template->javascript->add('assets/js/jquery.validate.js'); 
		$this->template->javascript->add('assets/js/additional-methods.js');

		// $this->template->stylesheet->add('assets/js/snackbar.min.css'); 
		// $this->template->javascript->add('assets/js/snackbar.min.js');
		
		$this->template->javascript->add('assets/js/forgotten/forgotten.js');
		
		$this->template->set_template('layout/app');
		$this->template->content->view('forgotten/index');
		$this->template->publish();
	
	}

}