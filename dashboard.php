<?php
    require_once('database.php');
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
    $error = '';
    const db = new db;
    db->init();

    if (isset($_POST['submit'])) {
        if ($_FILES['uploadinput']['error'] > 0) 
            $error = "Error during transfer";
    
        $maxsize = 1000000 * 100000; // 1000 mb
        if ($_FILES['uploadinput']['size'] > $maxsize) 
            $error = "The file is too large.";
        
        if ($error == '') {
            $ext = strtolower(substr(strrchr($_FILES['uploadinput']['name'],'.'),1));
            $id = uniqid(rand(), true); 
            $resultat = move_uploaded_file($_FILES['uploadinput']['tmp_name'],  "uploads/" . $id . "." . $ext );

            db->SaveFileToDB($_SESSION['username'],$_FILES['uploadinput']['name']);
        }

    }



    $results = db->getUploads($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>A-Uploader | Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    </head>
    
    <body>
        <?php include 'includes/navbar.php';?>
        <?php if ($error != '') { ?>
            <div class="is-flex is-justify-content-center mb-5">
                <article class="message is-danger is-small">
                    <div class="message-body">
                        <?php echo $error; ?>
                    </div>
                </article>
            </div>
        <?php } ?>

        <div class="is-flex is-align-items-center is-flex-direction-column mt-5">
            <h1 class="title">Welcome to dashboard</h1>


            <form class="is-flex is-flex-direction-column" method="POST" action="dashboard.php" enctype="multipart/form-data">
                <div class="file is-normal is-boxed">
                    <label class="file-label">
                        <input class="file-input" type="file" name="uploadinput" id="fileinput"/>
                        <span class="file-cta">
                            <span class="file-label">Upload a file...</span>
                        </span>
                        <span class="file-name is-size-5" id="filename_span">No file uploaded </span>
                    </label>
                </div>
                <input class="button is-success px-5" type="submit" name="submit" value="Upload" />
            </form>    
        </div>

        <div class="container is-max-desktop is-flex is-align-items-center is-flex-direction-column mt-6" style="max-height: 20em; overflow-y: auto;">
            <table class="table is-fullwidth is-striped is-hoverable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($results as $row) {
                            echo '
                                <tr>
                                    <td>'.$row['ID'].'</td>
                                    <td>'.$row['url'].'</td>
                                    <td>'.$row['CreatedAt'].'</td>
                                    <td>
                                        <a href="#" class="button mx-1 is-primary">Download</a>
                                        <a href="#" class="button mx-1 is-link">Copy link</a>
                                        <a href="#" class="button mx-1 is-danger">Delete</a>
                                    </td>
                                </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="container is-fullhd is-flex is-justify-content-center mt-5">
            <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
                <a class="pagination-previous">Previous</a>
                <a href="#" class="pagination-next">Next</a>
                
                <ul class="pagination-list">
                    <li>
                        <a class="pagination-link is-current">1</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link">2</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-link">3</a>
                    </li>
                </ul>
            </nav>
        </div>
    </body>
</html>

<script>

    document.addEventListener("DOMContentLoaded", (event) => {

        const fileInput = document.getElementById('fileinput');
        const fileNameSpan = document.getElementById('filename_span');
        fileInput.onchange = (e) => {
            if (fileInput.files.length > 0) {
                fileNameSpan.textContent = fileInput.files[0].name;
            }
        };



        const pagesbtn = document.querySelectorAll('.pagination-link');
        const next = document.querySelector('.pagination-next');
        const previous = document.querySelector('.pagination-previous');
        let page_active = 0;


        function change_page(index) {
            pagesbtn[page_active].classList.remove("is-current");
            page_active = index;
            const page_active_button = pagesbtn[page_active];
            page_active_button.classList.add("is-current");
        }

        pagesbtn.forEach(element => {
            element.addEventListener("click", function(e) {
                if (element.classList.contains("is-current")) { return; };
                change_page(element.textContent - 1);
            });
        });

        next.addEventListener("click", function(e) {
            if (page_active >= pagesbtn.length - 1) { return; };
            change_page(page_active + 1);
        });

        previous.addEventListener("click", function(e) {
            if (page_active <= 0) { return; };
            change_page(page_active - 1);
        });
    });

</script>