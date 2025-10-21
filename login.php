<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    </head>
    
    <body>
        <?php include 'includes/navbar.php';?>
        
        <div class="is-flex is-justify-content-center">
            <form class="box">
                <div class="is-flex is-justify-content-center mb-4">
                    <h2 class="is-size-3">Login</h2>
                </div>
                <div class="field">
                    <label class="label">Username</label>
                    <div class="control">
                        <input class="input control" type="text">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input class="input control" type="password">
                    </div>
                </div>

                <div class="field is-flex is-justify-content-center is-flex-direction-column mt-5">
                    <button class="button is-success px-6">Login</button>
                    <a class="pt-2" href="#">Don’t have an account?</a>
                </div>
            </form>
        </div>
    </body>
</html>