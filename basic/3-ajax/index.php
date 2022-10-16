<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">

    <title>Insert City to Database</title>

    <style>
        span.success {
            color: #4CAF50;
        }

        span.error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <form class="my-5" action="insertData.php" method="post" id="provinceForm">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">
                            نام شهر :
                        </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="cityName"
                            placeholder="نام شهر را وارد کنید">
                        <div id="emailHelp" class="form-text">
                            نام شهر را وارد کنید تا در دیتابیس ذخیره شود
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success float-end">
                        افزودن شهر
                    </button>
                </form>

                <div class="" id="result"></div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            var form = $("#provinceForm");
            var resultTag = $("#result");

            form.submit(function(event) {
                resultTag.html(
                    "<div class='spinner-border text-warning' role='status'> <span class='visually-hidden'>Loading...</span></div>"
                );
                event.preventDefault();
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    success: function(e) {
                        resultTag.html(e)
                    }
                })
            })
        })
    </script>

</body>

</html>