<?php

class Auth extends CI_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->model("user_model");
      $this->load->library('form_validation');
      $this->load->helper('url');

      // if ($_SESSION['user_logged']) redirect(site_url('dashboard'));
  }

  public function login()
  {
      if($this->input->post()){
          if($this->user_model->doLogin()) {
            redirect(site_url('dashboard'));
          } else {
            $this->session->set_flashdata('danger', 'Kata sandi atau email salah!');
            redirect(site_url('auth/login'));
          }
      }
      $this->load->view("auth/login_page.php");
  }

  public function logout()
  {
      $this->session->sess_destroy();
      redirect(site_url('auth/login'));
  }

  public function register()
  {
    if($this->input->post()){
      $user = $this->user_model;
      $validation = $this->form_validation;
      $validation->set_rules($user->rules());

      if ($validation->run() && $user->save()) {
        $this->session->set_flashdata('success', 'Berhasil disimpan');

        if($this->user_model->doLogin()) redirect(site_url('dashboard'));
      } else {
        $this->session->set_flashdata('danger', 'Email sudah terdaftar!');
        redirect(site_url('auth/register'));
      }
    }

    $this->load->view("auth/register_page.php");
  }
}