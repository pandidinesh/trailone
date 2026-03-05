<?php
session_start();

// ------------------ QUESTION BANK ------------------
$question_bank = [
    "Logical Reasoning" => [
        "If ALL CATS are MAMMALS, and SOME MAMMALS are DOGS, can we conclude that SOME CATS are DOGS?" => [["Yes","No","Cannot be determined","None"], "Cannot be determined"],
        "Find the next number: 2, 6, 12, 20, 30, ?" => [["36","40","42","50"], "42"],
        "If A>B and B>C, which is true?" => [["A>C","C>A","A=B","Cannot say"], "A>C"],
        "Which comes next in the sequence: 1, 4, 9, 16, 25, ?" => [["30","35","36","40"], "36"],
        "If the day after tomorrow is two days before Thursday, what day is today?" => [["Monday","Tuesday","Wednesday","Friday"], "Monday"],
        "In a row of 10 boys, A is 5th from left, B is 3rd from right. How many boys are between A and B?" => [["1","2","3","4"], "2"],
        "All roses are flowers. Some flowers fade quickly. Can we say some roses fade quickly?" => [["Yes","No","Cannot be determined","None"], "Cannot be determined"],
        "Which number is odd one out: 16, 36, 49, 64?" => [["16","36","49","64"], "49"],
        "If MANGO is coded as 51437, how is APPLE coded?" => [["15523","11152","15123","15234"], "15123"],
        "A is taller than B. B is taller than C. Who is shortest?" => [["A","B","C","Cannot say"], "C"],
        "If the first two statements are true, is the third true? All cats are mammals. All mammals breathe. All cats breathe." => [["True","False","Cannot say","None"], "True"],
        "Complete the series: 2, 6, 12, 20, 30, ?" => [["36","42","40","48"], "42"],
        "A is mother of B. C is daughter of B. What is C to A?" => [["Granddaughter","Daughter","Sister","Cannot say"], "Granddaughter"],
        "Find next number: 5, 10, 20, 40, ?" => [["70","80","90","100"], "80"],
        "If Monday is coded as 123456, how is Friday coded?" => [["654321","135246","543216","132645"], "543216"],
        "If P+Q means P is brother of Q; P-Q means P is sister of Q; P*Q means P is father of Q. What does A+B*C mean?" => [["A is brother of C","A is father of C","A is sister of C","Cannot say"], "A is brother of C"],
        "Find missing number: 3, 8, 15, 24, 35, ?" => [["46","48","49","50"], "48"],
        "If a train travels 60 km in 1.5 hours, its speed is?" => [["40 km/h","50 km/h","60 km/h","45 km/h"], "40 km/h"],
        "Which comes next: 2, 4, 8, 16, ?" => [["18","24","32","30"], "32"],
        "All squares are rectangles. Some rectangles are not squares. True or false?" => [["True","False","Cannot say","None"], "True"]
    ],
    "Technical" => [
        "What is the binary of decimal 25?" => [["10101","11001","11101","10011"], "11001"],
        "Which HTML tag is used to create a link?" => [["<link>","<a>","<href>","<ul>"], "<a>"],
        "Which data structure uses FIFO?" => [["Stack","Queue","Tree","Graph"], "Queue"],
        "Which language is primarily used for Android development?" => [["Python","Java","C++","Swift"], "Java"],
        "In CSS, which property changes text color?" => [["font-color","color","text-color","text-style"], "color"],
        "Which protocol is used to send emails?" => [["HTTP","SMTP","FTP","SSH"], "SMTP"],
        "Which is NOT a programming language?" => [["Python","Ruby","HTML","C"], "HTML"],
        "What does SQL stand for?" => [["Structured Query Language","Simple Query Language","Standard Question Language","Sequential Query Language"], "Structured Query Language"],
        "Which operator is used for exponentiation in PHP?" => [["^","**","pow()","%"], "**"],
        "Which HTTP method is used to update resources?" => [["GET","POST","PUT","DELETE"], "PUT"],
        "Which data structure allows LIFO operations?" => [["Queue","Stack","Graph","Tree"], "Stack"],
        "What does 'git commit' do?" => [["Deletes files","Saves changes","Uploads repo","Checks status"], "Saves changes"],
        "Which HTML attribute is used for inline CSS?" => [["style","class","id","css"], "style"],
        "Which tag is used for table row in HTML?" => [["<tr>","<td>","<table>","<th>"], "<tr>"],
        "Which is a NoSQL database?" => [["MySQL","MongoDB","PostgreSQL","Oracle"], "MongoDB"],
        "Which language is server-side scripting?" => [["PHP","HTML","CSS","JavaScript"], "PHP"],
        "Which is used for version control?" => [["Docker","Git","Linux","Node.js"], "Git"],
        "Which tag is used for image in HTML?" => [["<img>","<image>","<picture>","<src>"], "<img>"],
        "Which CSS property adjusts spacing between letters?" => [["letter-spacing","word-spacing","line-height","text-indent"], "letter-spacing"],
        "Which language is used for iOS apps?" => [["Swift","Python","Java","C#"], "Swift"],
        "What is the full form of IDE?" => [["Integrated Development Environment","Internal Development Engine","Integrated Device Editor","Internal Debugging Environment"], "Integrated Development Environment"],
        "Which HTML tag creates an unordered list?" => [["<ul>","<ol>","<li>","<list>"], "<ul>"],
        "Which operator is used for concatenation in PHP?" => [[".","+","&","*"], "."],
        "Which tag is used for table heading in HTML?" => [["<tr>","<td>","<th>","<table>"], "<th>"],
        "Which protocol is used for web page transfer?" => [["FTP","HTTP","SMTP","SSH"], "HTTP"],
        "Which is a frontend framework?" => [["Laravel","React","Django","Spring"], "React"],
        "Which command shows git status?" => [["git status","git show","git check","git commit"], "git status"],
        "Which SQL command retrieves data?" => [["SELECT","INSERT","UPDATE","DELETE"], "SELECT"],
        "Which HTML element is for paragraph?" => [["<p>","<para>","<paragraph>","<text>"], "<p>"],
        "Which CSS property changes background color?" => [["bgcolor","color","background-color","back-color"], "background-color"]
    ],
    "Numerical Reasoning" => [
        "If 5x + 3 = 18, find x." => [["2","3","5","15"], "3"],
        "Find LCM of 12 and 18." => [["36","54","72","12"], "36"],
        "What is 15% of 200?" => [["20","25","30","35"], "30"],
        "Solve: 7*6-4*5+10 = ?" => [["22","32","24","28"], "22"],
        "If a=b and b=c, then a=c?" => [["Yes","No","Cannot say","Sometimes"], "Yes"],
        "The average of 5 numbers is 20. Sum of numbers?" => [["80","100","120","90"], "100"],
        "Find missing number: 3, 8, 15, 24, 35, ?" => [["46","48","49","50"], "48"],
        "If 3/4 of a number is 18, number = ?" => [["24","22","26","20"], "24"],
        "Simplify: 5/6 + 7/12" => [["3/2","4/3","5/4","1"], "3/2"],
        "Speed = 180 km in 3 hours. Find speed?" => [["50","60","55","45"], "60"],
        "Average of 10,20,30,40?" => [["25","20","30","35"], "25"],
        "Find missing: 11, 21, 31, ?, 51" => [["36","41","42","40"], "41"],
        "If x^2=49, x=?" => [["7","-7","Both 7 and -7","0"], "Both 7 and -7"],
        "Convert 2.5 hours to minutes" => [["120","150","160","180"], "150"],
        "Find HCF of 48 and 60" => [["12","6","24","18"], "12"],
        "Average of 12,14,16,18?" => [["15","16","14","13"], "15"],
        "If 20% of 500=? " => [["80","90","100","120"], "100"],
        "Find missing: 2, 5, 10, 17, 26, ?" => [["36","37","38","39"], "37"],
        "If x-7=10, x=?" => [["17","16","15","14"], "17"],
        "Find LCM of 8,12" => [["24","36","32","40"], "24"],
        "Simplify: 7/8+1/4" => [["9/8","8/8","10/8","7/8"], "9/8"],
        "If 50% of x=30, x=?" => [["50","60","40","45"], "60"],
        "If 2x+3=11, x=?" => [["4","5","3","6"], "4"]
    ]
];

