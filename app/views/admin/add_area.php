<main class="container">
    <?php include './app/views/admin/menu.php'?>
    <div class="main_content">
            <form method="post" action="/admin/add_area">
                <div class="form-group">
                    <label for="name" class="col-form-label h3">Area Name</label>
                    <input type="text" class="form-control" required id="name" name="name" />
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-block btn-info mx-2">Submit</button>
                </div>
            </form>
    </div>
</main>
