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
      margin-top: 50px;
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
            <a href="<?= site_url('dashboard/list') ?>">List Obat</a>
          </li>
          <li>
            <a href="<?= site_url('dashboard/order') ?>">Pesanan Saya</a>
          </li>
        <?php endif; ?>
        <li>
          <a href="#" class="active">Pengaturan</a>
        </li>
      </ul>
    </div>
    <a class="btn btn-danger" href="<?= site_url('auth/logout') ?>">Keluar akun</a>
  </aside>
  <main>
    <div class="container">
      <h2><span style="color: grey; font-weight: 200">Pengaturan,</span> <br /> Akun</h2>
      <div class="row">
        <div class="col-5">
          <form action="<?= site_url('dashboard/config') ?>" method="POST" style="margin-top: 50px">
            <input type="hidden" name="id" value="<?= $user->user_id ?>" />
            <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input type="text" class="form-control" name="user_name" value="<?= $user->user_name ?>" placeholder="Nama Pengguna" required />
            </div>
            <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input type="text" class="form-control" name="email" value="<?= $user->email ?>" placeholder="Email" required />
            </div>
            <div class="form-group">
                <!-- <label for="password">Password</label> -->
                <input type="password" class="form-control" name="password" placeholder="Kata Sandi" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Perbarui" />
            </div>
          </form>
        </div>
        <div class="col-7 text-center">
          <img src="<?= base_url('assets/marginalia/marginalia-list-is-empty.png') ?>" style="width: 80%" alt="greetings" />
        </div>
      </div>
    </div>
  </main>
</body>
</html>