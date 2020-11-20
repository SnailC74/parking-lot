<div class="container">
    <div class="login_content pt-5">
        <div class="card border-0 border-right">
            <div class="card-title py-1 h3 text-center">
                Login
            </div>
            <div class="card-body">
                <?php if(isset($message)) echo '<div class="text-danger text-center">'. $message.'</div>'; ?>
                <form method="post" action="/login/login">
                    <div class="form-group">
                        <label for="username" class="col-form-label h3">Username</label>
                        <input type="text" class="form-control" required id="username" name="username" />
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label h3">Password</label>
                        <input type="password" class="form-control" required id="password" name="password" />
                    </div>
                    <div class="form-group text-center">
                        <button type="reset" class="btn btn-info mx-2">Reset</button>
                        <button type="submit" class="btn btn-primary mx-2">Login</button>
                    </div>
                    <div class="form-group text-center text-black-50">
                        <a href="/login/register">Don't have a account, register one.</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>