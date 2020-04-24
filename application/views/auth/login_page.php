<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin</title>

    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <h2 style="font-size: 200px; position: absolute; font-weight: bold; left: 0; top: 10%; opacity: .05; z-index: -100">Welcome</h2>
        <div class="row">
            <div class="col-5 col-md-5" style="margin-top: 250px">
                <div style="margin-bottom: 30px">
                    <h1 style="font-size: 50px">Apotek Guardian</h1>
                    <p class="lead">Silahkan masuk akun</p>
                </div>
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
                <form action="<?= site_url('auth/login') ?>" method="POST">
                    <div class="form-group">
                        <!-- <label for="email">Email</label> -->
                        <input type="email" class="form-control" name="email" placeholder="Email" required />
                    </div>
                    <div class="form-group">
                        <!-- <label for="password">Password</label> -->
                        <input type="password" class="form-control" name="password" placeholder="Kata Sandi" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Belum punya akun? <a href="<?= site_url('auth/register') ?>">Daftar Sekarang</a></label>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Masuk" />
                    </div>
                </form>
            </div>
            <div class="col-7 col-md-7" style="margin-top: 100px">
                <img src="<?= base_url('assets/marginalia/marginalia-artifficial-intelligence.png') ?>" style="width: 100%" alt="greetings" />
            </div>
        </div>
    </div>

</body>

</html>