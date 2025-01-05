<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
.container{
border-radius:10px;
width:fit-content;
padding: 24px;
}
</style>
<body class="bg-warning ">
    <div class="container mt-5 bg-white">

        <!-- Display error message as red div -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <div class="d-flex justify-content-center align-items-center gap-3 ">

            <div class>
            <img src="<?= base_url('images/image.png'); ?>" alt="Login Image" style="width: 500px; height: auto;" />

            </div>
            <div>
            <form method="post" action="<?= base_url('register') ?>" method="POST">
            <h1 class="text-center mb-5">Sign Up</h1>

                <?= csrf_field() ?>
              

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <?php if (isset($validation) && $validation->getError('email')): ?>
            <div class="alert alert-danger"><?= $validation->getError('email') ?></div>
        <?php endif; ?>
                    <input 
                        type="email" 
                        class="form-control <?= session()->getFlashdata('error') ?>" 
                        id="email" 
                        name="email" 
                        value="<?= old('email') ?>" 
                        required>
                    <!-- Error Message -->
                    <?php if (session()->getFlashdata('email_error')): ?>
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('email_error') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        class="form-control <?= session()->getFlashdata('password')?>" 
                        id="password" 
                        name="password" 
                        required>
                    <!-- Error Message -->
                    <?php if (session()->getFlashdata('password')): ?>
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('password') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="first_name" class="form-label">Fisrt name</label>
                    <input 
                        type="text" 
                        class="form-control <?= session()->getFlashdata('first_name')?>" 
                        id="first_name" 
                        name="first_name" 
                        required>
                    <!-- Error Message -->
                    
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input 
                        type="text" 
                        class="form-control <?= session()->getFlashdata('last_name')?>" 
                        id="last_name" 
                        name="last_name" 
                        required>
                    <!-- Error Message -->
                    
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-dark text-white w-100">Submit</button>
            </form>
            <p class="mt-3">
                Vous avez pas déjà un compte ? <a href="<?= base_url('login') ?>">connectz-vous</a>
            </p>
            </div>
       
        </div>

    </div>
</body>

</html>
