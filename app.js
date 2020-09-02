function populate() {
	quiz.questionIndex++;
	if(quiz.isEnded()){
		showScores();
	}
	else {
		document.getElementById("question").innerHTML = quiz.getQuestionByIndex().text;
		var choices=quiz.getQuestionByIndex().choices;
		
		for(var i=0;i<choices.length;i++)
		document.getElementById("btn"+i).style.pointerEvents = "auto";
		
		for(var i=0;i<choices.length;i++) {
			var element=document.getElementById("btn" + i);
			element.style.backgroundColor = "black";
		}
		
		for(var i=0;i<choices.length;i++) {
			var element=document.getElementById("choice" + i);
			element.innerHTML = choices[i];
			guess("btn"+i,i);
		}
		showProgress();
	}
};

function showProgress(){
	var current= quiz.questionIndex+1;
	var element= document.getElementById("progress");
	element.innerHTML = "Question " + current + " of " + questions.length;
}

function guess( id, guess){
	document.getElementById(id).onclick = function(){
		quiz.guess(guess);
	}
	document.getElementById("next").onclick=function(){
			populate();
		}
};

function showScores() {
	var gameOverHtml = "<h1>Result</h1>";
	gameOverHtml += "<h2 id='score'> Your score: " +quiz.getScore() + "</h2>" ;
	

	
	
	var element = document.getElementById("quiz");
	var elements=element.innerHTML;
	element.innerHTML=gameOverHtml;
	var b1 = document.createElement("BUTTON"); 
	b1.textContent = "Take Quiz Again!";
	b1.style.borderRadius='40px';
	b1.style.outline='0';
	b1.classList.add('HoverClass1');
	var attachTo = document.getElementById("quiz");
	attachTo.appendChild(b1);
	b1.onclick = function() {
		quiz.questionIndex=-1;
		var element = document.getElementById("quiz");
		element.innerHTML=elements;
		quiz.resetScore();
		populate();
	}
};

var questions = [
	new Question("Who invented ballpoint pen?", ["Biro Brothers","Waterman Brothers","Bicc Brothers","Write Brothers"],"0"),	
	new Question("The National police Academy is located at?", ["Abu Road","Dehradun","Hyderabad","Bangalore"],"2"),	
	new Question("Which of these is favourite dish of Rohit?", ["rajma chawal","shahi paneer","sev tamatar","chhole"],"1"),	
	new Question("Which industry in India is the maximum consumer of water?", ["textile","engineering","paper and pulp","thermal power"],"3"),	
	new Question("First woman to climb Mount Everest was?", ["chevza chi","Marie Perec","Junko Tabei","Indira Gandhi"],"2")	,
];

var quiz = new Quiz(questions);

populate();

