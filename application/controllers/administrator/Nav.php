<?php
class Nav extends CI_Controller {

		public function index()
		{
	        $text=$this->siteconfig->text();
		$data = array(
	               'text' => $text,
	               'title' => "Login | ".$text['title'],
	               'message' => 'Locked',
	               'color' => 'fffff'
	          );
		$this->load->view('admin/login/login.php',$data, false);

		}




								public function section()
								{

									if($this->session->userdata('type')=="1"){
									$data = array(
														 'title' => "Section list",
						          );

						$this->Admintheme->loadview("nav/section",$data);
								}else{
										redirect(site_url());
								}
								}


															public function menu()
															{

																if($this->session->userdata('type')=="1"){
																$data = array(
																					 'title' => "Menu list",
													          );

													$this->Admintheme->loadview("nav/menu",$data);
															}else{
																	redirect(site_url());
															}
															}


					public function editsection()
					{

						if($this->session->userdata('type')=="1"){
						$data = array(
											 'title' => "Edit Section",
					  );

				$this->Admintheme->loadview("nav/editsection",$data);
					}else{
							redirect(site_url());
					}
					}
					public function editsectioncheck()
					{

						if($this->session->userdata('type')=="1"){


							$this->load->model('systems/section');
							$check=$this->section->edit();
							if($check=="11"){
										redirect(site_url('administrator/nav/section'));

							}else{

										redirect(site_url('administrator/nav/section'));

						}


					}else{
							redirect(site_url());
					}
					}



					public function change()
					{
				if($this->session->userdata('type')=="1"){

									$value = ($_POST['toggle'] == "on" ? 1 : 2);

				if($this->session->userdata('type')=="1"){

				$data = array(
				   'value' => $value,
				);

				$this->db->where('id', 1);
				$this->db->update('site', $data);

					redirect(site_url('administrator/system/setting'));
						}
						}else{
								redirect(site_url());
						}

					}






						public function addsection()
					{
					if($this->session->userdata('type')=="1"){


							$this->load->model('systems/section');
							$check=$this->section->add();
							if($check=="11"){
										redirect(site_url('administrator/nav/section'));

							}else{

										redirect(site_url('administrator/nav/section'));

						}
						}else{
								redirect(site_url());
						}

					}
						public function addmenu()
					{
					if($this->session->userdata('type')=="1"){


							$this->load->model('systems/menu');
							$check=$this->menu->add();
							if($check=="11"){
										redirect(site_url('administrator/nav/menu?id='.$_GET['section']));

							}else{

											redirect(site_url('administrator/nav/menu?id='.$_GET['section']));

						}
						}else{
								redirect(site_url());
						}

					}



						public function editmenu()
						{

							if($this->session->userdata('type')=="1"){
							$data = array(
												 'title' => "Edit Menu",
						  );

					$this->Admintheme->loadview("nav/editmenu",$data);
						}else{
								redirect(site_url());
						}
						}



					public function editsubmenu()
					{

						if($this->session->userdata('type')=="1"){
						$data = array(
											 'title' => "Edit Sub Menu",
					  );

				$this->Admintheme->loadview("nav/editsubmenu",$data);
					}else{
							redirect(site_url());
					}
					}




							public function editmenucheck()
							{

								if($this->session->userdata('type')=="1"){


									$this->load->model('systems/menu');
									$check=$this->menu->edit();
									if($check=="11"){
												redirect(site_url('administrator/nav/menu?id='.$_GET['section']));

									}else{
													redirect(site_url('administrator/nav/menu?id='.$_GET['section']));
								}


							}else{
									redirect(site_url());
							}
							}
				public function editsubmenucheck()
				{

					if($this->session->userdata('type')=="1"){


						$this->load->model('systems/submenu');
						$check=$this->submenu->edit();
						if($check=="11"){
									redirect(site_url('administrator/nav/submenu?id='.$_GET['page']));

						}else{
										redirect(site_url('administrator/nav/submenu?id='.$_GET['page']));
					}


				}else{
						redirect(site_url());
				}
				}



										public function submenu()
										{

											if($this->session->userdata('type')=="1"){
											$data = array(
																 'title' => "submenu list",
								          );

								$this->Admintheme->loadview("nav/submenu",$data);
										}else{
												redirect(site_url());
										}
										}



										public function addsubmenu()
									{
									if($this->session->userdata('type')=="1"){


											$this->load->model('systems/submenu');
											$check=$this->submenu->add();
											if($check=="11"){
														redirect(site_url('administrator/nav/submenu?id='.$_GET['id']));

											}else{

															redirect(site_url('administrator/nav/submenu?id='.$_GET['id']));

										}
										}else{
												redirect(site_url());
										}

									}

										public function addsubmenubulk()
									{
									if($this->session->userdata('type')=="1"){


											$this->load->model('systems/submenu');
											$check=$this->submenu->addbulk();
											if($check=="11"){
														redirect(site_url('administrator/nav/submenu?id='.$_GET['id']));

											}else{

															redirect(site_url('administrator/nav/submenu?id='.$_GET['id']));

										}
										}else{
												redirect(site_url());
										}

									}


}
