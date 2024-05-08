var Question = function (questionObj) {
  this.value = {
    text: "Question",
    answers: []
  };

  this.selectedAnswer = null;
  this.html = null;
  this.questionText = null;
  this.questionAnswers = null;
  this.questionFeedback = null;

  this.value = Object.assign(this.value, questionObj);

  this.onQuestionAnswered = ({ detail }) => {
    this.selectedAnswer = {
      value: detail.answer,
      html: detail.answerHtml
    };
    this.update();

    document.dispatchEvent(
      new CustomEvent("question-answered", {
        detail: {
          question: this,
          answer: detail.answer
        }
      })
    );
  };

  this.create = function () {
    this.html = document.createElement("div");
    this.html.classList.add("question");

    this.questionText = document.createElement("h2");
    this.questionText.textContent = this.value.text;

    this.questionAnswers = document.createElement("div");
    this.questionAnswers.classList.add("answers");

    for (let i = 0; i < this.value.answers.length; i++) {
      const ansObj = this.value.answers[i];
      let answer = createAnswer(ansObj);

      answer.onclick = (ev) => {
        if (this.selectedAnswer !== null) {
          this.selectedAnswer.html.classList.remove("selected");
        }

        answer.classList.add("selected");

        this.html.dispatchEvent(
          new CustomEvent("question-answered", {
            detail: {
              answer: ansObj,
              answerHtml: answer
            }
          })
        );
      };

      this.questionAnswers.appendChild(answer);
    }

    this.questionFeedback = document.createElement("div");
    this.questionFeedback.classList.add("question-feedback");

    this.html.appendChild(this.questionText);
    this.html.appendChild(this.questionAnswers);
    this.html.appendChild(this.questionFeedback);

    this.html.addEventListener("question-answered", this.onQuestionAnswered);

    return this.html;
  };

  this.disable = function () {
    this.html.classList.add("disabled");
    this.html.onclick = (ev) => {
      ev.stopPropagation();
    };

    this.html.removeEventListener("question-answered", this.onQuestionAnswered);

    let answers = this.html.querySelectorAll(".answer");
    for (let i = 0; i < answers.length; i++) {
      let answer = answers[i];
      answer.onclick = null;
    }
  };

  this.remove = function () {
    let children = this.html.querySelectorAll("*");
    for (let i = 0; i < children.length; i++) {
      const child = children[i];
      this.html.removeChild(child);
    }

    this.html.removeEventListener("question-answered", this.onQuestionAnswered);

    this.html.parentNode.removeChild(this.html);
    this.html = null;
  };

  this.update = function () {
    let correctFeedback, incorrectFeedback;
    this.html = this.html || document.createElement("div");

    correctFeedback = "Bien joué le zin";
    incorrectFeedback = "Non frero";

    if (this.selectedAnswer !== null) {
        if (this.selectedAnswer.value.isCorrect) {
            this.html.classList.add("correct");
            this.html.classList.remove("incorrect");
            this.questionFeedback.innerHTML = correctFeedback;

            // Ajoutez la classe de grossissement pour l'animation
            scoreContainer.classList.add("grow");

            // Supprimez la classe de grossissement après un délai (par exemple, 1 seconde)
            setTimeout(() => {
                scoreContainer.classList.remove("grow");
            }, 1000);
        } else {
            this.html.classList.add("incorrect");
            this.html.classList.remove("correct");
            this.questionFeedback.innerHTML = incorrectFeedback;

            // Ajoutez la classe de clignotement pour l'animation
            scoreContainer.classList.add("blink");

            // Supprimez la classe de clignotement après un délai (par exemple, 1 seconde)
            setTimeout(() => {
                scoreContainer.classList.remove("blink");
            }, 1000);
        }
    }
};




  function createAnswer(obj) {
    this.value = {
      text: "Answer",
      isCorrect: false
    };

    this.value = Object.assign(this.value, obj);

    this.html = document.createElement("button");
    this.html.classList.add("answer");

    this.html.textContent = this.value.text;

    return this.html;
  }
};

