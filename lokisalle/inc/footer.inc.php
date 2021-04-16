<footer>
  <div class="row"> 

    <div class="col1">          
    <a id="lien1" class="trans1" href="mentions.php">Mentions Legales</a> 
    <a id="lien1" class="trans1" href="cgv.php">C.G.V</a>
    <a id="lien1" class="trans1" href="plan.php">Plan du site</a>
    
    </div>

    <div class="col2">
     
     <a id="lien1" class="trans1" href="#">S'inscrire a la newsletter</a>
     <a id="lien1" class="trans1" href="javascript:window.print()">Imprimer la page</a>
     <a id="lien1" class="trans1" href="#top">Haut de page</a>
    </div>
      
    <div class="col3">
       
       <a id="lien1" class="trans1" href="#">Contact :</a>
       <p>Lokisalle<br>1 rue de Boswellia<br>75000 Paris <br>FRANCE<br><p><img src="images/phone.png" alt="tel :"> n° 01.75.00.00.00 </p></p>
    </div>

  </div>
  <div class="bottom">
      <p>©2015 Rasmei-Pagna TOUNG / Projet Pegadogique IFOCOP</p>

    
  </div>


</footer>
<script language="JavaScript"> 
function imprime_zone(titre, obj) 
{
// Définie la zone à imprimer
var zi = document.getElementById(obj).innerHTML;
// Ouvre une nouvelle fenetre
var f = window.open("", "ZoneImpr", "height=500, width=600,toolbar=0, menubar=0, scrollbars=1, resizable=1,status=0, location=0, left=10, top=10");
// Définit le Style de la page
f.document.body.style.color = '#000000';
f.document.body.style.backgroundColor = '#FFFFFF';
f.document.body.style.padding = "10px";
// Ajoute les Données
f.document.title = titre;
f.document.body.innerHTML += " " + zi + " ";
// Imprime et ferme la fenetre
f.window.print();
f.window.close();
return true;
}


</script>
  </body>
</html>