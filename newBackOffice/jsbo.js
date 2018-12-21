function ajoutFon(){
    if(document.getElementById('select_auteur').value == "ajoutAut") {
      window.location = "ajoutPlus/ajoutAuteur.php";
  }
};
function ajoutFon2(){
  if(document.getElementById('select_collection').value == "ajoutCol") {
      window.location = "ajoutPlus/ajoutCol.php";
  }
};
function ajoutFon3(){
  if(document.getElementById('select_editeur').value == "ajoutEdit") {
      window.location = "ajoutPlus/ajoutEdit.php";
  }
};

function retour(){
  window.location = "../ajout.php";
}

function fin(){
  window.location = "../index.php";
}

function verif(){
  var oldURL = document.referrer;
  var div = document.getElementById("affichverif");
  if(oldURL == "http://localhost/biblippe/newbackoffice/rechercheSuppr/suppression.php"){
    div.innerHTML = "<h1>Livre supprimé(s)</h1>";
  }else if(oldURL == "http://localhost/biblippe/newbackoffice/ajoutPlus/ajouter.php"){
    div.innerHTML = "<h1>Livre ajouté</h1>";
  }else if(oldURL == "http://localhost/biblippe/newbackoffice/modifLivre/modification.php"){
    div.innerHTML = "<h1>Livre modifié</h1>";
  }else{
    div.innerHTML ="<h1>Index</h1>";
  }
}


