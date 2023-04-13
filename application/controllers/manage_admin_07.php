<?php
class Manage_admin_07 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_07');
    }

    //crud peran
    public function edit_user($id)
    {
        $data_perans['perans'] = $this->Admin_07->get_perans();

        $id_peran = 1;
        $querymenu = "SELECT * FROM `trx_menu` INNER JOIN `menu` ON `trx_menu`.`id_menu` = `menu`.`id_menu` WHERE `trx_menu`.`id_peran` = $id_peran";
        $menu['menus'] = $this->db->query($querymenu)->result_array();

        $row = $this->Admin_07->ambil_id_user($id);
        // var_dump($row);
        // die;

        if ($row) {
            $data = array(
                'id_user' => $row->id_user,
                'user' => $row->user,
                'password' => $row->password,
                'nama_pengguna' => $row->nama_pengguna,
                'is_aktif' => $row->is_aktif
            );
        }
        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar', $menu);
        $this->load->view('admin/Main/main_user_edit', $data, $data_perans);
        $this->load->view('admin/Nav/footer');
    }
    public function proses_edit_user()
    {
        $user = $this->input->post('user');
        $password = $this->input->post('password');
        $namaPengguna = $this->input->post('namaPengguna');
        $is_aktif = $this->input->post('is_aktif');
        $password2 = $this->session->userdata('password');

        if (($user != '') and ($namaPengguna != '') and ($is_aktif != '')) {
            if ($password == '') {
                $data = [
                    'user' => $user,
                    'password' => $password2,
                    'nama_pengguna' => $namaPengguna,
                    'is_aktif' => $is_aktif
                ];

                $this->Admin_18->edit_user($data);
                // var_dump($data);
                // die;
                redirect('zone_admin_07');
            } else {
                $data = [
                    'user' => $user,
                    'password' => $password,
                    'nama_pengguna' => $namaPengguna,
                    'is_aktif' => $is_aktif
                ];

                $this->Admin_18->edit_user($data);
                // var_dump($data);
                // die;
                redirect('zone_admin_07');
            }
        } else {
            redirect('zone_admin_07');
        }
    }
    public function hapus_user($id)
    {
        $this->Admin_18->ambil_id_user($id);
        $this->Admin_18->delete_user($id);

        redirect('zone_admin_07');
    }

    //crud peran
    public function peran_07()
    {
        //$session['a'] = $this->session->userdata();
        $id_peran = 1;
        $querymenu = "SELECT * FROM `trx_menu` INNER JOIN `menu` ON `trx_menu`.`id_menu` = `menu`.`id_menu` WHERE `trx_menu`.`id_peran` = $id_peran";
        $menu['menus'] = $this->db->query($querymenu)->result_array();

        $dataPeran = $this->Admin_07->ambil_data_peran();
        $arrayDataPeran = array(
            'datas' => $dataPeran
        );

        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar', $menu);
        $this->load->view('admin/Main/main_peran', $arrayDataPeran);
        $this->load->view('admin/Nav/footer');
    }
    public function edit_peran($id)
    {
        $id_peran = 1;
        $querymenu = "SELECT * FROM `trx_menu` INNER JOIN `menu` ON `trx_menu`.`id_menu` = `menu`.`id_menu` WHERE `trx_menu`.`id_peran` = $id_peran";
        $menu['menus'] = $this->db->query($querymenu)->result_array();

        $row = $this->Admin_07->ambil_data_id_peran($id);
        // var_dump($row);
        // die;

        if ($row) {
            $data = array(
                'id_peran' => $row->id_peran,
                'nama_peran' => $row->nama_peran,
                'url' => $row->url
            );
        }

        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar', $menu);
        $this->load->view('admin/Main/main_peran_edit', $data);
        $this->load->view('admin/Nav/footer');
    }
    public function proses_edit_peran()
    {
        $url = $this->input->post('url');

        if ($url != '') {

            $data = [
                'url' => $url,
            ];

            $this->Admin_18->edit_peran($data);
            // var_dump($data);
            // die;
            redirect('zone_admin_07');
        } else {
            redirect('zone_admin_07');
        }
    }

    //crud menu
    public function menu_07()
    {
        //$session['a'] = $this->session->userdata();
        $id_peran = 1;
        $querymenu = "SELECT * FROM `trx_menu` INNER JOIN `menu` ON `trx_menu`.`id_menu` = `menu`.`id_menu` WHERE `trx_menu`.`id_peran` = $id_peran";
        $menu['menus'] = $this->db->query($querymenu)->result_array();

        $dataMenu = $this->Admin_07->ambil_semua_menu();
        $arrayDataMenu = array(
            'datas' => $dataMenu
        );

        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar', $menu);
        $this->load->view('admin/Main/main_menu', $arrayDataMenu);
        $this->load->view('admin/Nav/footer');
    }
    public function edit_menu($id)
    {
        $id_peran = 1;
        $querymenu = "SELECT * FROM `trx_menu` INNER JOIN `menu` ON `trx_menu`.`id_menu` = `menu`.`id_menu` WHERE `trx_menu`.`id_peran` = $id_peran";
        $menu['menus'] = $this->db->query($querymenu)->result_array();

        $row = $this->Admin_07->ambil_data_id_menu($id);
        // var_dump($row);
        // die;

        if ($row) {
            $data = array(
                'id_menu' => $row->id_menu,
                'nama_menu' => $row->nama_menu,
                'url' => $row->url,
                'icon' => $row->icon
            );
        }

        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar', $menu);
        $this->load->view('admin/Main/main_menu_edit', $data);
        $this->load->view('admin/Nav/footer');
    }
    public function proses_edit_menu()
    {

        $nama_menu = $this->input->post('nama_menu');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');

        if (($nama_menu != '') and ($url != '') and ($icon != '')) {
            $data = [
                'nama_menu' => $nama_menu,
                'url' => $url,
                'icon' => $icon
            ];

            // var_dump($data);
            // die;
            $this->Admin_07->edit_menu($data);

            redirect('manage_admin_07/menu_07');
        } else {
            redirect('manage_admin_07');
        }
    }
    public function tambah_menu()
    {
    }
    public function hapus_menu($id)
    {
        $this->Admin_07->ambil_data_id_menu($id);
        $this->Admin_07->delete_menu($id);

        redirect('zone_admin_07');
    }


    public function menuDalamPeran_07()
    {
        //$session['a'] = $this->session->userdata();
        $id_peran = 1;
        $querymenu = "SELECT * FROM `trx_menu` INNER JOIN `menu` ON `trx_menu`.`id_menu` = `menu`.`id_menu` WHERE `trx_menu`.`id_peran` = $id_peran";
        $menu['menus'] = $this->db->query($querymenu)->result_array();

        $queryNamaMenu = "SELECT * FROM `peran` INNER JOIN `trx_menu` ON `trx_menu`.`id_peran` = `peran`.`id_peran`
        INNER JOIN `menu` ON `menu`.`id_menu` = `trx_menu`.`id_menu`";
        $menuMain['menus2'] = $this->db->query($queryNamaMenu)->result_array();

        // $arrayDataTrxPeran = array(
        //     'datas' => $
        // );

        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar', $menu);
        $this->load->view('admin/Main/main_menuDalamPeran', $menuMain);
        $this->load->view('admin/Nav/footer');
    }
    public function userDalamPeran_07()
    {
        //$session['a'] = $this->session->userdata();
        $id_peran = 1;
        $querymenu = "SELECT * FROM `trx_menu` INNER JOIN `menu` ON `trx_menu`.`id_menu` = `menu`.`id_menu` WHERE `trx_menu`.`id_peran` = $id_peran";
        $menu['menus'] = $this->db->query($querymenu)->result_array();

        // $dataTrxMenu = $this->Admin_07->ambil_semua_trx_peran();
        // $arrayDataTrxMenu = array(
        //     'datas' => $dataTrxMenu
        // );

        $queryNamaUser = "SELECT * 
        FROM `peran` 
        INNER JOIN `trx_peran` ON `trx_peran`.`id_peran` = `peran`.`id_peran`
        INNER JOIN `user` ON `user`.`id_user` = `trx_peran`.`id_user`";
        $menuUser['users'] = $this->db->query($queryNamaUser)->result_array();

        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar', $menu);
        $this->load->view('admin/Main/main_userDalamPeran', $menuUser);
        $this->load->view('admin/Nav/footer');
    }

    public function edit_userDalamPeran($id)
    {
        $id_peran = 1;
        $querymenu = "SELECT * FROM `trx_menu` INNER JOIN `menu` ON `trx_menu`.`id_menu` = `menu`.`id_menu` WHERE `trx_menu`.`id_peran` = $id_peran";
        $menu['menus'] = $this->db->query($querymenu)->result_array();

        $queryMenuPeran = "SELECT * 
        FROM `peran` 
        INNER JOIN `trx_peran` ON `trx_peran`.`id_peran` = `peran`.`id_peran`
        INNER JOIN `user` ON `user`.`id_user` = `trx_peran`.`id_user` WHERE";
        $menuPeran['perans'] = $this->db->query($queryMenuPeran)->result_array();

        // $row = $this->Admin_07->ambil_data_id_trx_menu($id);
        // // var_dump($row);
        // // die;

        // if ($row) {
        //     $data = array(
        //         'id_trx_peran' => $row->id_trx_peran,
        //         'user' => $row->user
        //     );
        // }

        $this->load->view('admin/Nav/header2');
        $this->load->view('admin/Nav/sidebar', $menu);
        $this->load->view('admin/Main/edit_userDalamPeran', $menuPeran);
        $this->load->view('admin/Nav/footer');
    }

    public function tambah_user()
    {
        if ($this->input->is_ajax_request() == true) {
            $msg = [
                'sukses' => $this->load->view('admin/Main/modal_tambah_user', '', true)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandata()
    {
        if ($this->input->is_ajax_request() == true) {
            $email = $this->input->post('email', true);
            $namaPengguna = $this->input->post('namaPengguna', true);
            $peran = $this->input->post('peran', true);
            $password = $this->input->post('password', true);
            $konfirmPassword = $this->input->post('konfirmPass', true);

            $this->form_validation->set_rules(
                'email',
                'EMAIL',
                'trim|required|is_unique[user.user]'
            );
            $this->form_validation->set_rules(
                'namaPengguna',
                'Nama Pengguna',
                'trim|required'
            );

            if ($this->form_validation->run() == TRUE) {
            } else {
                $msg = [
                    'error' => '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    ' . validation_errors() . '
                </div>'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function pendaftaran()
    {
        $email = $this->input->post('email');
        $insert_data = array(
            'user' => $this->input->post('email'),
            'nama_pengguna' => $this->input->post('namaPengguna'),
            'password' => $this->input->post('password')
        );

        $this->load->model('Admin_07');
        $this->Admin_07->tambah_user($insert_data);

        $dataUser = $this->Admin_07->ambil_data_id_user($email);

        $arrayData = [
            'id_user' => $dataUser->id_user,
            'id_peran' => $this->input->post('peran')
        ];
        $this->Admin_07->tambah_trx_peran($arrayData);
        redirect('zone_admin_07');
    }
}
