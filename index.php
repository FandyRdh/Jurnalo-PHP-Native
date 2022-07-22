<?php
include_once "controller.php";

// View Data
$journals = journalView();

// login
if (isset($_POST['btn-login'])) {
   if (login($_POST)) {
      echo "
      <script>
          alert('Password atau username salah');
      </script>
      ";
   }
}

// Logout 
if (isset($_GET['btn-logout'])) {
   logout();
}

// register
if (isset($_POST['btn-signup'])) {
   if (registerUser($_POST)) {
      echo "
      <script>
          alert('registration succes');
      </script>";
   } else {
      echo "
      <script>
          alert('oops, registration failed');
      </script>";
   }
}

// Create Journal
if (isset($_POST['createJournal'])) {
   // call function and check insert
   if (journalCreate($_POST) > 0) {
      echo "
          <script>
              alert('Data Berhasil Ditambahkan');
              document.location.href = 'index.php';
          </script>
      ";
   } else {
      echo "
      <script>
          alert('Data Gagal Ditambahkan');
      </script>
      ";
   }
}


?>

<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/css/style.css">
   <script src="https://unpkg.com/feather-icons"></script>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   <title>Hello, world!</title>
</head>

<body>
   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid container">
         <a class="navbar-brand" href="#">ĵurnalo</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
               <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
               <!-- <a class="nav-link active" aria-current="page" href="#">Home</a>
               <a class="nav-link" href="#">Features</a>
               <a class="nav-link" href="#">Pricing</a> -->
            </div>
            <?php
            if (isset($_SESSION['login'])) {
               $nama = $_SESSION['NAME'];
               echo <<<PROFILE_MENU
                  <div class="dropdown">
                     <h6>Hallo, $nama</h6>
                     <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/img/photo-profile.jpg" width="50px" alt="">
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ModalJurnalCreate">New Journals</a></li>
                        <li><a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalLogout">Logout</a></li>
                     </ul>
                  </div>
               PROFILE_MENU;
            } else {
               echo "
                  <a href='#' class='myButton' data-bs-toggle='modal' data-bs-target='#modalLogin'>Login</a>
               ";
            }

            ?>
            <!-- When already Login -->

         </div>
      </div>
   </nav>

   <!-- banner -->
   <div class="banner">
      <div class="container">
         <div class="text-about-us">
            <h6 class="intro-section">Start Learning Today</h6>
            <h3 class="titile-section">Temui Kelas Berdasarkan Kategori Yang Kami Sediakan</h3>
            <p class="desc-section">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
            <button class="btn-about-us">Buat Akun</button>
         </div>
         <div class="img-about-us">
            <img src="assets/img/Main.png" alt="">
         </div>
      </div>
   </div>

   <!-- Jurnals -->
   <div class="jurnals">
      <div class="container">
         <div class="text-jurnals">
            <h3 class="titile-section">Temui Kelas Berdasarkan Kategori Yang Kami Sediakan</h3>
            <p class="desc-section">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>

         </div>
         <div class="card-group">
            <?php foreach ($journals as $journal) : ?>
               <!--  -->
               <div class="card-jurnals" style="background-image: url(assets/img/img-test.jpg);">
                  <div class="category hov">#education</div>
                  <div class="title"><?= $journal['TITILE']; ?></div>
                  <p class="body2 hovOn"><?= substr($journal['BODY2'], 0, 200) . "..."; ?></p>
                  <div class="writerData hov">
                     <img src="/assets/img/photo-profile.jpg" alt="" class="photoProfile">
                     <div class="writer">FandyRdh</div>
                  </div>
                  <a class="readMore hovOn" data-title="<?php $journal['TITILE'] ?>" id="btn-readmore" data-body2="<?= $journal['BODY2']; ?>">Read More ⇾</a>
               </div>
            <?php endforeach; ?>


         </div>
      </div>
   </div>















   <!-- Modal Logout-->
   <div class="modal fade modal-logout" id="modalLogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-body">
               <h6 class="modal-title">Logout</h6>
               <p class="modal-desc">Temukan berbagai kelas yang dapat
                  meningkatkan keahlian IT kita</p>
               <div class="btn-group-logout">
                  <a href="index.php?btn-logout=true" class="btn btn-primary btn-logout">sign out</a>
                  <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">cancle</button>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal Search-->
   <div class="modal fade modal-search" id="modalSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-body">
               <h6 class="modal-title">Get It Quick</h6>
               <p class="modal-desc">Temukan berbagai kelas yang dapat meningkatkan keahlian IT kita</p>
               <!--  -->
               <form>
                  <label for="inputPassword2" class="visually-hidden">Keyword</label>
                  <input type="text" class="form-control keyword" id="inputPassword2" placeholder="keyword">

                  <label for="inputPassword2" class="visually-hidden">Categories</label>
                  <select class="form-select categories" aria-label=".form-select-sm example">
                     <option selected>Open this select menu</option>
                     <option value="1">One</option>
                     <option value="2">Two</option>
                     <option value="3">Three</option>
                  </select>
                  <button type="submit" class="btn btn-primary btn-search">Cari</button>
               </form>
               <div class="mostSearch">
                  <div class="txt-mostSearch">categories paling dicari :</div>
                  <a href=""><button type="button" class="btn btn-secondary">#agus</button></a>
                  <a href=""><button type="button" class="btn btn-secondary">#prabowo</button></a>
                  <a href=""><button type="button" class="btn btn-secondary">#jokowi</button></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal Login-->
   <div class="modal fade modal-login" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-body">
               <div class="row">
                  <div class="col-5 rightSection">
                     <img src="assets/img/Hello-rafiki_1.png" alt="">
                     <h6 class="modal-title">Hello, Friend!</h6>
                     <p class="modal-desc">Enter your personal details and start jurney with us</p>
                     <button type="button" class="btn-signup" data-bs-target="#modalregister" data-bs-toggle="modal" data-bs-dismiss="modal">sign up</button>
                  </div>
                  <div class="col-7 leftSection">
                     <h5>Sign In</h5>
                     <form action="" method="POST">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="text" name="email-login" class="form-control emailLogin" id="exampleInputPassword1">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password-login" class="form-control pwLogin" id="exampleInputPassword1">
                        <div class="link-group">
                           <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input">
                              <label class="form-check-label" for="exampleCheck1">Remember me</label>
                           </div>
                           <div class="mb-3 form-check">
                              <a href="">Forgot Password?</a>
                           </div>
                        </div>
                        <button type="submit" class="btn-signup" name="btn-login">sign up</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal Register-->
   <div class="modal fade modal-register" id="modalregister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-body">
               <div class="row">
                  <div class="col-7 leftSection">
                     <h5>Sign Up</h5>
                     <form action="" method="POST">
                        <label for="exampleInputPassword1" class="form-label">Name</label>
                        <input type="text" name="name-register" class="form-control emailregister input-registe" id="exampleInputPassword1">
                        <label for="exampleInputPassword1" class="form-label">Email</label>
                        <input type="email" name="email-register" class="form-control pwregister input-registe" id="exampleInputPassword1">
                        <label for="exampleInputPassword1" class="form-label">Birth</label>
                        <input type="date" name="birth-register" class="form-control emailregister input-registe" id="exampleInputPassword1">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password-register" class="form-control pwregister input-registe" id="exampleInputPassword1">
                        <div class="link-group">
                           <div class="mb-3 form-check">
                              <input type="checkbox" class="form-check-input">
                              <label class="form-check-label" for="exampleCheck1">Agree to terms and conditions</label>
                           </div>
                           <!-- <div class="mb-3 form-check">
                              <a href="">Forgot Password?</a>
                           </div> -->
                        </div>
                        <button type="submit" class="btn-signup" name="btn-signup">sign up</button>
                     </form>
                  </div>
                  <div class="col-5 rightSection">
                     <img src="assets/img/Hello-rafiki_2.png" alt="">
                     <h6 class="modal-title">Welcome Back!</h6>
                     <p class="modal-desc">Enter your To keep connected with us please login with your personal info details and start jurney with us</p>
                     <button type="button" class="btn-signup" data-bs-target="#modalLogin" data-bs-toggle="modal" data-bs-dismiss="modal">sign In</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal jurnalView-->
   <div class="modal fade modal-jurnalView" id="ModalJurnalView" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
         <div class="modal-content">
            <div class="modal-body">
               <div class="cover" style="background-image: url(assets/img/Cover.png);">
                  <div class="container-fluid">
                     <!-- Button Close -->
                     <button type="button" class="btn-mJurnal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x" class="align-self-center"></i>
                     </button>
                     <div class="btnGroup">
                        <!-- settings -->
                        <div class="dropup">
                           <button type="button" class="btn-mJurnal" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <i data-feather="settings" class="align-self-center"></i>
                           </button>
                           <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalJurnalEdit">Edit Jurnal</a></li>
                              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalDeleteJurnal">Delete Jurnal</a></li>
                           </ul>
                        </div>
                        <!-- share -->
                        <div class="dropup">
                           <button type="button" class="btn-mJurnal" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <i data-feather="share-2" class="align-self-center"></i>
                           </button>
                           <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="#">Facebook</a></li>
                              <li><a class="dropdown-item" href="#">Instagram</a></li>
                              <li><a class="dropdown-item" href="#">Twitter</a></li>
                           </ul>
                        </div>
                        <!-- download -->
                        <div class="dropup">
                           <button type="button" class="btn-mJurnal" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <i data-feather="download" class="align-self-center"></i>
                           </button>
                           <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="#">Save as PDF</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container jurnal">
                  <div class="row">
                     <div class="col leftSection">
                        <h6 class="titleJurnal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt, enim?</h6>
                        <!--  -->
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, eos nobis dolorem ad earum modi mollitia assumenda harum ex numquam.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem et qui temporibus, omnis quidem iure aspernatur maxime cumque repellat vel provident sapiente sint, doloribus debitis unde dolore optio accusamus a!</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos assumenda cumque odio, optio totam voluptatum velit vero! Nemo repudiandae architecto sapiente esse, molestias doloribus odit tempora ratione ducimus quae, harum nostrum! Minima rerum provident, quia expedita voluptatum corporis aperiam voluptatibus ipsam modi ullam inventore quis, deserunt fugiat cupiditate quisquam ab.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae dolorem officia dolor nesciunt neque corporis voluptas pariatur quo rem eos deserunt quis perferendis delectus quae praesentium eum, expedita labore sit. Ipsum, id. Aperiam voluptatum labore enim quia quasi laborum aut blanditiis optio exercitationem. Dolorem atque quae nobis veniam, molestias expedita?</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, eos nobis dolorem ad earum modi mollitia assumenda harum ex numquam.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem et qui temporibus, omnis quidem iure aspernatur maxime cumque repellat vel provident sapiente sint, doloribus debitis unde dolore optio accusamus a!</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos assumenda cumque odio, optio totam voluptatum velit vero! Nemo repudiandae architecto sapiente esse, molestias doloribus odit tempora ratione ducimus quae, harum nostrum! Minima rerum provident, quia expedita voluptatum corporis aperiam voluptatibus ipsam modi ullam inventore quis, deserunt fugiat cupiditate quisquam ab.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae dolorem officia dolor nesciunt neque corporis voluptas pariatur quo rem eos deserunt quis perferendis delectus quae praesentium eum, expedita labore sit. Ipsum, id. Aperiam voluptatum labore enim quia quasi laborum aut blanditiis optio exercitationem. Dolorem atque quae nobis veniam, molestias expedita?</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, eos nobis dolorem ad earum modi mollitia assumenda harum ex numquam.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem et qui temporibus, omnis quidem iure aspernatur maxime cumque repellat vel provident sapiente sint, doloribus debitis unde dolore optio accusamus a!</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos assumenda cumque odio, optio totam voluptatum velit vero! Nemo repudiandae architecto sapiente esse, molestias doloribus odit tempora ratione ducimus quae, harum nostrum! Minima rerum provident, quia expedita voluptatum corporis aperiam voluptatibus ipsam modi ullam inventore quis, deserunt fugiat cupiditate quisquam ab.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae dolorem officia dolor nesciunt neque corporis voluptas pariatur quo rem eos deserunt quis perferendis delectus quae praesentium eum, expedita labore sit. Ipsum, id. Aperiam voluptatum labore enim quia quasi laborum aut blanditiis optio exercitationem. Dolorem atque quae nobis veniam, molestias expedita?</p>
                     </div>
                     <div class="col-2 rightSection">
                        <img src="assets/img/photo-profile.jpg" alt="">
                        <div class="name">Christophe Connors</div>
                        <div class="dateJournal">20/07/2022</div>
                        <div class="body2">Author, Executive Coach & Emotional Intelligence Speaker; Seen on Fox, ABC, CNBC, etc.; http://chrisdconnors.com</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal jurnalCreate -->
   <div class="modal fade" id="ModalJurnalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-body">
               <center>
                  <h6>New Journal</h6>
               </center>
               <form action="" method="POST">
                  <div class="form-floating mb-3">
                     <textarea class="form-control" name="title-create" placeholder="Leave a titile here" id="floatingTextarea" style="height: 100px"></textarea>
                     <label for="floatingTextarea">Titile Journal</label>
                  </div>
                  <div class="form-floating mb-4">
                     <textarea class="form-control" name="body1-create" placeholder="Leave a body journal here" id="floatingTextarea2" style="height: 400px"></textarea>
                     <label for="floatingTextarea2">Body Journal</label>
                  </div>
                  <center>
                     <button class="btn btn-primary" name="createJournal">Save</button>
                  </center>
               </form>
            </div>
         </div>
      </div>
   </div>







   <script>
      // 
      document.getElementById("btn-readmore").addEventListener("click", myFunction);

      function myFunction() {

         alert("hai");
         // var title = this.dataset.title;
         // var body2 = this.dataset.body2;
         // alert(body2);

         // var myModal = new bootstrap.Modal(ModalJurnalView, {});


         // // var1 = document.getElementById("hahaha").innerText;
         // // var1 = document.getElementById('hahaha').value;


         // // document.getElementById("input2").setAttribute('value', var1);
         // // document.getElementById("imageid").src = var2;
         // // document.getElementById("hahaha").setAttribute('value', var1);
         // myModal.show();


      }
   </script>

   <script>
      feather.replace();
   </script>


   <!-- Option 2: Separate Popper and Bootstrap JS -->

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>