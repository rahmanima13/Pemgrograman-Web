<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
  <style>
    aside {
      display: flex;
      justify-content: space-between;
      flex-direction: column;
      position: fixed;
      width: 250px;
      border-right: 2px solid rgba(0, 0, 0, .05);
      border-radius: 30px;
      padding: 40px 20px;
      bottom: 0;
      top: 0;
    }

    aside span {
      opacity: .2;
    }

    aside ul {
      list-style: none;
      margin: 0;
      padding: 0;
      margin-top: 30px;
    }

    ul li a {
      display: block;
      font-size: 18px;
      padding: 10px 0;
      color: black;
      opacity: .5;
    }

    ul li a.active {
      color: deepskyblue;
      opacity: 1;
      font-weight: bold;
    }

    ul li a:hover {
      text-decoration: none;
      color: deepskyblue;
    }

    main {
      margin-top: 10px;
      margin-left: 250px;
      padding: 20px;
    }
  </style>
</head>
<body>
    <!-- <?php var_dump($orders) ?> -->
  <aside>
    <div>
      <h1>Guardian</h1>
      <span>Dashboard Center</span>
      <ul>
        <li>
          <a href="<?= site_url('dashboard') ?>">Menu Utama</a>
        </li>
        <li>
          <a href="<?= site_url('dashboard/list') ?>">List Obat</a>
        </li>
        <li>
          <a href="#" class="active">Pesanan Saya</a>
        </li>
        <li>
          <a href="<?= site_url('dashboard/config') ?>">Pengaturan</a>
        </li>
      </ul>
    </div>
    <a class="btn btn-danger" href="<?= site_url('auth/logout') ?>">Keluar akun</a>
  </aside>
  <main>
    <?php if (count($orders) > 0): ?>
    <div class="container" style="position: relative">
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong><?= $this->session->flashdata('success') ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php elseif ($this->session->flashdata('danger')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong><?= $this->session->flashdata('danger') ?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif ?>
      <h2 style="font-size: 200px; position: absolute; font-weight: bold; left: 0; top: 0; opacity: .05; z-index: -1000">Orders</h2>
      <div class="d-flex align-items-center" style="margin-top: 20px;">
        <div class="col-md-4">
          <h3 style="font-weight: 100; color: grey">Total Tagihan</h3>
          <?php if ($summarize): ?>
          <h2 id="total" style="font-size: 100px; font-weight: 500">$<?= $summarize[0]['total_costs'] ?></h2>
          <button type="button" class="btn btn-primary" style="margin-top: 20px" data-toggle="modal" data-target="#confirmModal">Bayar Tagihan</button>
          <?php else: ?>
            <h2 id="total" style="font-size: 100px; font-weight: 500">$0</h2>
          <?php endif; ?>
        </div>
        <div class="col-md-8 text-center">
          <img src="<?= base_url('assets/marginalia/marginalia-online-shopping.png') ?>" style="width: 70%" alt="marco" />
        </div>
      </div>
      <div class="row">
        <?php foreach ($orders as $order): ?>
        <!-- <?php var_dump($summarize[0]['total_costs']) ?> -->
        <?php if ($order['setted']): ?>
        <div class="col-md-4">
          <div class="card text-white bg-success mb-3" style="margin-top: 10px">
            <div class="card-header">Sudah dibayar</div>
            <div class="card-body">
              <h5 class="card-title"><?= $order['medic_name'] ?></h5>
            </div>
            <ul class="list-group list-group-flush bg-success">
              <li class="d-flex list-group-item justify-content-between bg-success">
                <span>Jumlah: </span>
                <span><?= $order["order_amount"] ?></span>
              </li>
              <li class="d-flex list-group-item justify-content-between bg-success">
                <span>Total Harga: </span>
                <span><?= $order["order_cost"] ?></span>
              </li>
            </ul>
          </div>
        </div>
        <?php else: ?>
        <div class="col-md-4">
          <div class="card text-white bg-danger mb-3" style="margin-top: 10px">
            <div class="card-header">Belum dibayar</div>
            <div class="card-body">
              <h5 class="card-title"><?= $order['medic_name'] ?></h5>
            </div>
            <ul class="list-group list-group-flush bg-danger">
              <li class="d-flex list-group-item justify-content-between bg-danger">
                <span>Jumlah: </span>
                <span><?= $order["order_amount"] ?></span>
              </li>
              <li class="d-flex list-group-item justify-content-between bg-danger">
                <span>Total Harga: </span>
                <span><?= $order["order_cost"] ?></span>
              </li>
            </ul>
            <div class="card-body">
              <a type="button" href="<?= site_url('dashboard/order_delete/' . $order['order_id']) ?>" class="btn btn-primary">Hapus pesanan</a>
            </div>
          </div>
        </div>
        <?php endif ?>
        <?php endforeach; ?>
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Selesaikan transaksi?
              </div>
              <div class="modal-footer">
                <!-- <form action="<?= site_url('dashboard/order_setted') ?>" method="PATCH"> -->
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <a type="submit" href="<?= site_url('dashboard/order_setted') ?>" class="btn btn-success text-white">Bayar</a>
                <!-- </form> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php else: ?>
    <h1 style="margin-top: 100px; text-align: center; opacity: .1; font-size: 70px">Berlum ada orderan</h1>
    <?php endif; ?> 
  </main>
  <script>
    // $('#show_data').on('click','.item_edit',function(){

    // });
    $("#confirm").click(function() {
      // $.ajax({
      //   type : "POST",
      //   url  : "<?php echo base_url('index.php/dashboard/order_update')?>",
      //   dataType : "JSON",
      //   success: function(data){
          $('#confirmModal').dismiss();

      //   }
      // });
      // return false;
    })
  </script>
</body>
</html>