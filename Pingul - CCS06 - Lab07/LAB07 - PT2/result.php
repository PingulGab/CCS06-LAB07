<?php

require "vendor/autoload.php";

session_start();

use App\QuestionManager;

$score = null;
try {
    $manager = new QuestionManager;
    $manager->initialize();

    if (!isset($_SESSION['answers'])) {
        throw new Exception('Missing answers');
    }
    $score = $manager->computeScore($_SESSION['answers']);
} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
    exit;
}

function displayAnswers($questions, $answers) {
    foreach ($questions as $i => $question) {
        $answer = isset($answers[$i]) ? $answers[$i] : '';
        $isCorrect = $answer === $question['answer'];
        echo '<p>';
        echo 'Question ' . ($i+1) . ': ' . $question['text'] . '<br>';
        echo 'Your answer: ' . $answer . '<br>';
        echo 'Correct answer: ' . $question['answer'] . '<br>';
        echo 'Result: ' . ($isCorrect ? 'Correct' : 'Incorrect') . '<br>';
        echo '</p>';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
</head>
<body>

<h1> Thank You! </h1>

<?php
echo "<h2>Congratulations! " . $_SESSION['complete_name'] . " (" . $_SESSION['email'] . ")" . "</h2>";
?>
<h3>  Score: <?php echo $score; ?> out of <?php echo $manager->getQuestionSize() ;?> items</h3>

<?php

$json_file = "questions.json";

$json_data = file_get_contents($json_file);
$data_array = json_decode($json_data, true);

$num_correct = 0;
$num_questions = 0;

foreach ($data_array as $question) {
    $num_questions++;
    $user_answer = $_SESSION['answers'][$question['number']];
    $correct_answer = $question['answer'];
    $i = 1;

    echo "<p>" . $num_questions . ". " . $user_answer . "</p>";

    if ($user_answer == $correct_answer) {
        echo "<p style='color:green'>Correct!</p>";
        $num_correct++;
    } else {
        echo "<p style='color:red'>Incorrect</p>";
    }
}
$_SESSION['score'] = $score;
?>

<a href="download.php?download=1">Download Results</a>

</body>
</html>