<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'form.php'?>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>Mixologue</title>
</head>
<body id="mix-bg">
    <form id="mix-form" method="POST">
        <h1>Composez votre cocktail Le Mixologue</h1>
        <div id="mix-prix">
            <span>16,99€ TTC</span>
        </div>
        <strong>Composez votre propre recette de e-liquides Le Mixologue !</strong>
        <div class="mix-indic">Vous pouvez choisir une recette parmi notre liste</div>
        <select id="recette" class="form-select">
            <option selected>Nos recettes</option>
            <?php foreach ($resultAllRecettes as $recette): ?>
                <option value="<?php echo $recette['id'] ?>"><?php echo $recette['nom'] ?></option>
            <?php endforeach ?>
        </select>
        <div class="mix-indic">Vous pouvez préparer votre propre recette unique</div>
            <div class="mix">
                <span class="mix-number">1</span>
                <select id="1" class="form-select mix-select">
                    <?php foreach ($resultAllSaveurs as $saveur): ?>
                        <option value="<?php echo $saveur['id'] ?>"><?php echo $saveur['nom'] ?></option>
                    <?php endforeach ?>
                </select>
                <select id="1A" class="form-select mix-select">
                    <option value="0">0%</option>
                    <option value="5">5%</option>
                    <option value="10">10%</option>
                    <option value="15">15%</option>
                    <option value="20">20%</option>
                    <option value="25">25%</option>
                    <option value="30">30%</option>
                    <option value="35">35%</option>
                    <option value="40">40%</option>
                    <option value="45">45%</option>
                    <option value="50">50%</option>
                    <option value="55">55%</option>
                    <option value="60">60%</option>
                    <option value="65">65%</option>
                    <option value="70">70%</option>
                    <option value="75">75%</option>
                    <option value="80">80%</option>
                    <option value="85">85%</option>
                    <option value="90">90%</option>
                    <option value="95">95%</option>
                </select>
            </div>
            <?php for ($i = 2; $i <= 5; $i++) { ?>
                <div class="mix">
                    <span class="mix-number"><?php echo $i ?></span>
                    <select id="<?php echo $i ?>" class="form-select mix-select">
                        <option value=""></option>
                        <?php foreach ($resultAllSaveurs as $saveur): ?>
                            <option value="<?php echo $saveur['id'] ?>"><?php echo $saveur['nom'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <select id="<?php echo $i ?>A" class="form-select mix-select" disabled>
                        <option value="0">0%</option>
                        <option value="5">5%</option>
                        <option value="10">10%</option>
                        <option value="15">15%</option>
                        <option value="20">20%</option>
                        <option value="25">25%</option>
                        <option value="30">30%</option>
                        <option value="35">35%</option>
                        <option value="40">40%</option>
                        <option value="45">45%</option>
                        <option value="50">50%</option>
                        <option value="55">55%</option>
                        <option value="60">60%</option>
                        <option value="65">65%</option>
                        <option value="70">70%</option>
                        <option value="75">75%</option>
                        <option value="80">80%</option>
                        <option value="85">85%</option>
                        <option value="90">90%</option>
                        <option value="95">95%</option>
                    </select>
                </div>
            <?php } ?>

        <div id="progressbar-wrapper">
            <div id="progressbar" class="progressbar-striped animated">0%</div>
        </div>
        <div id="progress-text">Encore besoin de <span id="mix-count">100</span>% pour compléter votre flacon</div>
        <div id="mix-recap">
            <label for="recap">Récapitulatif de votre recette</label>
            <textarea class="form-control" id="recap" name="récapitulatif" placeholder="Votre recette" rows="1" cols="120" readonly></textarea>
            <button type="submit" class="mybutton">Valider</button>
            <?php if(isset($recap)) { echo "Recette validée : " . $recap; ?>
                <strong>Vous pouvez cliquez sur « Ajouter au panier » pour passer la commande</strong>
            <?php } ?>
        </div>
    </form>
    <script>
        var allMix = [ ... document.getElementsByClassName('mix')];

        function enableMix(e) {
            let mixClicked = e.target.closest('.mix');
            let select = mixClicked.getElementsByClassName('mix-select')[0];
            let selectA = mixClicked.getElementsByClassName('mix-select')[1]
            if (select.value != ""){
                selectA.removeAttribute("disabled");
            } else {
                selectA.selectedIndex = 0;
                selectA.setAttribute("disabled", "");
            }
        }

        allMix.forEach(mix => mix.addEventListener("change", enableMix));

        var select1 = document.getElementById('1');
        var select2 = document.getElementById('2');
        var select3 = document.getElementById('3');
        var select4 = document.getElementById('4');
        var select5 = document.getElementById('5');

        var select1A = document.getElementById('1A');
        var select2A = document.getElementById('2A');
        var select3A = document.getElementById('3A');
        var select4A = document.getElementById('4A');
        var select5A = document.getElementById('5A');

        var mixCount = document.getElementById('mix-count');
        var progressText = document.getElementById('progress-text');
        var progressBar = document.getElementById('progressbar');
        var recap = document.getElementById('recap');

        function incrBar() {
            let count = 100 - select1A.value - select2A.value - select3A.value - select4A.value - select5A.value;
            if (count == 0){
                progressBar.innerHTML = "100%";
                progressBar.style.width = "100%";
                progressBar.style.backgroundColor = "#00b894";
                progressText.style.color = "#00b894";
                progressText.innerHTML = "Recette Complète !";
            } else if (count > 0) {
                progressBar.innerHTML = 100 - count + "%";
                progressBar.style.width = 100 - count + "%";
                progressBar.style.backgroundColor = "#24b9d7";
                progressText.style.color = "#2480d7";
                progressText.innerHTML = "Encore besoin de " + count + "% pour compléter votre flacon";
            } else {
                progressBar.innerHTML = 100 - count + "%";
                progressBar.style.width = "100%";
                progressBar.style.backgroundColor = "#e17055";
                progressText.style.color = "#e17055";
                progressText.innerHTML = "Attention vous avez " + -count + "% en trop dans votre mélange !";
            }
        }

        allMix.forEach(mix => mix.addEventListener("change", incrBar));

        function recapMix() {
            let recap1;
            let recap2;
            let recap3;
            let recap4;
            let recap5;
            if (select1A.value !="0"){
                recap1 = select1.options[select1.selectedIndex].text + " " + select1A.options[select1A.selectedIndex].text;
            } else {
                recap1 = "";
            }
            if (select2A.value !="0"){
                recap2 = " + " + select2.options[select2.selectedIndex].text + " " + select2A.options[select2A.selectedIndex].text;
            } else {
                recap2 = "";
            }
            if (select3A.value !="0"){
                recap3 = " + " + select3.options[select3.selectedIndex].text + " " + select3A.options[select3A.selectedIndex].text;
            } else {
                recap3 = "";
            }
            if (select4A.value !="0"){
                recap4 = " + " + select4.options[select4.selectedIndex].text + " " + select4A.options[select4A.selectedIndex].text;
            } else {
                recap4 = "";
            }
            if (select5A.value !="0"){
                recap5 = " + " + select5.options[select5.selectedIndex].text + " " + select5A.options[select5A.selectedIndex].text;
            } else {
                recap5 = "";
            }
            let resRecap = recap1 + recap2 + recap3 + recap4 + recap5;
            if(progressBar.innerHTML == '100%'){
                recap.innerHTML = resRecap;       
            } else {
                recap.innerHTML = ""; 
            }
        }

        allMix.forEach(mix => mix.addEventListener("change", recapMix));

        // Empêche l'envoi du formulaire si la recette n'est pas complète
        document.getElementById('mix-form').addEventListener("click", function(e){
            if(recap.innerHTML == "")
                e.preventDefault();
        }) 

        var selectRecette = document.getElementById('recette');
        var resultAllRecettes = <?php echo json_encode($resultAllRecettes); ?>;
        
        function choixRecette(){  
            let recetteIndex = selectRecette.selectedIndex - 1;
            let recetteClicked = resultAllRecettes[recetteIndex];
            if(recetteIndex != -1){
                let countSelect1 = 0;
                while(select1.options[countSelect1].label != recetteClicked.sav1){
                    countSelect1++;
                }
                select1.selectedIndex = countSelect1; 
                let countSelect1A = 0;
                while(select1A.options[countSelect1A].label != recetteClicked.pourc1){
                    countSelect1A++;
                }
                select1A.selectedIndex = countSelect1A;

                let countSelect2 = 0;
                while(select2.options[countSelect2].label != recetteClicked.sav2){
                    countSelect2++;
                }
                select2.selectedIndex = countSelect2;
                if(select2.selectedIndex != 0){     
                    let countSelect2A = 0;
                    while(select2A.options[countSelect2A].label != recetteClicked.pourc2){
                        countSelect2A++;
                    }
                    select2A.selectedIndex = countSelect2A;
                } else {
                    select2A.selectedIndex = 0;
                }

                let countSelect3 = 0;
                while(select3.options[countSelect3].label != recetteClicked.sav3){
                    countSelect3++;
                }
                select3.selectedIndex = countSelect3;
                if(select3.selectedIndex != 0){     
                    let countSelect3A = 0;
                    while(select3A.options[countSelect3A].label != recetteClicked.pourc3){
                        countSelect3A++;
                    }
                    select3A.selectedIndex = countSelect3A;
                } else {
                    select3A.selectedIndex = 0;
                }

                let countSelect4 = 0;
                while(select4.options[countSelect4].label != recetteClicked.sav4){
                    countSelect4++;
                }
                select4.selectedIndex = countSelect4;
                if(select4.selectedIndex != 0){     
                    let countSelect4A = 0;
                    while(select4A.options[countSelect4A].label != recetteClicked.pourc4){
                        countSelect4A++;
                    }
                    select4A.selectedIndex = countSelect4A;
                } else {
                    select4A.selectedIndex = 0;
                }

                let countSelect5 = 0;
                while(select5.options[countSelect5].label != recetteClicked.sav5){
                    countSelect5++;
                }
                select5.selectedIndex = countSelect5;
                if(select5.selectedIndex != 0){     
                    let countSelect5A = 0;
                    while(select5A.options[countSelect5A].label != recetteClicked.pourc5){
                        countSelect5A++;
                    }
                    select5A.selectedIndex = countSelect5A;
                } else {
                    select5A.selectedIndex = 0;
                }
            } else {
                select1.selectedIndex = 0;
                select1A.selectedIndex = 0;
                select2.selectedIndex = 0;
                select2A.selectedIndex = 0;
                select3.selectedIndex = 0;
                select3A.selectedIndex = 0;
                select4.selectedIndex = 0;
                select4A.selectedIndex = 0;
                select5.selectedIndex = 0;
                select5A.selectedIndex = 0;
            }
            if (select2.selectedIndex != 0){
                select2A.removeAttribute("disabled");
            } else {
                select2A.selectedIndex = 0;
                select2A.setAttribute("disabled", "");
            }
            if (select3.selectedIndex != 0){
                select3A.removeAttribute("disabled");
            } else {
                select3A.selectedIndex = 0;
                select3A.setAttribute("disabled", "");
            }
            if (select4.selectedIndex != 0){
                select4A.removeAttribute("disabled");
            } else {
                select4A.selectedIndex = 0;
                select4A.setAttribute("disabled", "");
            }
            if (select5.selectedIndex != 0){
                select5A.removeAttribute("disabled");
            } else {
                select5A.selectedIndex = 0;
                select5A.setAttribute("disabled", "");
            }
            incrBar();
            recapMix();
        }
        selectRecette.addEventListener("change", choixRecette);


    </script>
</body>
</html>