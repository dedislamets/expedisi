<style type="text/css">
	.table>thead>tr {
			color: #f6ebeb;
			background: repeat-x #8a3333;
			background-image: -webkit-linear-gradient(top,#F8F8F8 0,#ECECEC 100%);
			background-image: -o-linear-gradient(top,#F8F8F8 0,#ECECEC 100%);
			background-image: linear-gradient(to bottom,#8f8d8d 0,#332828 100%);
		 
	}
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Home</a>
		</li>
		<li class="active">Profile</li>
	</ul><!-- /.breadcrumb -->
	<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
	<div class="nav-search" id="nav-search">

	</div><!-- /.nav-search -->
</div>

<div class="page-content">
		<div class="page-header">
			<h1 id="judul">
				<?php echo $title ?>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<div>
					<div>
						<div class="row">
							<div class="col-xs-12 col-sm-3 center">
								<span class="profile-picture">
									<?php
						              $image_profile= base_url(). "assets/profile/". $this->session->userdata('user_nik') .".jpg";
						              // if(!is_file($image_profile)){
						              //     $image_profile= "http://hrsmartpro.com/assets/profile/no-profile-copy.png";
						              // }
						            ?>
									<img class="editable img-responsive" src="<?= $image_profile ?>" />
								</span>

								<div class="space space-4"></div>

								<a href="javascript:void(0)" id="btnPassword" class="btn btn-sm btn-block btn-success">
									<i class="ace-icon fa fa-key bigger-120"></i>
									<span class="bigger-110">Change Password</span>
								</a>

								<!-- <a href="#" class="btn btn-sm btn-block btn-primary">
									<i class="ace-icon fa fa-envelope-o bigger-110"></i>
									<span class="bigger-110">Send a message</span>
								</a> -->
							</div><!-- /.col -->

							<div class="col-xs-12 col-sm-9">
								<h4 class="blue">
									<span class="middle"><?php echo $this->session->userdata('user_name'); ?></span>
								</h4>

								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name"> Name </div>

										<div class="profile-info-value">
											<span class="editable" id="empname">-</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Emp Id </div>

										<div class="profile-info-value">
											<span class="editable" id="empid">-</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Position </div>

										<div class="profile-info-value">
											<span class="editable" id="position"><?php echo $this->session->userdata('posisi'); ?></span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Address </div>

										<div class="profile-info-value">
											<p id="address">-</p>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name">Personal Email </div>

										<div class="profile-info-value">
											<span class="editable" id="personal_mail">-</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name">Office Email </div>

										<div class="profile-info-value">
											<span class="editable" id="office_mail">-</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name">Handphone </div>

										<div class="profile-info-value">
											<span class="editable" id="hp">-</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Joined </div>

										<div class="profile-info-value">
											<span class="editable" id="join">-</span>
										</div>
									</div>

									
								</div>
							</div><!-- /.col -->
						</div>
						<div class="space-20"></div>
						<div id="user-profile-2" class="user-profile">
						<!-- <div class="tabbable">
							<ul class="nav nav-tabs padding-18">
								<li class="active">
									<a data-toggle="tab" href="#home">
										<i class="green ace-icon fa fa-user bigger-120"></i>
										Personal info
									</a>
								</li>
								<li>
									<a data-toggle="tab" href="#feed">
										<i class="orange ace-icon fa fa-rss bigger-120"></i>
										Employee Data
									</a>
								</li><li>
									<a data-toggle="tab" href="#feed">
										<i class="orange ace-icon fa fa-rss bigger-120"></i>
										Additional Info
									</a>
								</li>
								<li>
									<a data-toggle="tab" href="#feed">
										<i class="orange ace-icon fa fa-rss bigger-120"></i>
										Activity Feed
									</a>
								</li>

							</ul>

							<div class="tab-content no-border padding-24">
								<div id="home" class="tab-pane in active">
	
									<div class="row">
										
									</div>
								</div>

								<div id="feed" class="tab-pane">
									<div class="profile-feed row">
										<div class="col-sm-6">
											<div class="profile-activity clearfix">
												<div>
													<img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png" />
													<a class="user" href="#"> Alex Doe </a>
													changed his profile photo.
													<a href="#">Take a look</a>

													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														an hour ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<img class="pull-left" alt="Susan Smith's avatar" src="assets/images/avatars/avatar1.png" />
													<a class="user" href="#"> Susan Smith </a>

													is now friends with Alex Doe.
													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														2 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-check btn-success no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>
													joined
													<a href="#">Country Music</a>

													group.
													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														5 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-picture-o btn-info no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>
													uploaded a new photo.
													<a href="#">Take a look</a>

													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														5 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<img class="pull-left" alt="David Palms's avatar" src="assets/images/avatars/avatar4.png" />
													<a class="user" href="#"> David Palms </a>

													left a comment on Alex's wall.
													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														8 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>
										</div>

										<div class="col-sm-6">
											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-pencil-square-o btn-pink no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>
													published a new blog post.
													<a href="#">Read now</a>

													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														11 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png" />
													<a class="user" href="#"> Alex Doe </a>

													upgraded his skills.
													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														12 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>

													logged in.
													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														12 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-power-off btn-inverse no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>

													logged out.
													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														16 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>

													logged in.
													<div class="time">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														16 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="ace-icon fa fa-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="ace-icon fa fa-times bigger-125"></i>
													</a>
												</div>
											</div>
										</div>
									</div>

									<div class="space-12"></div>

									<div class="center">
										<button type="button" class="btn btn-sm btn-primary btn-white btn-round">
											<i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
											<span class="bigger-110">View more activities</span>

											<i class="icon-on-right ace-icon fa fa-arrow-right"></i>
										</button>
									</div>
								</div>

								<div id="friends" class="tab-pane">
									<div class="profile-users clearfix">
										<div class="itemdiv memberdiv">
											<div class="inline pos-rel">
												<div class="user">
													<a href="#">
														<img src="assets/images/avatars/avatar4.png" alt="Bob Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-online"></span>
															Bob Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Content Editor</div>

														<div class="time">
															<i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
															<span class="green"> 20 mins ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline pos-rel">
												<div class="user">
													<a href="#">
														<img src="assets/images/avatars/avatar1.png" alt="Rose Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-offline"></span>
															Rose Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Graphic Designer</div>

														<div class="time">
															<i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
															<span class="grey"> 30 min ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline pos-rel">
												<div class="user">
													<a href="#">
														<img src="assets/images/avatars/avatar.png" alt="Jim Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-busy"></span>
															Jim Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">SEO &amp; Advertising</div>

														<div class="time">
															<i class="ace-icon fa fa-clock-o middle bigger-120 red"></i>
															<span class="grey"> 1 hour ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline pos-rel">
												<div class="user">
													<a href="#">
														<img src="assets/images/avatars/avatar5.png" alt="Alex Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-idle"></span>
															Alex Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Marketing</div>

														<div class="time">
															<i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
															<span class=""> 40 minutes idle </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline pos-rel">
												<div class="user">
													<a href="#">
														<img src="assets/images/avatars/avatar2.png" alt="Phil Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-online"></span>
															Phil Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Public Relations</div>

														<div class="time">
															<i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
															<span class="green"> 2 hours ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline pos-rel">
												<div class="user">
													<a href="#">
														<img src="assets/images/avatars/avatar3.png" alt="Susan Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-online"></span>
															Susan Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">HR Management</div>

														<div class="time">
															<i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
															<span class="green"> 20 mins ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline pos-rel">
												<div class="user">
													<a href="#">
														<img src="assets/images/avatars/avatar1.png" alt="Jennifer Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-offline"></span>
															Jennifer Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Graphic Designer</div>

														<div class="time">
															<i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
															<span class="grey"> 2 hours ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline pos-rel">
												<div class="user">
													<a href="#">
														<img src="assets/images/avatars/avatar3.png" alt="Alexa Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-offline"></span>
															Alexa Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Accounting</div>

														<div class="time">
															<i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
															<span class="grey"> 4 hours ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="hr hr10 hr-double"></div>

									<ul class="pager pull-right">
										<li class="previous disabled">
											<a href="#">&larr; Prev</a>
										</li>

										<li class="next">
											<a href="#">Next &rarr;</a>
										</li>
									</ul>
								</div>

								<div id="pictures" class="tab-pane">
									<ul class="ace-thumbnails">
										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="assets/images/gallery/thumb-1.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="assets/images/gallery/thumb-2.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="assets/images/gallery/thumb-3.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="assets/images/gallery/thumb-4.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="assets/images/gallery/thumb-5.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="assets/images/gallery/thumb-6.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="assets/images/gallery/thumb-1.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="assets/images/gallery/thumb-2.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div> -->
					</div>
					</div>
				</div>

			</div>
		</div>
</div>
<?php
	$this->load->view($modal); 
?>



