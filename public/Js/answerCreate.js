var add = document.getElementById('addQuestion');
let contenu = "<div class='form-row'>";
contenu +="<div class='form-group col'>";
contenu +="<label for='name'>Question</label>";
contenu +="<input type='text' class='form-control' id='question' name='question' required>";
contenu +="</div>";
contenu +="</div>"
contenu +="<div class='form-row'>"
contenu +="<div class='form-group col'>";
contenu +="<label for='name'>Bonne réponse</label>";
contenu +="<input type='text' class='form-control' id='goodAnswer' name='goodAnswer' required>";
contenu +="</div>";
contenu +="</div>";
contenu +="<div class='form-row'>";
contenu +="<div class='form-group col'>";
contenu +="<label for='name'>Mauvaise réponse</label>";
contenu +="<input type='text' class='form-control' id='badAnswer' name='badAnswer' required>";
contenu +="</div>";
contenu +="</div>";
var compteurQuestionFausse = 1;
            
add.addEventListener('click', event => {
    event.preventDefault();
    compteurQuestionFausse++;
    $('#questionaire').empty();
    if(compteurQuestionFausse <= 5){
        contenu +="<div class='form-row'>";
        contenu +="<div class='form-group col'>";
        contenu +="<label for='name'>Mauvaise réponse supplémentaire</label>";
        contenu +="<input type='text' class='form-control badAnswer' name='badAnswer[]' required>";
        contenu +="</div>";
        contenu +="</div>";
    }

    if(compteurQuestionFausse == 5){
        add.className = "btn btn-success mt-4 disabled";
    }
    $('#questionaire').append(contenu);
});