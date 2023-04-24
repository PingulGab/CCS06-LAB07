<?php

require "vendor/autoload.php";

// 4.

use App\QuestionManager;

$score = null;
try {
        if (!isset($_POST['answer'][1])) {
            throw new Exception('Missing answers');
        }

        if (!isset($_POST['answer'][2])) {
            throw new Exception('Missing answers');
        }
        if (!isset($_POST['answer'][3])) {
            throw new Exception('Missing answers');
        }
        if (!isset($_POST['answer'][4])) {
            throw new Exception('Missing answers');
        }
        if (!isset($_POST['answer'][5])) {
            throw new Exception('Missing answers');
        }
        if (!isset($_POST['answer'][6])) {
            throw new Exception('Missing answers');
        }
        if (!isset($_POST['answer'][7])) {
            throw new Exception('Missing answers');
        }
        if (!isset($_POST['answer'][8])) {
            throw new Exception('Missing answers');
        }
        if (!isset($_POST['answer'][9])) {
            throw new Exception('Missing answers');
        }
        if (!isset($_POST['answer'][10])) {
            throw new Exception('Missing answers');
        }
    }

catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
    exit;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Quiz Results</title>
</head>
<body>

<h1> Thank You! </h1>
<?php
require "vendor/autoload.php";

session_start();

$json_file = "questions.json";

$json_data = file_get_contents($json_file);
$data_array = json_decode($json_data, true);

$correct_answers = 0;
$total_questions = count($data_array);

foreach ($data_array as $question_number => $question) {
    $submitted_answer = $_POST['answer'][$question['number']];
    if ($submitted_answer === $question['answer']) {
        $correct_answers++;
    }
}

echo "<h2>Congratulations! " . $_SESSION['complete_name'] . " (" . $_SESSION['email'] . ")" . "</h2>";
echo "<h3>Score: $correct_answers out of $total_questions items</h3>";
?>

<?php

$json_file = "questions.json";

$json_data = file_get_contents($json_file);
$data_array = json_decode($json_data, true);

$num_correct = 0;
$num_questions = 0;

foreach ($data_array as $question) {
    $num_questions++;
    $user_answer = $_POST['answer'][$question['number']];
    $correct_answer = $question['answer'];
    $i = 1;

    echo "<h3>" . $num_questions . ". " . $question['question'] . "</h3>";
    echo "<p>Your answer: " . $user_answer . "</p>";

    if ($user_answer == $correct_answer) {
        echo "<p style='color:green'>Correct!</p>";
        $num_correct++;
    } else {
        echo "<p style='color:red'>Incorrect</p>";
    }
}

?>

</body>
</html>
