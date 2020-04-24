<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
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
      margin-top: 30px;
      margin-left: 250px;
      padding: 20px;
    }
  </style>
</head>
<body>
  <aside>
    <div>
      <h1>Guardian</h1>
      <span>Dashboard Center</span>
      <ul>
        <li>
          <a href="<?= site_url('dashboard') ?>">Menu Utama</a>
        </li>
        <?php if ($_SESSION['user_logged']->is_admin): ?>
          <li>
            <a href="<?= site_url('dashboard/users') ?>">Kelola Pengguna</a>
          </li>
          <li>
            <a href="<?= site_url('dashboard/medicines') ?>">Kelola Obat</a>
          </li>
        <?php endif; ?>
        <?php if (!$_SESSION['user_logged']->is_admin): ?>
          <li>
            <a href="#" class="active">List Obat</a>
          </li>
          <li>
            <a href="<?= site_url('dashboard/order') ?>">Pesanan Saya</a>
          </li>
        <?php endif; ?>
        <li>
          <a href="<?= site_url('dashboard/config') ?>">Pengaturan</a>
        </li>
      </ul>
    </div>
    <a class="btn btn-danger" href="<?= site_url('auth/logout') ?>">Keluar akun</a>
  </aside>
  <main>
    <div class="container"> 
    <h2><span style="color: grey; font-weight: 200">Jelajahi,</span> <br /> Obat</h2>
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
    <h2 style="font-size: 200px; position: absolute; font-weight: bold; right: 0; top: 5%; opacity: .05; z-index: -100">Explore</h2>
    <?php if (count($medicines) > 0): ?>
    <div class="card-columns" style="margin-top: 50px">
      <?php foreach ($medicines as $medic): ?>
      <!-- <div class="col-md-4"> -->
        <div class="card" style="margin-top: 10px">
          <div class="card-body">
            <div class="d-flex mb-3">
              <?php if ($medic->category == "Analgesik"): ?>
              <div style="padding: 10px 15px; background-color: rgba(255, 0, 0, .1); display: flex; align-items: center; margin-right: 10px; border-radius: 5px">
                <i class="fas fa-capsules" style="font-size: 30px; color: rgba(255, 0, 0, 1);"></i>
              </div>
              <?php elseif ($medic->category == "Asetaminofen"): ?>
              <div style="padding: 10px 15px; background-color: rgba(0, 0, 255, .1); display: flex; align-items: center; margin-right: 10px; border-radius: 5px">
                <i class="fas fa-capsules" style="font-size: 30px; color: rgba(0, 0, 255, 1);"></i>
              </div>
              <?php elseif ($medic->category == "Etheogenic"): ?>
              <div style="padding: 10px 15px; background-color: rgba(255, 255, 0, .1); display: flex; align-items: center; margin-right: 10px; border-radius: 5px">
                <i class="fas fa-capsules" style="font-size: 30px; color: rgba(255, 255, 0, 1);"></i>
              </div>
              <?php else: ?>
              <div style="padding: 10px 15px; background-color: rgba(0, 255, 0, .1); display: flex; align-items: center; margin-right: 10px; border-radius: 5px">
                <i class="fas fa-capsules" style="font-size: 30px; color: rgba(0, 255, 0, 1);"></i>
              </div>
              <?php endif; ?>
              <div>
                <h5 class="card-title"><?= $medic->medic_name ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?= $medic->category ?></h6>
              </div>
            </div>
            <p class="card-text"><?= $medic->description ?></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="d-flex list-group-item justify-content-between">
              <span>Stok: </span>
              <span><?= $medic->amount ?></span>
            </li>
            <li class="d-flex list-group-item justify-content-between">
              <span>Harga: </span>
              <span><?= $medic->cost ?></span>
            </li>
          </ul>
          <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createOrder<?= $medic->medic_id ?>">Pesan obat</button>
          </div>
        </div>

        <div class="modal fade" id="createOrder<?= $medic->medic_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesan <?= $medic->medic_name ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?= site_url('dashboard/order_create') ?>" method="POST" style="margin-top: 10px">
                <input type="hidden" name="medic_id" value="<?= $medic->medic_id ?>" />
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_logged']->user_id ?>" />
                <input type="hidden" name="cost" value="<?= $medic->cost ?>" />
                <div class="modal-body">
                  <div class="form-group">
                      <label for="amount">Berapa banyak</label>
                      <input type="number" class="form-control" name="amount" placeholder="Jumlah obat" required />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-success text-white">Buat Pesanan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <!-- </div> -->
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    </div>
  </main>
</body>
</html>