//
// Questions
//

let questionsData = [
  {
    text: "De quel groupe faisait-il parti ?",
    answers: [
      {
        text: "1995",
        isCorrect: false
      },
      {
        text: "Panama Bende",
        isCorrect: true
      },
      {
        text: "Scred Connexion",
        isCorrect: false
      },
      {
        text: "Collectif Metissé",
        isCorrect: false
      }
    ]
  },
  {
    text: "Avec qui il n'a jamais collaboré ?",
    answers: [
      {
        text: "34 Murphy",
        isCorrect: true
      },
      {
        text: "Samou Skuu",
        isCorrect: false
      },
      {
        text: "Venom",
        isCorrect: false
      },
      {
        text: "PLK",
        isCorrect: false
      }
    ]
  },
  {
    text: "A quel politicien fait-il référence dans un de ces sons ? ",
    answers: [
      {
        text: "Gerald Darmanin",
        isCorrect: false
      },
      {
        text: 'Eric Zemmour',
        isCorrect: false
      },
      {
        text: "Christophe Castaner",
        isCorrect: true
      },
      {
        text: "Nicolas Sarkozy",
        isCorrect: false
      }    
      
    ]
  },
  {
    text: "Quel est son Top Titre le plus ecouté sur Deezer ?",
    answers: [
      {
        text: "BVB",
        isCorrect: true
      },
      {
        text: "Decepticons",
        isCorrect: false
      },
      {
        text: "Haaland",
        isCorrect: false
      },
      {
        text: "Opp Block",
        isCorrect: false
      }
    ]
  },
  {
    text: "Quel est le nom de son premier album/EP ?",
    answers: [
      {
        text: "Watergate",
        isCorrect: false
      },
      {
        text: "Butterfly Doors",
        isCorrect: false
      },
      {
        text: "Trashtalking",
        isCorrect: true
      },
      {
        text: "Boss Orders",
        isCorrect: false
      }
    ]
  }
];


let questions = [];
let score = 0,
  answeredQuestions = 0;
let appContainer = document.getElementById("questions-container");
let scoreContainer = document.getElementById("score-container");
scoreContainer.innerHTML = `Score: ${score}/${questionsData.length}`;

/**
 * Shuffles array in place. ES6 version
 * @param {Array} arr items An array containing the items.
 */
function shuffle(arr) {
  for (let i = arr.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [arr[i], arr[j]] = [arr[j], arr[i]];
  }
}

shuffle(questionsData);

// questions
for (var i = 0; i < questionsData.length; i++) {
  let question = new Question({
    text: questionsData[i].text,
    answers: questionsData[i].answers
  });

  appContainer.appendChild(question.create());
  questions.push(question);
}

document.addEventListener("question-answered", ({ detail }) => {
  if (detail.answer.isCorrect) {
    score++;
  }

  answeredQuestions++;
  scoreContainer.innerHTML = `Score: ${score}/${questions.length}`;
  detail.question.disable();

  // Vérifie si toutes les questions ont été répondues
  if (answeredQuestions === questions.length) {
    // Toutes les questions ont été répondues, affichez une alerte avec le score obtenu
    const scorePercentage = (score / questions.length) * 100;

    // Créer l'élément d'alerte
    const alertElement = document.createElement("div");
    alertElement.classList.add("alert", "active");
    alertElement.textContent = `Toutes les questions ont été répondues!\nScore: ${score}/${questions.length} (${scorePercentage.toFixed(2)}%)`;

    // Ajouter l'alerte à la page
    document.body.appendChild(alertElement);

    // Supprimer l'alerte après quelques secondes (par exemple, 5 secondes)
    setTimeout(() => {
      alertElement.classList.remove("active");
      document.body.removeChild(alertElement);
    }, 5000);
  }
});

console.log(questions, questionsData);