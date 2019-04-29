<div class="container">
    <div class="row frm-login">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="text-center login-title thai-font">เข้าสู่ระบบด้วย PSU-Passport</h1>
            <div class="account-wall">
                <div class="text-center"><img class="profile-img" src="<?=base_url('images/psupassport.png')?>" alt="psu-passport"></div>

                <form class="form-signin" method="post" action="<?=base_url('psuauthen/credentail')?>">
                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-fw fa-sign-in"></i>Sign in</button>
                </form>
            </div>
        </div>
    </div>
</div>