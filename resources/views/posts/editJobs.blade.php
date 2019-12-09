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
        var email = document.Jobs.Email.value;
        var phone = document.Jobs.Phone_Number.value;

        if (email == null || email == "" || !(email.match(mailformat))) {
            alert("Valid Email is required");
            return false;
        }  else if(phone !="")
            if (!(phone.match(phoneformat))) {
                alert("Phone should be XXX XXX XXXX format");
                return false;
            }
    }
</script>
<header>

</header>
<main>
    <form name="Jobs" class="border border-light p-5" action="/addAttributes" method="post" enctype="multipart/form-data" onsubmit="return validateform()">
        {{ csrf_field() }}
        <div class="form-row justify-content-center align-items-center">
            <div class="col-5">
                <p class="h4 mb-4 text-left">Ad Details</p>
                <label for="textInput">Job Offered By:</label>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="Ad_TypeChecked" name="Ad_Type" value="Individual" {{ $postData["Ad_Type"] == "Individual" ? 'checked' : '' }}>
                    <label class="custom-control-label" for="Ad_TypeChecked">Individual</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="Ad_TypeUnchecked" name="Ad_Type" value="Professional Employer" {{ $postData["Ad_Type"] == "Professional Employer" ? 'checked' : '' }}>
                    <label class="custom-control-label" for="Ad_TypeUnchecked">Professional Employer</label>
                </div>
                <br>
                <label for="textInput">Company</label>
                <input type="text" id="textInput" class="form-control mb-4" placeholder="optional" name="Company" value="{{ old('title', $postData["Company"] ) }}">
                <label for="textInput">Job Type</label>
                <select class="browser-default custom-select mb-4" id="select" name="Job_Type">
                    <option value="" disabled="" selected="">-Select-</option>
                    <option value="Full Time" {{ $postData["Job_Type"] == "Full Time" ? 'selected' : '' }}>Full Time</option>
                    <option value="Part Time" {{ $postData["Job_Type"] == "Part Time" ? 'selected' : '' }}>Part Time</option>
                    <option value="Contract" {{ $postData["Job_Type"] == "Contract" ? 'selected' : '' }}>Contract</option>
                    <option value="Temporary" {{ $postData["Job_Type"] == "Temporary" ? 'selected' : '' }}>Temporary</option>
                    <option value="Please Contact" {{ $postData["Job_Type"] == "Please Contact" ? 'selected' : '' }}>Please Contact</option>
                </select>
                <label for="textInput">Ad Title</label>
                <input type="hidden" name="post_id" value="{{ old('title', $postData["post_id"] ) }}">
                <input type="hidden" name="post_category" value="{{ old('title', $postData["post_category"] ) }}">
                <input readonly type="text" id="textInput" class="form-control mb-4" placeholder="Should be populated" name="title" value="{{ old('title', $postData["title"] ) }}">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" rows="4" name="Description">{{ old('title', $postData["Description"] ) }}</textarea>
                </div>
                <label for="textInput">Location:</label>
                <input type="text" id="textInput" class="form-control mb-4" placeholder="" name="Location" placeholder="Toronto" value="{{ old('title', $postData["Location"] ) }}">
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

