<?php
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<script>
    function validateform() {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var phoneformat = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        var email = document.RealEstate.Email.value;
        var phone = document.RealEstate.Phone_Number.value;

        if (email == null || email == "" || !(email.match(mailformat))) {
            alert("Valid Email is required");
            return false;
        } else if(phone !="")
            if (!(phone.match(phoneformat))) {
                alert("Phone should be XXX XXX XXXX format");
                return false;
            }
    }
</script>
<header>

</header>
<main>
    <form name="RealEstate" class="border border-light p-5" action="/editAttributes" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
        {{ csrf_field() }}
        <div class="form-row justify-content-center align-items-center">
            <div class="col-5">
                <p class="h4 mb-4 text-left">Ad Details</p>
                <label for="textInput">Ad Type:</label>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="Ad_TypeChecked" name="Ad_Type" checked value="I am offering" {{ $postData["Ad_Type"] == "I am offering" ? 'checked' : '' }}>
                    <label class="custom-control-label" for="Ad_TypeChecked">I am offering</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="Ad_TypeUnchecked" name="Ad_Type" value="I want" {{ $postData["Ad_Type"] == "I want" ? 'checked' : '' }}>
                    <label class="custom-control-label" for="Ad_TypeUnchecked">I want</label>
                </div>
                <br>
                <label for="textInput">Furnished:</label>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="FurnishedChecked" name="Furnished"  value="Yes" {{ $postData["Furnished"] == "Yes" ? 'checked' : '' }}>
                    <label class="custom-control-label" for="FurnishedChecked">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="FurnishedUnchecked" name="Furnished" value="No" {{ $postData["Furnished"] == "No" ? 'checked' : '' }}>
                    <label class="custom-control-label" for="FurnishedUnchecked">No</label>
                </div>
                <br>
                <label for="textInput">Ad Title</label>
                <input type="hidden" name="post_id" value="{{ old('title', $postData["post_id"] ) }}">
                <input type="hidden" name="post_category" value="{{ old('title', $postData["post_category"] ) }}">
                <input readonly type="text" id="textInput" class="form-control mb-4" name="title" placeholder="Should be populated" value="{{ old('title', $postData["title"] ) }}">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="4" name="Description">{{ old('Description', $postData["Description"] ) }}</textarea>
                </div>
                <p class="h4 mb-4 text-left">Media</p>
                <label for="textInput">Select Images :</label>
                <input type="file" name="images[]" multiple>
                <p class="h4 mb-4 text-left">Price</p>
                <label for="textInput">Price:</label>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="PriceChecked" name="Price" {{ $postData["Price"] != "Please Contact" ? 'checked' : '' }}>
                    <label class="custom-control-label" for="PriceChecked">$</label><input type="text" id="textInput" class="form-control mb-4" placeholder="1200" name="Price"  value="{{ $postData["Price"] != "Please Contact" ? old('title', $postData["Price"]) : "" }}">
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="PriceUnchecked" name="Price" value="Please Contact" {{ $postData["Price"] == "Please Contact" ? 'checked' : '' }}>
                    <label class="custom-control-label" for="PriceUnchecked">Please Contact</label>
                </div>
                <br>
                <p class="h4 mb-4 text-left">Contact Information</p>
                <label for="textInput">Phone Number:</label>
                <input type="text" id="textInput" class="form-control mb-4" placeholder="Enter your Phone Number(optional)" name="Phone_Number" value="{{ old('title', $postData["Phone_Number"] ) }}">
                <label for="textInput">Email:</label>
                <input type="text" id="textInput" class="form-control mb-4" placeholder="Enter your Email" name="Email" value="{{ old('title', $postData["Email"] ) }}">
                <button class="btn btn-info btn-block my-4" type="submit">Update Your Ad</button>
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

