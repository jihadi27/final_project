<?php
use Mpdf\Mpdf;
    ob_start();

    include'connect.php';

        $sql = "SELECT news.news_id, news.title, news.post_date,
                categories.category_name, admins.username
            FROM news
            LEFT JOIN categories ON news.category = categories.category_id
            LEFT JOIN admins ON news.admin = admins.admin_id";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=ebgaramond">
    <link rel="stylesheet" href="assets/css/print.css">
    <title>Document</title>
    
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <h2 class="text-center">News List</h2><br>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Category</th>
                    <th scope="col">Admin</th>
                </tr>
            </thead>
    
            <?php 
                $result = mysqli_query($conn,$sql) or die("Query Failed.");
                if (mysqli_num_rows($result) > 0) {
            ?>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['news_id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['post_date']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
        }
    ?>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>

<?php
    require './mpdf/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_top' => 25,
        'margin_botton' => 25,
        'margin_left' => 25,
        'margin_right' => 25
    ]);

    $html = ob_get_contents();

    ob_end_clean();
    $mpdf->WriteHTML(utf8_encode($html));

    $content = $mpdf->Output("cetak.pdf", "D");
?>