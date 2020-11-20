<div class="container">
    <div class="login_content pt-5">
        <div class="card border-0">
            <div class="card-title py-1 h3 text-center">
                Register
            </div>
            <div class="card-body">
                <?php if(isset($message)) echo '<div class="text-danger text-center">'. $message.'</div>'; ?>
                <form method="post" action="/login/register">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" class="form-control" required name="username" />
                    </div><div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" required name="password" />
                    </div><div class="form-group">
                        <label for="check_password">Check Password</label>
                        <input type="password" id="check_password" class="form-control" required name="check_password" />
                    </div><div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control" required name="phone" />
                    </div>
                    <div class="form-group text-center">
                        <button type="reset" class="btn btn-info mx-2">Reset</button>
                        <button type="submit" class="btn btn-primary mx-2">Register</button>
                    </div>
                    <div class="form-group text-center text-black-50">
                        <a href="/login/login">Already have a account, login now.</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>