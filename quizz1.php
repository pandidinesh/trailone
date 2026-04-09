<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSE Placement Portal | Aptitude & Technical</title>
    <style>
        :root { --primary-color: #003366; --accent-color: #007bff; --bg-color: #f4f7f6; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: var(--bg-color); margin: 0; display: flex; justify-content: center; padding: 20px; }
        .quiz-card { background: white; width: 100%; max-width: 800px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: var(--primary-color); color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; }
        
        /* Dropdown & Start UI */
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #333; }
        select { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; }
        .start-btn { width: 100%; padding: 15px; background: var(--accent-color); color: white; border: none; border-radius: 4px; font-size: 1.1rem; cursor: pointer; font-weight: bold; }
        
        /* Quiz Elements */
        #quiz-area, #result-area, #loader { display: none; }
        .q-info { display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; color: #666; font-size: 0.9rem; }
        .question-text { font-size: 1.25rem; color: #222; margin-bottom: 25px; line-height: 1.6; font-weight: 500; }
        .options-list { display: grid; gap: 10px; }
        .option { padding: 15px; border: 1px solid #ddd; border-radius: 5px; background: #fff; text-align: left; cursor: pointer; transition: 0.2s; font-size: 1rem; }
        .option:hover { background: #e9ecef; border-color: var(--accent-color); }
        
        /* Result Styling */
        .score-circle { width: 120px; height: 120px; border-radius: 50%; border: 5px solid var(--accent-color); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; margin: 20px auto; color: var(--primary-color); }
    </style>
</head>
<body>

<div class="quiz-card">
    <div class="header">
        <h2 style="margin:0">CSE Placement Assessment</h2>
        <p style="margin:5px 0 0; font-size: 0.9rem; opacity: 0.8;">Technical & Aptitude Mock Test</p>
    </div>

    <div class="content">
        <div id="selection-screen">
            <div class="form-group">
                <label>Select Assessment Category (IndiaBIX Style):</label>
                <select id="topic-select">
                    <option value="18">Technical: Computer Science (C, Java, Python, OS)</option>
                    <option value="19">Aptitude: Mathematics & Numerical Ability</option>
                    <option value="logical">Logical Reasoning & Programming Logic</option>
                    <option value="30">Science & Engineering Gadgets</option>
                </select>
            </div>
            <button class="start-btn" onclick="startAssessment()">Generate Random 20 Questions</button>
        </div>

        <div id="loader" style="text-align:center;">
            <p>Fetching real-time placement questions...</p>
        </div>

        <div id="quiz-area">
            <div class="q-info">
                <span id="topic-label">Category</span>
                <span>Question <span id="q-idx">1</span> of 20</span>
            </div>
            <div class="question-text" id="q-text"></div>
            <div class="options-list" id="options-box"></div>
        </div>

        <div id="result-area" style="text-align:center;">
            <h3>Assessment Result</h3>
            <div class="score-circle" id="score-display">0/20</div>
            <p id="performance-msg"></p>
            <button class="start-btn" onclick="location.reload()">Take Another Test</button>
        </div>
    </div>
</div>

<script>
    let questions = [];
    let currentPos = 0;
    let scoreCount = 0;

    async function startAssessment() {
        const selectedVal = document.getElementById('topic-select').value;
        const topicLabel = document.getElementById('topic-select').options[document.getElementById('topic-select').selectedIndex].text;
        
        document.getElementById('selection-screen').style.display = 'none';
        document.getElementById('loader').style.display = 'block';

        let url = "";
        if(selectedVal === "logical") {
            // Mix of Computers and General knowledge for logic
            url = `https://opentdb.com/api.php?amount=20&category=18&type=multiple&difficulty=hard`;
        } else {
            url = `https://opentdb.com/api.php?amount=20&category=${selectedVal}&type=multiple`;
        }

        try {
            const res = await fetch(url);
            const data = await res.json();
            questions = data.results;
            
            document.getElementById('loader').style.display = 'none';
            document.getElementById('quiz-area').style.display = 'block';
            document.getElementById('topic-label').innerText = topicLabel;
            renderQuestion();
        } catch (e) {
            alert("Connection error. Please try again.");
            location.reload();
        }
    }

    function renderQuestion() {
        const data = questions[currentPos];
        const textElement = document.getElementById('q-text');
        const box = document.getElementById('options-box');
        
        // Decode HTML entities (e.g., &quot; to ")
        const decode = (str) => {
            let txt = document.createElement("textarea");
            txt.innerHTML = str;
            return txt.value;
        };

        textElement.innerText = decode(data.question);
        document.getElementById('q-idx').innerText = currentPos + 1;

        // Shuffle answers
        let choices = [...data.incorrect_answers, data.correct_answer];
        choices.sort(() => Math.random() - 0.5);

        box.innerHTML = "";
        choices.forEach(choice => {
            const btn = document.createElement('button');
            btn.className = 'option';
            btn.innerText = decode(choice);
            btn.onclick = () => handleChoice(decode(choice), decode(data.correct_answer));
            box.appendChild(btn);
        });
    }

    function handleChoice(selected, correct) {
        if (selected === correct) scoreCount++;
        
        currentPos++;
        if (currentPos < 20) {
            renderQuestion();
        } else {
            finishQuiz();
        }
    }

    function finishQuiz() {
        document.getElementById('quiz-area').style.display = 'none';
        document.getElementById('result-area').style.display = 'block';
        document.getElementById('score-display').innerText = `${scoreCount}/20`;
        
        let msg = "";
        if(scoreCount >= 16) msg = "Excellent! High chances of clearing the actual exam.";
        else if(scoreCount >= 10) msg = "Good effort, but you need more practice in core areas.";
        else msg = "Focus on fundamentals. Re-attempt the quiz to improve.";
        
        document.getElementById('performance-msg').innerText = msg;
    }
</script>

</body>
</html>