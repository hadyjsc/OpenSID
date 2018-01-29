<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

		$data['warganegara'] = $this->penduduk_model->list_warganegara();
		$data['agama'] = $this->penduduk_model->list_agama();
		$data['pekerjaan'] = $this->penduduk_model->list_pekerjaan('ucwords');
		$data['sex'] = $this->penduduk_model->list_sex();
		$data['tempat_dilahirkan'] = $this->referensi_model->list_kode_array(TEMPAT_DILAHIRKAN);
		$data['jenis_kelahiran'] = $this->referensi_model->list_kode_array(JENIS_KELAHIRAN);
		$data['penolong_kelahiran'] = $this->referensi_model->list_kode_array(PENOLONG_KELAHIRAN);
		$data['nomor'] = $this->input->post('nomor_main');
		$_SESSION['post'] = $_POST;

		if($this->input->post('saksi1')==2) unset($_SESSION['id_saksi1']);
		if($_POST['id_saksi1'] != '' AND $_POST['id_saksi1'] !='*'){
			$data['saksi1']=$this->surat_model->get_penduduk($_POST['id_saksi1']);
			$_SESSION['id_saksi1'] = $_POST['id_saksi1'];
		}elseif ($_POST['id_saksi1'] !='*' AND isset($_SESSION['id_saksi1'])){
			$data['saksi1']=$this->surat_model->get_penduduk($_SESSION['id_saksi1']);
		}else{
			unset($data['saksi1']);
			unset($_SESSION['id_saksi1']);
		}

		if($this->input->post('saksi2')==2) unset($_SESSION['id_saksi2']);
		if($_POST['id_saksi2'] != '' AND $_POST['id_saksi2'] !='*'){
			$data['saksi2']=$this->surat_model->get_penduduk($_POST['id_saksi2']);
			$_SESSION['id_saksi2'] = $_POST['id_saksi2'];
		}elseif ($_POST['id_saksi2'] !='*' AND isset($_SESSION['id_saksi2'])){
			$data['saksi2']=$this->surat_model->get_penduduk($_SESSION['id_saksi2']);
		}else{
			unset($data['saksi2']);
			unset($_SESSION['id_saksi2']);
		}

		if($this->input->post('pelapor')==2) unset($_SESSION['id_pelapor']);
		if($_POST['id_pelapor'] != '' AND $_POST['id_pelapor'] !='*'){
			$data['pelapor']=$this->surat_model->get_penduduk($_POST['id_pelapor']);
			$_SESSION['id_pelapor'] = $_POST['id_pelapor'];
		}elseif ($_POST['id_pelapor'] !='*' AND isset($_SESSION['id_pelapor'])){
			$data['pelapor']=$this->surat_model->get_penduduk($_SESSION['id_pelapor']);
		}else{
			unset($data['pelapor']);
			unset($_SESSION['id_pelapor']);
		}

		if($this->input->post('bayi')==2) unset($_SESSION['id_bayi']);
		if($_POST['id_bayi'] != '' AND $_POST['id_bayi'] !='*'){
			$data['bayi']=$this->surat_model->get_penduduk($_POST['id_bayi']);
			$_SESSION['id_bayi'] = $_POST['id_bayi'];
		}elseif ($_POST['id_bayi'] !='*' AND isset($_SESSION['id_bayi'])){
			$data['bayi']=$this->surat_model->get_penduduk($_SESSION['id_bayi']);
		}else{
			unset($data['bayi']);
			unset($_SESSION['id_bayi']);
		}
		// Data kelahiran ditampilkan dan bisa diedit di form
		if (!empty($data['bayi'])){
			$_SESSION['post']['hari']	= hari(strtotime($bayi['tanggallahir']));
			$_SESSION['post']['tanggallahir'] = tgl_indo_dari_str($data['bayi']['tanggallahir']);
			$_SESSION['post']['waktu_lahir'] = $data['bayi']['waktu_lahir'];
			$_SESSION['post']['tempat_dilahirkan'] = $data['bayi']['tempat_dilahirkan'];
			$_SESSION['post']['alamat_tempat_lahir'] = $data['bayi']['alamat_tempat_lahir'];
			$_SESSION['post']['jenis_kelahiran'] = $data['bayi']['jenis_kelahiran'];
			$_SESSION['post']['kelahiran_anak_ke'] = $data['bayi']['kelahiran_anak_ke'];
			$_SESSION['post']['penolong_kelahiran'] = $data['bayi']['penolong_kelahiran'];
			$_SESSION['post']['berat_lahir'] = $data['bayi']['berat_lahir'];
			$_SESSION['post']['panjang_lahir'] = $data['bayi']['panjang_lahir'];
		}

		if($this->input->post('ibu')==2) unset($_SESSION['id_ibu']);
		if($_POST['id_ibu'] != '' AND $_POST['id_ibu'] !='*'){
			$data['ibu']=$this->surat_model->get_penduduk($_POST['id_ibu']);
			$data['ayah'] = $this->surat_model->get_data_suami($_POST['id_ibu']);
			if ($data['ayah']) $data['ayah']['warganegara'] = $data['ayah']['wn']; // Karena diambil dari get_data_pribadi
			$_SESSION['id_ibu'] = $_POST['id_ibu'];
		}elseif ($_POST['id_ibu'] !='*' AND isset($_SESSION['id_ibu'])){
			$data['ibu']=$this->surat_model->get_penduduk($_SESSION['id_ibu']);
		}else{
			unset($data['ibu']);
			unset($_SESSION['id_ibu']);
		}

?>