function Quiz(questions) {
	this.questions = questions;
	this.questionIndex = -1;
	let score = 0;
	
	this.guess = function(answer) {
	var choices=this.getQuestionByIndex().choices;
	if(this.getQuestionByIndex().correctAnswer(answer)) {
		score++;
		document.getElementById("btn"+answer).style.backgroundColor="#008000";
		}
		else {
			document.getElementById("btn"+answer).style.backgroundColor="#FF0000";
			var ans=this.getQuestionByIndex().answer;
			document.getElementById("btn"+ans).style.backgroundColor="#008000";
		}
		for(var i=0;i<choices.length;i++)
		document.getElementById('btn'+i).style.pointerEvents = 'none';
	
}
	this.getScore = function(){
		return score;
	}
	this.resetScore = function(){
		score=0;
	}
}

Quiz.prototype.getQuestionByIndex = function() {
	return this.questions[this.questionIndex];
}

Quiz.prototype.isEnded = function() {
	return this.questions.length === this.questionIndex ;
}

