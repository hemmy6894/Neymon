<?php
	////SEHEMU A
	$data['mkopaji_firstname']  = "Hemedi";
	$data['mkopaji_middlename']  = "Mshamu";
	$data['mkopaji_lastname']  = "Manyinja";
	$data['mkopaji_fullname']  = $data['mkopaji_firstname'] . " "  . $data['mkopaji_middlename'] . " " . $data['mkopaji_lastname'];
	$data['mkopaji_gender']  = "Male";
	$data['mkopaji_wadhifa']  = "IT Manager";
	$data['mkopaji_phone_1']  = "0685639653";
	$data['mkopaji_phone_2']  = "0685639654";
	$data['mkopaji_marital']  = "Hajaoa";
	
	$data['anwani_slp']  = "P.O.Box 1775";
	$data['anwani_mji']  = "Dar es salaam";
	$data['anwani_wilaya']  = "Ilala";
	$data['anwani_nyumba']  = "DSM/ILL/356";
	$data['anwani_kata']  = "Jamuhuri";
	$data['anwani_mtaa']  = "City Center";
	
	$data['wadhamini_list'] = array(
									(object)array(
											'biashara' => "manager",
											'jina' => "Hemedi Manyinja",
											'uhusiano' => "Rafiki",
											'simu' => "0685639653",
										),
									(object)array(
											'biashara' => "IT manager",
											'jina' => "Yona Ndabila",
											'uhusiano' => "Kaka",
											'simu' => "0685638953",
										),
									(object)array(
											'biashara' => "Sales",
											'jina' => "Joseph Kusekwa",
											'uhusiano' => "Kijana",
											'simu' => "0689638953",
										)
									);
									
	$data['ajira_kampuni']  = "Neymon Investment Limited";
	$data['ajira_slp']  = "P.O.Box 1775";
	$data['ajira_mji']  = "Dar es salaam";
	$data['ajira_wilaya']  = "ILALA";
	$data['ajira_nyumba']  = "DSM/ILL/356";
	$data['ajira_kata']  = "Jamuhuri";
	$data['ajira_mtaa']  = "City Center";
	$data['ajira_simu']  = "+255(0)222920679";
	$data['ajira_email']  = "info@neymonict.com";
	$data['ajira_kitambulisho']  = "Taifa";
	$data['ajira_kitambulisho_no']  = "1221-23232-2312-212212";
	$data['ajira_kitambulisho_mtoaji']  = "NIDA";
	$data['ajira_kitambulisho_ilipotolewa']  = "Dar es salaam";
	$data['ajira_kitambulisho_date']  = "09/12/2018";
	$data['ajira_kitambulisho_date_end']  = "09/12/2020";
	$data['ajira_salary']  = "10,000,000";
	
	$data['ukubali_kiasi']  = "200,000";
	$data['ukubali_account']  = "Tigo pesa";
	$data['ukubali_kiasi_maneno']  = "Laki mbili";
	$data['ukubali_riba']  = "20";
	$data['ukubali_muda']  = " miezi 3 ";
	$data['ukubali_kuanzia']  = "01/10/2018";
	$data['ukubali_mpaka']  = "01/01/2019";
	$data['ukubali_dhamana']  = array((object)array('name' => "kiwanja"),(object)array('name' => "gari"));
	?>
	
	<div id="print_report">
		<?php
			$data['section'] = 'A';
			$this->load->view('member/section/taarifa_za_mkopaji',$data);
			$this->load->view('member/section/anwani_ya_makazi',$data);
			$this->load->view('member/section/wadhamini_list',$data);
			/*yona view*/
			$this->load->view('member/section/Taarifa_za_Ajira',$data);
			$data['section'] = 'B';
			$this->load->view('member/section/udhamini',$data);

			$data['section'] = 'C';
			$this->load->view('member/section/ukubali',$data);
			$data['section'] = 'D';
			$this->load->view('member/section/mkataba',$data);
			$data['section'] = 'E';
			$this->load->view('member/section/matumizi_ya_ofisi',$data);
		?>
	</div>
	<div class="row">
		<div class="col-md-12 text-right">
			<button onclick="printJS('http://localhost/mkomevu/index.php/en/member/view_all_download','pdf')" class="btn btn-success">Print</button>
		</div>
	</div>

