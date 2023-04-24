<?php

require "vendor/autoload.php";

session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quiz</title>
</head>
<body>

<form action="result.php" method="POST">
<?php

$json_file = "questions.json";

$json_data = file_get_contents($json_file);
$data_array = json_decode($json_data, true);

foreach ($data_array as $question_number => $question) {
    echo "<h3>" . ($question_number+1) . ". " . $question['question'] . "</h3>";
    foreach ($question['choices'] as $choice) {
        echo '<label>';
        echo '<input type="radio" name="answer[' . $question['number'] . ']" value="' . $choice['letter'] . '">';
        echo $choice['letter'] . ') ' . $choice['label'];
        echo '</label>';
    }
}
?>
<br>
<br>
<input type="submit" value="Submit Quiz">
</form>

</body>
</html>