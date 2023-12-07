<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Droppable - Conditional Dropping</title>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <style>
    .draggable { width: 100px; height: 100px; padding: 0.5em; margin: 10px 10px 10px 0; }
    .droppable { width: 150px; height: 150px; padding: 0.5em; margin: 10px; }
    img { max-width: 100%; height: auto; }
  </style>
</head>
<body>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=test12', 'root', '');

$sql = "SELECT * FROM `1`";
$stmt = $pdo->query($sql);

// boucle pour créer un élément draggable pour chaque ligne de la table
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // crea d'un élément draggable avec l'image et la valeur de la base de données
    echo '<div class="draggable ui-widget-content" data-value="'.$row['résultat'].'">';
    echo '<img src="'.$row['lien'].'" alt="Image" />';
    echo '</div>';
}
?>

<div id="droppable-true" class="droppable ui-widget-header">
  <p>Drop True (1) here</p>
</div>

<div id="droppable-false" class="droppable ui-widget-header">
  <p>Drop False (0) here</p>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
$(function() {
  $(".draggable").draggable();
  
  // Fonction pour gérer le dépôt d'un élément draggable
  function handleDrop(event, ui, expectedValue) {
    var value = ui.draggable.data("value"); // recup la valeur de l'élément déposé
    var $this = $(this);

    // change la couleur de fond en fonction 
    if (value === expectedValue) {
      $this.addClass("ui-state-highlight").css('background-color', 'green');
    } else {
      $this.addClass("ui-state-error").css('background-color', 'red');
    }
    $this.find("p").html("Dropped! Value: " + value); // à jour le texte de la zone 
  }

  // zones droppable pour accepter draggable
  $("#droppable-true").droppable({
    drop: function(event, ui) {
      handleDrop.call(this, event, ui, 1); //  valeur 1
    }
  });

  $("#droppable-false").droppable({
    drop: function(event, ui) {
      handleDrop.call(this, event, ui, 0); //  la valeur 0
    }
  });
});
</script>

</body>
</html>