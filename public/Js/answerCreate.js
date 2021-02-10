var add = document.getElementById('addQuestion');
let contenu = "";
var compteurQuestionFausse = 1;
            
add.addEventListener('click', event => {
    event.preventDefault();
    compteurQuestionFausse++;
    // $('#questionaire').empty();
    if(compteurQuestionFausse <= 5){
        contenu ="<div class='form-row'>";
        contenu +="<div class='form-group col'>";
        contenu +="<label for='name'>Mauvaise réponse supplémentaire</label>";
        contenu +="<input type='text' class='form-control badAnswer' name='badAnswer[]'>";
        contenu +="</div>";
        contenu +="</div>";
    }

    if(compteurQuestionFausse == 5){
        add.className = "btn btn-success mt-4 disabled";
    }
    $('#questionaire').append(contenu);
});