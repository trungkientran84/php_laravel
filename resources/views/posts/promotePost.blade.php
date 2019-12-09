<?php
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var total = 0.00;
            var top = 0;
            var bump = 0;
            var gallery=0;
            $('#select_topAd').change(function(){
                top = parseFloat($(this).val());
                $('#Total').text('$'+total.toFixed(2));
            });
            $('#select_gallery').change(function(){
                gallery = parseFloat($(this).val());
                $('#Total').text('$'+total.toFixed(2));
            });
            $('#select_bumpAd').change(function(){
                bump = parseFloat($(this).val());
                $('#Total').text('$'+total.toFixed(2));
            });

            $('#topAd').change(function(){
                if(this.checked == true) {
                    total = total + parseFloat(top);
                    $('#Total').text('$'+total.toFixed(2));
                }
                else{
                    total = total - parseFloat(top);
                    $('#Total').text('$'+total.toFixed(2));
                }
            });
            $('#gallery').change(function(){
                if(this.checked == true) {
                    total = total + parseFloat(gallery);
                    $('#Total').text('$'+total.toFixed(2));
                }
                else{
                    total = total - parseFloat(gallery);
                    $('#Total').text('$'+total.toFixed(2));
                }
            });
            $('#bumpAd').change(function(){
                if(this.checked == true) {
                    total = total + parseFloat(bump);
                    $('#Total').text('$'+total.toFixed(2));
                }
                else{
                    total = total - parseFloat(bump);
                    $('#Total').text('$'+total.toFixed(2));
                }
            });
        });
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<header>
</header>
<main>
    <form class="border border-light p-5" action="/checkout" method="post">
        {{ csrf_field() }}
        <div class="form-row justify-content-center align-items-center">
            <div class="col-5">
                <h2 class="my-5 h2 text-center">Select Ad features</h2>
                <input type="hidden" name="post_id" value="{{ old('title', $post_id ) }}">
                <!-- Default unchecked -->
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="topAd" name="Top_Ad">
                    <label class="custom-control-label" for="topAd">Top Ad</label>
                </div>
                <select class="browser-default custom-select mb-4" id="select_topAd" name="select_topAd">
                    <option value="0" disabled="" selected="">Choose your option</option>
                    <option value="6.99">3 Days           $6.99</option>
                    <option value="9.99">7 Days           $9.99</option>
                    <option value="19.99">30 Days         $19.99</option>
                </select>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="gallery" name="HomePage_Gallery">
                    <label class="custom-control-label" for="gallery">HomePage Gallery</label>
                </div>
                <select class="browser-default custom-select mb-4" id="select_gallery" name="select_gallery">
                    <option value="0" disabled="" selected="">Choose your option</option>
                    <option value="6.99">3 Days           $6.99</option>
                    <option value="9.99">7 Days           $9.99</option>
                    <option value="19.99">30 Days         $19.99</option>
                </select>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="bumpAd" name="Bump_Ad">
                    <label class="custom-control-label" for="bumpAd">Bump up Ad</label>
                </div>
                <select class="browser-default custom-select mb-4" id="select_bumpAd" name="select_bumpAd">
                    <option value="0" disabled="" selected="">Choose your option</option>
                    <option value="6.99">3 Days           $6.99</option>
                    <option value="9.99">7 Days           $9.99</option>
                    <option value="19.99">30 Days         $19.99</option>
                </select>
            <br>
                <table><tr><td class="col-3"><label for="textInput">Total</label></td><td class="col-3"><label id="Total" for="textInput" name="Total">0.00</label></td></tr></table>
                <button class="btn btn-info btn-block my-4" type="submit">CheckOut</button>
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