// ------------------ HANDLE USER INPUT FOR QUESTION COUNT ------------------
$question_counts = null;
if(isset($_POST['set_questions'])){
    $question_counts = [
        "Logical Reasoning" => min(intval($_POST['logical']), count($question_bank['Logical Reasoning'])),
        "Technical" => min(intval($_POST['technical']), count($question_bank['Technical'])),
        "Numerical Reasoning" => min(intval($_POST['numerical']), count($question_bank['Numerical Reasoning']))
    ];
}

// ------------------ GENERATE QUIZ ------------------
$quiz_list = [];
if($question_counts){
    foreach($question_counts as $topic => $count){
        $qs = $question_bank[$topic];
        $qs_keys = array_keys($qs);
        shuffle($qs_keys);
        $selected = array_slice($qs_keys, 0, $count);
        foreach($selected as $q){
            $quiz_list[] = [
                "topic" => $topic,
                "question" => $q,
                "options" => $qs[$q][0],
                "answer" => $qs[$q][1]
            ];
        }
    }
    shuffle($quiz_list);
}

// ------------------ HANDLE QUIZ SUBMISSION ------------------
$score = null;
if(isset($_POST['submit'])){
    $score = 0;
    foreach($quiz_list as $i => $q){
        if(isset($_POST["q$i"]) && $_POST["q$i"] == $q['answer']){
            $score++;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Custom Hard Aptitude Quiz</title>
    <style>
        body { font-family: Arial; background-image:url("https://img.freepik.com/free-psd/3d-rendering-questions-background_23-2151455632.jpg?semt=ais_hybrid&w=740&q=80"); padding: 20px;}
        .quiz-box { background: #fff; padding: 20px; border-radius: 10px; max-width: 950px; margin: auto; box-shadow: 0 0 10px #aaa;}
        h2 { text-align: center; }
        .question { margin-bottom: 15px; }
        .option { margin-left: 20px; }
        input[type=submit]{ padding: 10px 20px; margin-top: 15px; font-size:16px;}
        .score{ background: #d4edda; padding: 10px; border-radius:5px; margin-top: 15px; text-align:center;}
        .topic { font-style: italic; color: #555; }
        .user-input { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="quiz-box">
    <h2>Aptitude Quiz</h2>

    <?php if(!$question_counts): ?>
        <form method="POST" class="user-input">
            Logical Reasoning (max <?= count($question_bank['Logical Reasoning']) ?>): <input type="number" name="logical" value="20" min="1" max="<?= count($question_bank['Logical Reasoning']) ?>"><br><br>
            Technical (max <?= count($question_bank['Technical']) ?>): <input type="number" name="technical" value="30" min="1" max="<?= count($question_bank['Technical']) ?>"><br><br>
            Numerical Reasoning (max <?= count($question_bank['Numerical Reasoning']) ?>): <input type="number" name="numerical" value="50" min="1" max="<?= count($question_bank['Numerical Reasoning']) ?>"><br><br>
            <input type="submit" name="set_questions" value="Start Quiz">
        </form>
    <?php else: ?>
        <form method="POST">
            <?php foreach($quiz_list as $i => $q): ?>
                <div class="question">
                    <span class="topic">(<?= $q['topic'] ?>)</span><br>
                    <strong>Q<?= $i+1 ?>. <?= $q['question'] ?></strong><br>
                    <?php foreach($q['options'] as $opt): ?>
                        <label class="option">
                            <input type="radio" name="q<?= $i ?>" value="<?= $opt ?>"> <?= $opt ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <input type="submit" name="submit" value="Submit Quiz">
        </form>

        <?php if($score !== null): ?>
            <div class="score">
                You scored <?= $score ?>/<?= count($quiz_list) ?> ✅
            </div>
            <h3>Correct Answers:</h3>
            <ul>
                <?php foreach($quiz_list as $i => $q): ?>
                    <li>Q<?= $i+1 ?>: <?= $q['answer'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>