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
            <a href="<?= site_url('dashboard/users') ?>" >Kelola Pengguna</a>
          </li>
          <li>
            <a href="<?= site_url('dashboard/medicines') ?>" class="active">Kelola Obat</a>
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
    <div class="container">
      <h2><span style="color: grey; font-weight: 200">Kelola,</span> <br /> Obat</h2>
      <?php if (count($medicines) > 0): ?>
      <div class="text-right">
          <a class="btn btn-success text-white" style="margin-top: 50px" data-toggle="modal" type="button" data-target="#createModal">Buat Obat</a> 
      </div>
      <table class="table" style="margin-top: 10px">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nama Obat</th>
            <th scope="col">Kategori</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Stok</th>
            <th scope="col">Harga</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($medicines as $medicine): ?>
          <tr>
            <th scope="row"><?= $medicine->medic_id ?></th>
            <td><?= $medicine->medic_name ?></td>
            <td><?= $medicine->category ?></td>
            <td><?= $medicine->description ?></td>
            <td><?= $medicine->amount ?></td>
            <td><?= $medicine->cost ?></td>
            <td>
              <a class="btn btn-warning" data-toggle="modal" type="button" data-target="#update<?= $medicine->medic_id ?>">Perbarui</a> 
              <a class="btn btn-danger" data-toggle="modal" type="button" data-target="#delete<?= $medicine->medic_id ?>">Hapus</a>
            </td>
          </tr>
          
          <div class="modal fade" id="update<?= $medicine->medic_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Perbarui Obat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="<?= site_url('dashboard/medicines_update') ?>" method="POST" style="margin-top: 10px">
                  <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $medicine->medic_id ?>" />
                    <div class="form-group">
                        <!-- <label for="email">Email</label> -->
                        <input type="text" class="form-control" name="medic_name" value="<?= $medicine->medic_name ?>" placeholder="Nama Obat" required />
                    </div>
                    <div class="form-group">
                        <!-- <label for="email">Email</label> -->
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>
                          <?= $medicine->description ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                      <select class="custom-select" name="category" required>
                        <option value="Analgesik" selected>Analgesik</option>
                        <option value="Asetaminofen">Asetaminofen</option>
                        <option value="Etheogenic">Etheogenic</option>
                        <option value="Herbal">Herbal</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <!-- <label for="password">Password</label> -->
                        <input type="number" class="form-control" name="amount" placeholder="Stok" value="<?= $medicine->amount ?>" required />
                    </div>
                    <div class="form-group">
                        <!-- <label for="password">Password</label> -->
                        <input type="number" class="form-control" name="cost" placeholder="Harga" value="<?= $medicine->cost ?>" required />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="modal fade" id="delete<?= $medicine->medic_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus Obat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Yakin akan menghapus <?= $medicine->medic_name ?>?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <a type="button" href="<?= site_url('dashboard/medicines_delete/' . $medicine->medic_id) ?>" class="btn btn-danger">Hapus</a>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
      <div style="text-align: center">
        <h1 style="margin-top: 100px; text-align: center; opacity: .1; font-size: 70px">Tidak ada Obat</h1>
        <a class="btn btn-success text-white" data-toggle="modal" type="button" data-target="#createModal">Buat Obat</a> 
      </div>
      <?php endif; ?>
    </div>
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Buat Obat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= site_url('dashboard/medicines_create') ?>" method="POST" style="margin-top: 10px">
            <div class="modal-body">
              <div class="form-group">
                  <!-- <label for="email">Email</label> -->
                  <input type="text" class="form-control" name="medic_name" placeholder="Nama Obat" required />
              </div>
              <div class="form-group">
                  <!-- <label for="email">Email</label> -->
                  <textarea name="description" class="form-control" id="description" cols="30" rows="10" required></textarea>
              </div>
              <div class="form-group">
                <select class="custom-select" name="category" required>
                  <option value="Analgesik" selected>Analgesik</option>
                  <option value="Asetaminofen">Asetaminofen</option>
                  <option value="Etheogenic">Etheogenic</option>
                  <option value="Herbal">Herbal</option>
                </select>
              </div>
              
              <div class="form-group">
                  <!-- <label for="password">Password</label> -->
                  <input type="number" class="form-control" name="amount" placeholder="Stok" required />
              </div>
              <div class="form-group">
                  <!-- <label for="password">Password</label> -->
                  <input type="number" class="form-control" name="cost" placeholder="Harga" required />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-success text-white">Buat</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>
</html>