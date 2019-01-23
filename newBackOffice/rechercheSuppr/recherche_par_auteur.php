<p>
<input id="nomAuteur" type="text" name="nomAuteur" value="" placeholder="Nom"/><br>
<input id="prenomAuteur" type="text" name="prenomAuteur" value="" placeholder="Prenom"/><br>
<button type="button" id="button">Rechercher</button>
</p>

<div id="etape3">

</div>

<script>
var button = document.getElementById('button');

button.addEventListener('click', function() {
  var nomAuteur = document.getElementById('nomAuteur').value;
  

  $.ajax({url: "rechercheSuppr/resu_recherche.php", data: {nomAuteur: nomAuteur}, success: function(result){
      $("#etape3").html(result);
  }});
})
</script>
