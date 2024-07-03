<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>public/login/style.css">

    <!-- Credit by Erwin, S.Kom -->

</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="form-control signin-form">
                <form action="#">
                    <h2>Login Apps</h2>
                    <input type="text" placeholder="Username" required />
                    <input type="password" placeholder="Password" required />
                    <button>Login</button>
                </form>
                <!-- <span>or signin with</span>
                <div class="socials">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-google-plus-g"></i>
                    <i class="fab fa-linkedin-in"></i>
                </div> -->
            </div>
        </div>
        <div class="intros-container">
            <div class="intro-control signin-intro">
                <div class="intro-control__inner">
                    <h2>Selamat Datang!</h2>
                    <p>
                        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script><dotlottie-player src="https://lottie.host/eff4445a-5952-4ea4-951c-238d60461c7e/t3GvNrDeLo.json" background="transparent" speed="1" style="width: 300px; height: 300px" direction="1" playMode="normal" loop autoplay></dotlottie-player>
                    </p>
                    <!-- <button id="signup-btn">No account yet? Signup.</button> -->
                </div>
            </div>

        </div>
    </div>
    <script src="<?= base_url() ?>public/login/script.js"></script>
</body>

</html>