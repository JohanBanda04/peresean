<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harmonisasi extends CI_Controller {

	public function index()
	{
		redirect("berita/v");
	}

	public function v($aksi='', $pemda='' , $id='' )
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

		if($aksi!='t'){
            $this->session->set_flashdata('msg','');

        }

		if(!isset($ceks)) {
			redirect('web/login');
		}

			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level=='pelaksana') {
				$this->db->where('id_user',$id_user);
			}
			if ($aksi=='proses' or $aksi=='konfirmasi' or $aksi=='selesai') {
				$this->db->where('status',$aksi);
			}
			$this->db->order_by('id_berita', 'DESC');
			$data['query'] = $this->db->get("tbl_berita");
			

			$cek_notif = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user"));
			foreach ($cek_notif->result() as $key => $value) {
				$b_notif = $value->baca_notif;
				if(!preg_match("/$id_user/i", $b_notif)) {
					$data_notif = array('baca_notif'=>"$id_user, $b_notif");
					$this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user));
				}
			}


			if ($aksi == 't') {
//			    echo "tes"; die;
//				if ($level!='pelaksana') {
//					redirect('404');
//				}
				$p = "tambah";
				$data['judul_web'] 	  = "TAMBAH DOKUMEN HARMONISASI";
			} else if ($aksi=='pemprov_ntb'){
//			    echo "pemprov_ntb"; die;
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemprov_ntb"));
                /*tabel ny di select belakangan*/
                $p = "pemprov_ntb";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMPROV NTB";

            } else if($aksi=='pemkot_mataram'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkot_mataram"));
                $p = "pemkot_mataram";
                $data['judul_web'] 	= "DOKUMEN HARMONISASI PEMKOT MATARAM";
            } else if($aksi=='pemkot_bima'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkot_bima"));
                $p = "pemkot_bima";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKOT BIMA";
            } else if($aksi=='pemkab_sumbawa_barat'){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_sumbawa_barat"));
                $p = "pemkab_sumbawa_barat";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA BARAT";
            } else if($aksi=="pemkab_sumbawa"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_sumbawa"));
                $p = "pemkab_sumbawa";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB SUMBAWA ";
            } else if($aksi=="pemkab_lombok_utara"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_utara"));
                $p = "pemkab_lombok_utara";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK UTARA ";
            } else if($aksi=="pemkab_lombok_timur"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_timur"));
                $p = "pemkab_lombok_timur";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TIMUR ";
            } else if($aksi=="pemkab_lombok_tengah"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_tengah"));
                $p = "pemkab_lombok_tengah";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK TENGAH ";
            } else if($aksi=="pemkab_lombok_barat"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_lombok_barat"));
                $p = "pemkab_lombok_barat";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB LOMBOK BARAT ";
            } else if($aksi=="pemkab_dompu"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_dompu"));
                $p = "pemkab_dompu";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB DOMPU ";
            } else if($aksi=="pemkab_bima"){
                $this->db->order_by('id_berita', 'DESC');
                $data['query'] = $this->db->get_where("tbl_berita",array("zona_dokumen"=>"pemkab_bima"));
                $p = "pemkab_bima";
                $data['judul_web'] 	  = "DOKUMEN HARMONISASI PEMKAB BIMA ";
            } elseif ($aksi == 'd') {
				$p = "detail";
				$data['judul_web'] 	  = "RINCIAN BAHAN BERITA";
				$data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => "$id"))->row();
				if ($data['query']->id_berita=='') {redirect('404');}

				$data['cek_notif'] = $this->db->get_where("tbl_notif", array('penerima'=>"$id_user", 'id_berita'=>"$id"))->row();

				$b_notif = $data['cek_notif']->baca_notif;
				if(!preg_match("/$id_user/i", $b_notif)) {
					$data_notif = array('baca_notif'=>"$id_user, $b_notif");
					$this->db->update('tbl_notif', $data_notif, array('penerima'=>$id_user, 'id_berita'=>"$id"));
				}
			}
			elseif ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "EDIT BAHAN BERITA";
				$data['query'] = $this->db->get_where("tbl_berita", array('id_berita' => "$id"))->row();
				if ($data['query']->id_berita=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {

			    if($pemda=="pemprov_ntb"){
			        echo $pemda; die;
                }
				$cek_data = $this->db->get_where("tbl_berita", array('id_berita' => "$id"));
				if ($cek_data->num_rows() != 0) {
//					if ($cek_data->row()->status!='menunggu') {
//							redirect('404');
//						}
//						if ($cek_data->row()->lampiran != '') {
//							unlink($cek_data->row()->lampiran);
//						}
						// $this->db->delete('tbl_notif', array('pengirim'=>$id_user,'id_berita'=>$id));
						$this->db->delete('tbl_berita', array('id_berita' => $id));
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses1!</strong> Berhasil dihapus.
							</div>
							<br>'
						);


						if($pemda=='pemprov_ntb'){
                            redirect("harmonisasi/v/pemprov_ntb");
                        }

						redirect("berita/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Bahan Berita";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/harmonisasi/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Singapore');
				$tgl = date('Y-m-d H:i:s');

				$lokasi = 'file/bahan_berita';
				$this->upload->initialize(array(
					"upload_path"   => "./$lokasi",
					"allowed_types" => "*"
				));

				if (isset($_POST['btnsimpan'])) {
					
					
					$nama_kegiatan 	 = htmlentities(strip_tags($this->input->post('nama_kegiatan')));
					$jenis_dokumen 	 = htmlentities(strip_tags($this->input->post('jenis_dokumen')));
					$zona_dokumen 	 = htmlentities(strip_tags($this->input->post('zona_dokumen')));

					$simpan = '';



                    if ( ! $this->upload->do_upload('lamp_surat_undangan'))
                    {
                        $simpan = 'n';
                        $pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                    }
                    else
                    {
                        $gbr = $this->upload->data();
                        $filename = "$lokasi/".$gbr['file_name'];
                        $lamp_surat_undangan = preg_replace('/ /', '_', $filename);
                        $simpan = 'y';
                    }
					if ($simpan=='y') {
//					    echo "tes"; die;
						$data = array(
							'lamp_surat_undangan'	=> $lamp_surat_undangan,

							'id_user'				=> $id_user,
							'nama_kegiatan'   		=> $nama_kegiatan,
							'jenis_dokumen'   		=> $jenis_dokumen,
							'zona_dokumen'   		=> $zona_dokumen,

						);
						$this->db->insert('tbl_berita',$data);

						$id_berita = $this->db->insert_id();
						$this->Mcrud->kirim_notif($id_user,'humas',$id_berita,'berita','pelaksana_kirim_berita');

						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil disimpan.
							</div>
							<br>'
						   );
						}else {
						
							 $this->session->set_flashdata('msg',
	 							'
	 							<div class="alert alert-warning alert-dismissible" role="alert">
	 								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 									 <span aria-hidden="true">&times;</span>
	 								 </button>
	 								 <strong>Gagal!</strong> '.$pesan.'.
	 							</div>
	 						 <br>'
	 						);

//							redirect("berita/v/$aksi/".hashids_decrypt($id));
//							redirect("harmonisasi/v/t");
					 }
//					 redirect("berita/v");
					 redirect("harmonisasi/v/t");

				}




	}


	public function ajax()
	{
		if (isset($_POST['btnkirim'])) {
			$id = $this->input->post('id');
			$data = $this->db->get_where('tbl_berita',array('id_berita'=>$id))->row();
			$pesan_humas = $data->pesan_humas;
			$status = $data->status;
			echo json_encode(array('pesan_petugas'=>$pesan_humas,'status'=>$status));
		} else {
			redirect('404');
		}
	}

}
