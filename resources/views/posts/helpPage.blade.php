<?php
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.content').hide();
            $('#dropdown').change(function(){
                $('.content').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Help | Share Square</title>
</head>
<body>
<header>
</header>
<main>
    <div class="border border-light p-5">
        {{ csrf_field() }}
        <div class="form-row justify-content-center align-items-center">
            <div class="col-5">
                <label for="textInput">About:</label>
                <select class="browser-default custom-select mb-4" id="dropdown">
                    <option value="0" disabled="" selected="">Select your need</option>
                    <option value="New">How to add new Post</option>
                    <option value="Edit">How to edit your Post</option>
                    <option value="Delete">How to delete your Post</option>
                    <option value="Promote">How to promote your Post</option>
                </select>
                <div id="New" class="content">
                <p>Posting an ad on Share Square is quick and hassle-free! Before you create your ad, ensure you have signed into your registered Share Square account by selecting <b>Sign In</b>. If you are an unregistered Share square user, you can register an account easily prior to posting.</p>

                <p><b>To post an ad:</b></p>

                <table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">1</td><td colspan="1" rowspan="1"><span rowspan="1" style="color: rgb(51, 51, 51);">Select the <b>Post Ad </b>button found at the top of Share square.</span></td></tr></tbody></table>
                <span style=""><div class="divider-x"></div></span>

                <table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">2</td><td colspan="1" rowspan="1"><span rowspan="1" style="color: rgb(51, 51, 51);">Type in the title you’d like to use for your ad and click <b>Next</b>.</span></td></tr></tbody></table>
                <span style=""><div class="divider-x"></div></span>

                <table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">3</td><td colspan="1" rowspan="1"><span rowspan="1" style="color: rgb(51, 51, 51);">Depending on your title, we may suggest a category that would be appropriate for your ad. You can select one of the suggestions or choose a main category and sub-category (if required) from the list below.<br>			<br>			If you’re posting an ad in Services, Real Estate, Jobs, Used Cars &amp; Trucks or Vacation Rentals, you’ll have the opportunity to choose a Visibility Package. You can simply post your ad as you normally would, or you can choose a plan which includes features, to maximize your ad’s exposure in the listings.</span></td></tr></tbody></table>
                <span style=""><div class="divider-x"></div></span>

                <table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">4</td><td colspan="1" rowspan="1"><span rowspan="1" style="color: rgb(51, 51, 51);">After selecting your category, you will be directed to the <b>Post Your Ad</b> page where you can enter your ad’s details including price, description, images &amp; video and choose additional features for increased exposure.<br>			<br>			To post a Wanted ad: select <b>I Want</b> under Ad Type.<br>			<br>			To post as Free or Swap/ Trade: select a price of <b>Free </b>or<b> Swap / Trade</b>. <b>Please note:</b> only items that are being offered for free, with no additional stipulations, are permitted to be posted in this manner.</span></td></tr></tbody></table>
                <span style=""><div class="divider-x"></div></span>

                <table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">5</td><td colspan="1" rowspan="1"><span rowspan="1" style="color: rgb(51, 51, 51);">Your location will default to show a general area instead of your exact street address. If you’d like your exact street address shown publicly, please check the “<b>Show my exact location</b>” box after entering your address. If your address or postal code isn’t showing the area you’d like to post within, <a href="https://help.kijiji.ca/helpdesk/technical-issue/my-ad-s-location-is-wrong" target="_blank">click here to learn more about changing locations</a>.</span></td></tr></tbody></table>
                <span style=""><div class="divider-x"></div></span>

                <table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">6</td><td colspan="1" rowspan="1"><span rowspan="1" style="color: rgb(51, 51, 51);">Once you’ve filled in all relevant details, click <b>Post Your Ad</b> at the bottom of the page.</span></td></tr></tbody></table>
                <span style=""><div class="divider-x"></div></span></span>
            </div>
                <div id="Edit" class="content">
                    <p>Never fear! Almost any part of your ad can be edited with only a few clicks. <a href="https://help.kijiji.ca/helpdesk/basics/editing-my-ad" target="_blank">To learn how to edit your ad, click here</a>.</p>


                    <h2><span style="font-size: 18px;"><b>What Can’t Be Edited</b></span></h2>

                    <p>There are 4 parts of an ad that cannot be edited once it has been posted on the site. Here’s how to deal with each of those sections:</p>

                    <h3 style="margin-left: 40px;"><span style="font-size: 15px;"><b>Category</b></span></h3>

                    <p style="margin-left: 40px;">The type of information we request changes in each category. Due to this, it can’t be altered after an ad is created. If you’ve posted in the incorrect category, you will need to delete and repost your ad.</p>

                    <h3 style="margin-left: 40px;"><span style="font-size: 15px;"><b>Offering vs Wanted</b></span></h3>

                    <p style="margin-left: 40px;">If you’ve accidentally posted as a Wanted ad instead of an Offering ad, or vice versa, you will need to delete and repost the ad.</p>

                    <h3 style="margin-left: 40px;"><span style="font-size: 15px;"><b>Search Results Location</b></span></h3>

                    <p style="margin-left: 40px;">Once an ad has been posted, it’s locked into that location. If you need to change it after posting, you’ll need delete and repost the ad. Before you do, <a href="https://help.kijiji.ca/helpdesk/technical-issue/my-ad-s-location-is-wrong" target="_blank">click here to learn more about locations</a>.</p>

                    <h3 style="margin-left: 40px;"><span style="font-size: 15px;"><b>Poster’s Email</b></span></h3>

                    <p style="margin-left: 40px;">There is no way to move an ad from one Kijiji account to another. To change the email that is linked to your ad, you will need to change the email linked to your entire account. <a href="https://help.kijiji.ca/helpdesk/basics/changing-my-email-address" target="_blank">For instructions editing your account email, click here.</a></p>

                    <p style="margin-left: 40px;">To post an ad under a different registered Kijiji account, you will need to delete the ad and repost it after logging into the correct account.</p>


                    <h2><span style="font-size: 18px;"><b>Unable to Edit Price, and Other Editing Issues</b></span></h2>

                    <p>If you’re having trouble editing a section of your ad not mentioned in the list above, it may be due to the information that you’re trying to enter. <a href="https://help.kijiji.ca/helpdesk/technical-issue/why-can-t-i-post" target="_blank">Click here for issues editing price, kilometers, or other similar fields</a>.</p></span>
                </div>
                <div id="Delete" class="content">
                    <p>To delete an ad, please follow these steps:</p>

                    <table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">1</td><td colspan="1" rowspan="1">Click the <b>Navigation Menu</b> button (appears as a person icon, K icon, or your profile photo).</td></tr></tbody></table>
                    <div class="divider-x"></div>

                    <table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">2</td><td colspan="1" rowspan="1">From the drop-down menu, select <b>My Ads</b>. Click <b>Delete</b> next to the ad you would like to remove.</td></tr></tbody></table>
                    <div class="divider-x"></div>

                    <p>Don’t get someone’s hopes up! Please remember to delete your ad if it’s no longer current.</p></span>
                </div>
            <div id="Promote" class="content">
<p>Want more eyes on your ad? Here’s how to make it happen!</p>

<table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">1</td><td colspan="1" rowspan="1">Click the <b>Navigation Menu</b> button (appears as a person icon, K icon, or your profile photo) and select <b>My Ads</b>.</td></tr></tbody></table>
<div class="divider-x"></div>

<table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">2</td><td colspan="1" rowspan="1">Find the ad you’d like to promote and click <b>Get More Views</b>. From this section you can read about what each feature offers, review pricing, and select the feature you want by clicking the <b>+</b> button.</td></tr></tbody></table>
<div class="divider-x"></div>

<table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">3</td><td colspan="1" rowspan="1">When you&#39;re happy with your selection, click <b>Checkout</b>.</td></tr></tbody></table>
<div class="divider-x"></div>

<table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">4</td><td colspan="1" rowspan="1">Enter your billing address and click <b>Save and Proceed</b>.</td></tr></tbody></table>
<div class="divider-x"></div>

<table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">5</td><td colspan="1" rowspan="1">Under the heading “Your Order”, you will see your total order and the final price. Please review this carefully before proceeding.</td></tr></tbody></table>
<div class="divider-x"></div>

<table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">6</td><td colspan="1" rowspan="1">The payment screen defaults to credit card. To pay by Visa or Mastercard, enter your card details. If you’d like to pay through PayPal, click the <b>Pay With PayPal</b> option to bring you to PayPal’s website. Follow the instructions there.</td></tr></tbody></table>
<div class="divider-x"></div>

<table border="0" style="width: 95%;"><tbody><tr><td colspan="1" rowspan="1" style="width: 50px; text-align: center;">7</td><td colspan="1" rowspan="1">Click <b>Pay Now</b> and your ad will be processed.</td></tr></tbody></table>
<div class="divider-x"></div>

<p><b>Note:</b> Some features can be purchased for 3, 7 or 30 days. Once selected, the price will update accordingly. To learn more about features, <a href="/helpdesk/basics/benefits-of-promoting-ads" target="_blank">read our Benefits of Promoting Ads article</a>.</p></span>
            </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</main>
<footer>
</footer>
</body>
</html>
