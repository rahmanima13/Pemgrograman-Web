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

    .rekomen {
      margin-top: 0px;
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
          <a href="#" class="active">Menu Utama</a>
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
            <a href="<?= site_url('dashboard/list') ?>">List Obat</a>
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
    <div class="container" style="position: relative">
      <h2 style="font-size: 200px; position: absolute; font-weight: bold; left: 0; top: 8%; opacity: .05; z-index: -1000">Welcome</h2>
      <h2><span style="color: grey; font-weight: 200">Halo,</span> <br /> <?= $_SESSION['user_logged']->user_name ?></h2>
      <div class="d-flex align-items-center" style="margin-top: 20px;">
        <div class="col-md-5">
          <h3 style="margin-bottom: 40px">Biarkan Marco mencari obat sesuai dengan kebutuhanmu!</h3>
          <span class="text-primary">Tarik kebawah untuk selengkapnya</span>
        </div>
        <div class="col-md-7 text-center">
          <img src="<?= base_url('assets/marginalia/marginalia-bio-technologies.png') ?>" style="width: 70%" alt="marco" />
        </div>
      </div>
      <?php if ($medicines > 0): ?>
      <div class="rekomen">
        <h5 style="margin-bottom: 15px">Rekomendasi obat</h5>
        <div class="card-deck">
          <?php foreach ($medicines as $medic): ?>
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
              <!-- <div class="card-body">
                <a href="#" class="btn btn-primary">Pesan obat</a>
              </div> -->
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>