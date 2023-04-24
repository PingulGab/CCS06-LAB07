	<?php
	session_start();

    $name = $_SESSION['complete_name'];
	$email = $_SESSION['email'];
	$birthdate = $_SESSION['birthdate'];

	$answers = $_SESSION['answers'];
	$score = $_SESSION['score'];
	$total = count($answers);


	$file = fopen("results.txt", "w");

    fwrite($file, "\n");
	fwrite($file, "Complete Name: $name\n");
	fwrite($file, "Email: $email\n");
	fwrite($file, "Birthdate: $birthdate\n");

	fwrite($file, "Score: $score out of $total\n\n");
	fwrite($file, "Answers:\n");

	$json_file = "questions.json";

	$json_data = file_get_contents($json_file);
	$data_array = json_decode($json_data, true);

	$num_correct = 0;
	$num_questions = 0;

	foreach ($data_array as $question) {
	    $num_questions++;
	    $user_answer = $_SESSION['answers'][$question['number']];
	    $correct_answer = $question['answer'];

	    $qanda = $num_questions . ". " . $user_answer . "\n";
	    fwrite($file, $qanda);

	    if ($user_answer == $correct_answer) {
	        $result = "Correct!";
	        $num_correct++;
	    } else {
	        $result = "Incorrect";
	    }
	    $qanda_result = $result . "\n\n";
	    fwrite($file, $qanda_result);
	}

	fclose($file);

    $_SESSION['filename'] = 'results.txt';

    if (isset($_GET['download']) && $_GET['download'] == 1) {
        $filename = $_SESSION['filename'];
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        readfile($filename);
        exit();
    }
	?>
