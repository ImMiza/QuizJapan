<html lang="fr">
    <?php include_once('../public/template/head.php');?>

    <body onload="decompte();" id="intermede">
        <div class="container">
            <div class="col text-center">
                <span id="centrerNombre">6</span>
            </div>
        </div>

        <script>
            var compteur = document.getElementById('centrerNombre');
            var cpt = 5 ;
            var x ;
            
            function decompte() {
                if(cpt>=0) {
                    if(cpt>1) {
                        var sec = " secondes.";
                    } else {
                        var sec = " seconde.";
                    }
                    document.getElementById("centrerNombre").innerHTML = cpt;
                    cpt-- ;
                    x = setTimeout("decompte()",1000);
                }
                else {
                    document.location.href="http://quizjapan/vue/card.php"; 
                }
            }
        </script>
    </body>
</html>