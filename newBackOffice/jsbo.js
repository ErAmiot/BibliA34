var i=0;
var y=0;
function ajoutFon(){
    if(document.getElementById('select_auteur'+y).value == "ajoutAut") {
      window.location = "ajoutPlus/ajoutAuteur.php";
  }else if(document.getElementById('select_auteur'+y).value != "rien"){
        console.log("debut else");
        var select = document.createElement('select');
        var sel= document.getElementById('select_auteur0');
        var br=document.createElement('br');
        var rubrique=document.getElementById('auteur');
        var a;
        y++;
        console.log(y);
        for(a=0;a<sel.length;a++){
            select.innerHTML+='<option value='+sel.options[a].value+'>'+sel.options[a].text+'</option>';
        }
        select.id='select_auteur'+y;
        select.setAttribute("onchange",'ajoutFon()');
        select.setAttribute("name","rubrique");
        
        rubrique.appendChild(br);
        rubrique.appendChild(select);
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

function ajoutFon4(){
    if(document.getElementById('select_rubrique'+i).value == "ajoutRub"){
        window.location = "ajoutPlus/ajoutRub.php";
    }else if(document.getElementById('select_rubrique'+i).value != 'rien'){
        console.log("debut else");
        var select = document.createElement('select');
        var sel= document.getElementById('select_rubrique0');
        var br=document.createElement('br');
        var rubrique=document.getElementById('rubrique');
        var a;
        i++;
        console.log(i);
        for(a=0;a<sel.length;a++){
            select.innerHTML+='<option value='+sel.options[a].value+'>'+sel.options[a].text+'</option>';
        }
        select.id='select_rubrique'+i;
        select.setAttribute("onchange",'ajoutFon4()');
        select.setAttribute("name","rubrique");
        
        rubrique.appendChild(br);
        rubrique.appendChild(select);
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


