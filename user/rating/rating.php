<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Title Page-->
    <title>ONE CART</title>

    

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">




</head>

<body>


<svg style="display: none">
	<symbol id="star" viewBox="0 0 1024 1024">
		<polygon points="512 0 627 354 999 354 698 572 813 926 512 708 211 926 326 572 25 354 397 354 512 0" />
	</symbol>
</svg>

<div id="modal">
	<div class="overlay">
		<br><br><br><br><br>
		<div class="feedback container--small align--center">
			<button id="close">Close</button>
			<h1 class="feedback__title">How did we do?</h1>
			<p class="feedback__description">Please let us know how your food delivery was.<br> It will really help us to keep improving our service!</p>
                    <form method="POST" action="signup_db.php">
                    <fieldset class="rating rating__plan">
					<legend>How would you rate your food?</legend>
					<div class="flex-container">
						<input type="radio" id="plan-5" name="rating__plan" value="5">
						<label for="plan-5"><svg>
								<title>Five Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="plan-4" name="rating__plan" value="4">
						<label for="plan-4"><svg>
								<title>Four Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="plan-3" name="rating__plan" value="3">
						<label for="plan-3"><svg>
								<title>Three Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="plan-2" name="rating__plan" value="2">
						<label for="plan-2"><svg>
								<title>Two Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="plan-1" name="rating__plan" value="1">
						<label for="plan-1"><svg>
								<title>One Star</title>
								<use xlink:href="#star"></use>
							</svg></label>
					</div>
				</fieldset>

				<fieldset class="rating rating__staff">
					<legend>How would you rate your delivery driver?</legend>
					<div class="flex-container">
						<input type="radio" id="staff-5" name="rating__staff" value="5">
						<label for="staff-5"><svg>
								<title>Five Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="staff-4" name="rating__staff" value="4">
						<label for="staff-4"><svg>
								<title>Four Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="staff-3" name="rating__staff" value="3">
						<label for="staff-3"><svg>
								<title>Three Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="staff-2" name="rating__staff" value="2">
						<label for="staff-2"><svg>
								<title>Two Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="staff-1" name="rating__staff" value="1">
						<label for="staff-1"><svg>
								<title>One Star</title>
								<use xlink:href="#star"></use>
							</svg></label>
					</div>
				</fieldset>

				<fieldset class="rating rating__food">
					<legend>How would you rate your overall experience?</legend>

				<div class="flex-container">
						<input type="radio" id="food-5" name="rating__food" value="5">
						<label for="food-5"><svg>
								<title>Five Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="food-4" name="rating__food" value="4">
						<label for="food-4"><svg>
								<title>Four Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="food-3" name="rating__food" value="3">
						<label for="food-3"><svg>
								<title>Three Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="food-2" name="rating__food" value="2">
						<label for="food-2"><svg>
								<title>Two Stars</title>
								<use xlink:href="#star"></use>
							</svg></label>
						<input type="radio" id="food-1" name="rating__food" value="1">
						<label for="food-1"><svg>
								<title>One Star</title>
								<use xlink:href="#star"></use>
							</svg></label>
					</div>
				</fieldset>
                        <button class="feedback__submit" type="submit" >Submit feedback</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
    
   

</body>

</html>
<!-- end document-->