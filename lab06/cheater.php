<!DOCTYPE html>
<html lang="en">

<head>
    <title>Grade Store</title>
    <link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
</head>

<body>

    <?php
		# Ex 4 : 
		# Check the existence of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
    
        # parameter validation
        $params = array("name", "id", "grade", "cardnumber", "cardtype");
        $courses = array("cse326", "cse107", "cse603", "cin870");
        $inputValid = TRUE;
        $nameValid = TRUE;
        $cardValid = TRUE;
        foreach ($params as $p) {
            if (!isset($_POST[$p]) or $_POST[$p] == "") {
                $inputValid = FALSE;
            }
        }
        $courseString = processCheckbox($courses);
        if ($courseString == "") {
            $inputValid = FALSE;
        }
        
        # name validation
        $name = $_POST["name"];
        if (!preg_match("/^[A-Za-z]+[ ]?[A-Za-z]*$/", $_POST["name"])) {
            $nameValid = FALSE;
        }
    
        # card validation
        if (!preg_match("/^\d{16}$/", $_POST["cardnumber"])) {
            $cardValid = FALSE;
        }
        if ($_POST["cardtype"] == "visa") {
            if ($_POST["cardnumber"][0] != 4)
                $cardValid = FALSE;
        }
        if ($_POST["cardtype"] == "mastercard") {
            if ($_POST["cardnumber"][0] != 5)
                $cardValid = FALSE;
        }

        if (!$inputValid) {
		?>

    <!-- Ex 4 : 
            Display the below error message :
        -->
    <h1>Sorry</h1>
    <p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>

    <?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
        } elseif (!$nameValid) {
		?>

    <!-- Ex 5 : 
			Display the below error message : 
        -->
    <h1>Sorry</h1>
    <p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>

    <?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
        } elseif (!$cardValid) {
		?>

    <!-- Ex 5 : 
			Display the below error message : 
        -->
    <h1>Sorry</h1>
    <p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p>

    <?php
		# if all the validation and check are passed 
        } else {
		?>

    <h1>Thanks, looser!</h1>
    <p>Your information has been recorded.</p>

    <!-- Ex 2: display submitted data -->
    <ul>
        <li>Name: <?= $_POST["name"] ?></li>
        <li>ID: <?= $_POST["id"] ?></li>
        <!-- use the 'processCheckbox' function to display selected courses -->
        <li>Course: <?= $courseString ?></li>
        <li>Grade: <?= $_POST["grade"] ?></li>
        <li>Credit Card: <?= "{$_POST["cardnumber"]} ({$_POST["cardtype"]})" ?> </li>
    </ul>

    <!-- Ex 3 : -->
    <p>Here are all the loosers who have submitted here:</p>
    <?php
			$filename = "loosers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
            $targetList = array("name", "id", "cardnumber", "cardtype");
            $newArray = array();
            foreach ($targetList as $target) {
                $newArray[] = $_POST[$target];
            }
            file_put_contents($filename, implode($newArray, ";")."\n", FILE_APPEND);
		?>

    <!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->

    <pre><?= file_get_contents($filename) ?></pre>

    <?php
		}
		?>

    <?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma separation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names) {
                $selectedCourses = array();
                foreach ($names as $course) {
                    if (isset($_POST[$course])) {
                        $selectedCourses[] = strtoupper($course);
                    }
                }
                return implode($selectedCourses, ", ");
            }
		?>

</body>

</html>
