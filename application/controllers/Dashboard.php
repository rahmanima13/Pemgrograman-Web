<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("user_model");
    $this->load->model("medic_model");
    $this->load->model("order_model");
    $this->load->library('form_validation');
    $this->load->helper('url');

    if (!$_SESSION['user_logged']) redirect(site_url('auth/login'));
  }

  public function index()
  {
    $data["medicines"] = $this->db->get('medicines', 3)->result();
    $this->load->view("dashboard/main_page.php", $data);
  }

  public function users() {
    $data["users"] = $this->user_model->getAll();
    $this->load->view("dashboard/manage_user_page.php", $data);
  }

  public function users_delete($pid) {
    if ($this->user_model->delete($pid)) {
      $this->session->set_flashdata('success', 'Berhasil dihapus');
      redirect(site_url('dashboard/users'));
    } else {
      show_404();
    }
  }

  public function users_update() {
    $user = $this->user_model;

    if ($user->update()) {
      $this->session->set_flashdata('success', 'Berhasil diperbarui');
      redirect(site_url('dashboard/users'));
    } else {
      show_404();
    }
  }

  public function medicines() {
    $data["medicines"] = $this->medic_model->getAll();
    $this->load->view("dashboard/manage_med_page.php", $data);
  }

  public function medicines_create() {
      $medic = $this->medic_model;
      $medic->save();
      $this->session->set_flashdata('success', 'Berhasil disimpan');

      redirect(site_url('dashboard/medicines'));
  }

  public function medicines_delete($pid) {
    if ($this->medic_model->delete($pid)) {
      $this->session->set_flashdata('success', 'Berhasil dihapus');
      redirect(site_url('dashboard/medicines'));
    } else {
      show_404();
    }
  }

  public function medicines_update() {
    $medicine = $this->medic_model;

    if ($medicine->update()) {
      $this->session->set_flashdata('success', 'Berhasil diperbarui');
      redirect(site_url('dashboard/medicines'));
    } else {
      show_404();
    }
  }

  public function list() {
    $data["medicines"] = $this->medic_model->getAll();
    $this->load->view("dashboard/list_page.php", $data);
  }

  public function order() {
    $data["summarize"] = $this->order_model->getSumByUserId($_SESSION['user_logged']->user_id);
    $data["orders"] = $this->order_model->getByUserId($_SESSION['user_logged']->user_id);
    $this->load->view("dashboard/order_page.php", $data);
  }

  public function order_create() {
    $order = $this->order_model;
    $medicine = $this->medic_model;

    $post = $this->input->post();

    if ($post["amount"] > 0) {
      if (!$medicine->update_stock()) {
        $this->session->set_flashdata('danger', 'Stok obat habis, pesanan terlalu banyak');
      } else {
        $order->save();

        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan ke pesanan');
      }
    } else {
      $this->session->set_flashdata('danger', 'Minimal pesanan obat adalah > 0');
    }

    redirect(site_url('dashboard/list'));
  }

  public function order_delete($pid) {
    if ($this->order_model->delete($pid)) {
      $this->session->set_flashdata('success', 'Order berhasil dihapus');
      redirect(site_url('dashboard/order'));
    } else {
      show_404();
    }
  }

  public function order_setted() {
    $this->session->set_flashdata('success', 'Semua pesanan berhasil dibayar!');
    $this->order_model->update_setted();

    redirect(site_url('dashboard/order'));
  }

  public function config() {
    $user = $this->user_model;

    if ($this->input->post()) {
      $user->update();
      $this->session->set_flashdata('success', 'Berhasil disimpan');
    }

    $data["user"] = $user->getById($_SESSION['user_logged']->user_id);
    if (!$data["user"]) show_404();     

    $this->load->view("dashboard/config_page.php", $data);
  }
}