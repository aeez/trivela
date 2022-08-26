<?php
	@ob_start();
	session_start();
    include 'config.php';
	if(!isset($_SESSION['status'])){
    } elseif (isset($_SESSION['status']) && $_SESSION['level'] == 'pemilik') {
        header('location:laporan.php');
    } elseif (isset($_SESSION['status']) && $_SESSION['level'] != 'pemilik') {
        header('location:index.php');
    } 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TrivelA</title>
    <link rel="icon" href="favic.ico">
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../login/style.css" />
  </head>
  <body>
  <?php 
    if(isset($_POST['login'])){
        $user = mysqli_real_escape_string($conn,$_POST['username']);
        $pass = mysqli_real_escape_string($conn,$_POST['password']);
        $queryuser = mysqli_query($conn,"SELECT * FROM login WHERE username='$user'");
        $cariuser = mysqli_fetch_assoc($queryuser);
            
            if( password_verify($pass, $cariuser['password']) ) {
                $_SESSION['id_login'] = $cariuser['id_login'];
                $_SESSION['username'] = $cariuser['username'];
                $_SESSION['nama_toko'] = $cariuser['nama_toko'];
                $_SESSION['alamat'] = $cariuser['alamat'];
                $_SESSION['telepon'] = $cariuser['telepon'];
                $_SESSION['level'] = $cariuser['level'];
                $_SESSION['status'] = "login";

                if($cariuser && $_SESSION['level'] == "pemilik"){ 
                    echo '<script>alert("Data yang anda masukan benar");window.location="laporan.php"</script>';
                } elseif($cariuser && $_SESSION['level'] == "admin" || $_SESSION['level'] == "petugas"){
                    echo '<script>alert("Data yang anda masukan benar");window.location="index.php"</script>';
                } else{
                    echo '<script>alert("Data yang anda masukan salah");history.go(-1);</script>';
                }
                echo '<script>alert("Anda Berhasil Login");window.location="index.php"</script>';
            } else {
                echo '<script>alert("Username atau password salah");history.go(-1);</script>';
            }	
        };
  
        ?>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form method="POST" autocomplete="off" class="sign-in-form">
              <div class="logo">
                <img src="../assets/img/logo.png" alt="trivela" />
                <h4>TrivelA</h4>
              </div>

              <div class="heading">
                <h2>Welcome Back</h2>
                <!-- <h6>Not registred yet?</h6>
                <a href="#" class="toggle">Sign up</a> -->
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    name="username"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    name="password"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
                </div>

                <button class="sign-btn" name="login" type="submit">Login</button>
               

                <p class="text">
                  Kembali ke halaman 
                  <a href="../index.html">Utama</a>?
                </p>
              </div>
            </form>

            <form action="index.html" autocomplete="off" class="sign-up-form">
              <div class="logo">
                <img src="../assets/img/logo.png" alt="trivela" />
                <h4>TrivelA</h4>
              </div>

              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle">Sign in</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
                </div>

                <input type="submit" value="Sign Up" class="sign-btn" />

                <p class="text">
                  By signing up, I agree to the
                  <a href="#">Terms of Services</a> and
                  <a href="#">Privacy Policy</a>
                </p>
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="../login/img/image1.png" class="image img-1 show" alt="" />
              <img src="../login/img/image2.png" class="image img-2" alt="" />
              <img src="../login/img/image3.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>We are only sell tasty cake</h2>
                  <h2>Not only tasty, we have good quality cakes</h2>
                  <h2>We can deliver your order</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->

    <script src="../login/app.js"></script>
  </body>
</html>
