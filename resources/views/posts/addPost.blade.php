<?php
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<header>
</header>
<main>
    <form class="border border-light p-5" action="/addNew" method="post">
        {{ csrf_field() }}
        <div class="form-row justify-content-center align-items-center">
            <div class="col-5">
                <label for="textInput">Ad Title</label>
                <input type="text" id="textInput" class="form-control mb-4" placeholder="Enter title here" name="title" class="@error('title') is-invalid @enderror">
                @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="textInput">Select a Category</label>
                <select class="browser-default custom-select mb-4" id="select" name="post_category" class="@error('post_category') is-invalid @enderror">
                    <option value="0" disabled="" selected="">Choose your option</option>
                    <option value="1">Real Estate</option>
                    <option value="2">Cars</option>
                    <option value="3">Jobs</option>
                </select>
                @error('post_category')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <button class="btn btn-info btn-block my-4" type="submit">Next</button>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</main>
<footer>
</footer>
</body>
</html>
