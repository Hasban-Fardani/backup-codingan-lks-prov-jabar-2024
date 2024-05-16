<?php
$fileActualAnswer = file_get_contents('./ActualAnswers.csv');
$actualAnswers = json_encode($fileActualAnswer);
$actualAnswers = explode('\r\n', $actualAnswers);

// remove tanda petik 
$actualAnswers[0] = $actualAnswers[0][1];
$actualAnswers[count($actualAnswers) - 1] = $actualAnswers[count($actualAnswers) - 1][0];


$fileSubmittedAnswer = file_get_contents('./SubmittedAnswers.csv');
$submmitedAnswers = json_encode($fileSubmittedAnswer);
$submmitedAnswers = explode('\r\n', $submmitedAnswers);

// remove tanda petik 
$submmitedAnswers[0] = $submmitedAnswers[0][1];
$submmitedAnswers[count($submmitedAnswers) - 1] = $submmitedAnswers[count($submmitedAnswers) - 1][0];

$score = 0;

for ($i=0; $i < count($actualAnswers); $i++) { 
    if ($actualAnswers[$i] == $submmitedAnswers[$i]) {
        $score++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E1 - Answer checker</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Questions</th>
                <th>Actual Answers</th>
                <th>Submitter Answers</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($actualAnswers); $i++):?>
            <tr>
                <td>
                    <?php echo $i + 1?>
                </td>
                <td>
                    <?php echo $actualAnswers[$i]?>
                </td>
                <td>
                    <?php echo $submmitedAnswers[$i]?>
                </td>
            </tr>
            <?php endfor?>
        </tbody>
    </table>

    <?php echo "Score :" . $score . "/" . count($actualAnswers) ?>
</body>
</html>