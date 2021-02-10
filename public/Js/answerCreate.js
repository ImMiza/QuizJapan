var add = document.getElementById('addQuestion');
let contenu = "";
var compteurQuestionFausse = document.getElementById('amount_fake_question');

var compteurQuestion = compteurQuestionFausse == null ? 1 : compteurQuestionFausse.innerHTML;
if(compteurQuestion >= 5){
    add.className = "btn btn-success mt-4 disabled";
}

add.addEventListener('click', event => {
    event.preventDefault();
    compteurQuestion++;
    // $('#questionaire').empty();
    if(compteurQuestion <= 5){
        contenu ="<div class='form-row'>";
        contenu +="<div class='form-group col'>";
        contenu +="<label for='name'>Mauvaise réponse supplémentaire</label>";
        contenu +="<input type='text' class='form-control badAnswer' name='badAnswer[]'>";
        contenu +="</div>";
        contenu +="</div>";
    }

    if(compteurQuestion >= 5){
        add.className = "btn btn-success mt-4 disabled";
    }
    $('#questionaire').append(contenu);
});