<table bgcolor="#f5f5f5" align="center" class="full" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table bgcolor="#304050" align="center" width="750" class="margin-full" style="background-size: cover; background-position: center; border-radius: 6px 6px 0 0;" border="0" cellpadding="0" cellspacing="0" background="<?php echo base_url('resources/theme/images/email/banner-confirmation.jpg'); ?>">
				<tr>
					<td>
						<table width="600" align="center" class="margin-pad" border="0" cellpadding="0" cellspacing="0">
							<tr><td height="35" style="font-size:0px" >&nbsp;</td></tr>
							<!-- column x2 -->
							<tr >
								<td>
									<table class="full" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td valign="top">
												<!-- left column -->
												<table width="150" align="center" class="res-full" border="0" cellpadding="0" cellspacing="0">
													<!-- image -->
													<tr >
														<td>
															<table align="center" class="res-full" border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<td>
																		<table align="center" border="0" cellpadding="0" cellspacing="0">
																			<tr>
																				<td>
																				<img width="120" style="max-width: 120px; width: 100%; display: block; line-height: 0px; font-size: 0px; border: 0px;" src="<?php echo base_url('resources/theme/images/email/logo.jpg'); ?>">
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
													<!-- image end -->
												</table>
												<!-- left column end -->
												<!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
												<table width="1" align="left" class="res-full" border="0" cellpadding="0" cellspacing="0">
													<tr><td height="20" style="font-size:0px">&nbsp;</td></tr>
												</table>
												<!--[if (gte mso 9)|(IE)]></td><td valign="top"><![endif]-->
											
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- column x2 end -->
							<tr><td height="70" style="font-size:0px" >&nbsp;</td></tr>
							<tr><td height="10" style="font-size:0px" >&nbsp;</td></tr>
							<!-- title -->
							<tr >
								<td class="res-center" style="text-align: center; color: white; font-family: 'Raleway', Arial, Sans-serif; font-size: 30px;  word-break: break-word; font-weight: 900; padding-left: 16px;" >
									Booking Confirmed!
								</td>
							</tr>
							<!-- title end -->
							<tr><td height="10" style="font-size:0px" >&nbsp;</td></tr>
							<!-- subtitle -->
							<tr >
								<td class="res-center" style="text-align: center; color: white; font-family: 'Raleway', Arial, Sans-serif; font-size: 16px;  word-break: break-word; font-weight: 600;" >
									Hi <?php echo $data['name']; ?>, Your booking for <?php echo $data['turf']; ?> Turf has been confirmed.

								</td>
							</tr>
							<!-- subtitle end -->
							<tr><td height="35" style="font-size:0px" >&nbsp;</td></tr>
							<!-- nested column -->
							<tr>
								<td>
									<table align="center" class="res-full" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>
												<table align="center" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td>
															<!--[if (gte mso 9)|(IE)]><table border="0" cellpadding="0" cellspacing="0"><tr><![endif]-->
															<!--[if !((gte mso 9)|(IE))]-->
															<!-- column -->
															<table align="left" border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<!--[endif]-->
																	<!-- button -->
																	<td >
																		<table align="center" class="res-full" border="0" cellpadding="0" cellspacing="0">
																			<tr>
																				<td>
																					<table align="center" bgcolor="white" style="border-radius: 28px;" border="0" cellpadding="0" cellspacing="0">
																						<tr>
																							<td height="43" style="padding: 0 25px; text-align: center;" >
																								<a href="<?php echo site_url('booking/view/'.$data['booking_key']); ?>" style="color: #304050; letter-spacing: 1.3px; font-size: 14px; font-family: 'Nunito', Arial, Sans-serif; text-decoration: none; text-align: center; line-height: 24px; word-break: break-word; font-weight: 700;" >
																									TAKE ME THERE
																								</a>
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	</td>
																	<!-- button end -->
																	<td width="14" style="font-size:0px">&nbsp;</td>
																	<!--[if !((gte mso 9)|(IE))]-->
																</tr>
															</table>
															<!-- column end -->
															<!-- column -->
															<table align="left" border="0" cellpadding="0" cellspacing="0">
																<tr>
																	<!--[endif]-->
																	<!-- button -->
																	<!-- <td >
																		<table align="center" class="res-full" border="0" cellpadding="0" cellspacing="0">
																			<tr>
																				<td>
																					<table align="center" bgcolor="#55b848" style="border-radius: 28px;" border="0" cellpadding="0" cellspacing="0">
																						<tr>
																							<td height="43" style="padding: 0 25px; text-align: center;" >
																								<a href="https://example.com" style="color: white; letter-spacing: 1.3px; font-size: 14px; font-family: 'Nunito', Arial, Sans-serif; text-decoration: none; text-align: center; line-height: 24px; word-break: break-word; font-weight: 700;" >
																									GET STARTED
																								</a>
																							</td>
																						</tr>
																					</table>
																				</td>
																			</tr>
																		</table>
																	</td> -->
																	<!-- button end -->
																	<td width="6" style="font-size:0px">&nbsp;</td>
																	<!--[if !((gte mso 9)|(IE))]-->
																</tr>
															</table>
															<!-- column end -->
															<!--[endif]-->
															<!--[if (gte mso 9)|(IE)]></tr></table><![endif]-->
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- nested column end -->
							<tr><td height="120" style="font-size: 0px;" >&nbsp;</td></tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table bgcolor="#f5f5f5" align="center" class="full" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<table bgcolor="white" width="750" align="center" class="margin-full" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="600" align="center" class="margin-pad" border="0" cellpadding="0" cellspacing="0">
							<tr><td height="40" style="font-size:0px" >&nbsp;</td></tr>
							<!-- title -->
							<tr >
								<td class="res-center" style="text-align: center; color: #707070; font-family: 'Raleway', Arial, Sans-serif; font-size: 20px; letter-spacing: 1px; word-break: break-word;" >
									YOUR BOOKING DETAILS
								</td>
							</tr>
							<!-- title end -->
							<tr><td height="13" style="font-size:0px" >&nbsp;</td></tr>
							<!-- dash -->
							<tr >
								<td>
									<table align="center" class="res-full" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>
												<table bgcolor="#000" align="center" style="border-radius: 10px;" border="0" cellpadding="0" cellspacing="0">
													<tr>
														<td width="55" height="3" style="font-size:0px" >&nbsp;</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- dash end -->
							<tr><td height="20" style="font-size:0px" >&nbsp;</td></tr>
						
							<tr><td height="20" style="font-size:0px" >&nbsp;</td></tr>
							<!-- column x2 -->
							<tr >
								<td>
									<table class="full" align="center" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td valign="top">
												<!-- left column -->
												<table width="290" align="left" class="res-full" border="0" cellpadding="0" cellspacing="0">
													<!-- subtitle -->
													<tr >
														<td class="res-center" style=" height: 50px; text-align: center; color: #333; font-family: 'Raleway', Arial, Sans-serif; font-size: 15px; letter-spacing: 0.7px; word-break: break-word; padding-top: 6px; background: #f5f5f5; border-radius: 3px; font-weight: 600;" >
															Time Slot(s)
														</td>
													</tr>
													
													<tr>
														<td class="res-center" style=" height: 50px; background: #f5f5f5; border-radius: 3px; font-weight: 600; text-align: center; color: #53b64b; font-family: 'Nunito', Arial, Sans-serif; padding-bottom: 16px; font-size: 24px; letter-spacing: 0.4px; line-height: 23px; word-break: break-word;">
															<?php echo $data['time_slot']; ?>
														</td>
													</tr>
													<!-- subtitle end -->
													<tr><td height="14" style="font-size:0px" >&nbsp;</td></tr>
													
													<tr><td height="8" style="font-size:0px" >&nbsp;</td></tr>
												
												</table>
												<!-- left column end -->
												
												<!--[if (gte mso 9)|(IE)]></td><td><![endif]-->
												<table width="20" align="left" class="res-full" border="0" cellpadding="0" cellspacing="0">
													<tr><td height="20" style="font-size:0px">&nbsp;</td></tr>
												</table>
												<table width="290" align="left" class="res-full" border="0" cellpadding="0" cellspacing="0">
													<!-- subtitle -->
													<tr >
														<td class="res-center" style=" height: 50px; text-align: center; color: #333; font-family: 'Raleway', Arial, Sans-serif; font-size: 15px; letter-spacing: 0.7px; word-break: break-word; padding-top: 6px; background: #f5f5f5; border-radius: 3px; font-weight: 600;" >
															Total Price
														</td>
													</tr>
													
													<tr>
														<td class="res-center" style=" height: 50px; background: #f5f5f5; border-radius: 3px; font-weight: 600; text-align: center; color: #53b64b; font-family: 'Nunito', Arial, Sans-serif; padding-bottom: 16px; font-size: 24px; letter-spacing: 0.4px; line-height: 23px; word-break: break-word;">
															<?php echo CURRENCY_SYMBOL; ?> <?php echo $data['amount']; ?>/-
														</td>
													</tr>
													<!-- subtitle end -->
													<tr><td height="14" style="font-size:0px" >&nbsp;</td></tr>
													
													<tr><td height="8" style="font-size:0px" >&nbsp;</td></tr>
												
												</table>
												<!-- right column end -->
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- column x2 end -->
							<tr><td height="35" style="font-size:0px" >&nbsp;</td></tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>