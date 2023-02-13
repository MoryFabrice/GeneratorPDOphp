/*
 * showBD
 */

// Cette fonction initialise les événements de l'application.
function init() {
  // On appelle la fonction showBD pour afficher les bases de données disponibles.
  showBD();

  // On ajoute les gestionnaires d'événements pour les boutons.
  $("#btnCreateDb").on("click", createDBClass);
  $("#btnNoCreateDb").on("click", createNoDBClass);
  $("#btnChoisir").on("click", choisirBD);
  $("#btnValider").on("click", createFileClass);
  $("#btnOui").on("click", createFichier);
  $("#btnRetourTable").on("click", choisirBD);
  $("#btnRetourBD").on("click", showBD);
  $("#btnRecupFile").on("click", createArchive);
  $("#btnNoRecupFile").on("click", noCreateArchive);
} /// init

// Cette fonction permet d'afficher les bases de données disponibles.
function showBD() {
  // On vide le contenu de la liste des bases de données.
  $("#listeBD").empty();

  // On enlève l'attribut "hidden" pour afficher la liste des bases de données et le bouton "Choisir".
  $("#slctListeBD").removeAttr("hidden");
  $("#btnChoisir").removeAttr("hidden");
  $("#divCreateDb").removeAttr("hidden");

  // On ajoute l'attribut "hidden" pour masquer la liste des tables et le bouton "Créer".
  $("#slctListeTable").prop("hidden", true);
  $("#createFile").prop("hidden", true);

  // On récupère l'URL actuelle.
  url = document.location.href;

  // On modifie l'URL pour appeler le contrôleur PHP.
  let url1 = url.replace("views/showBD.phtml", "controllers/showBD.php");

  // On affiche l'URL modifiée dans la console.
  console.log(url1);

  // On utilise la méthode $.get de jQuery pour appeler le contrôleur PHP.
  let xhr = $.get(url1);

  // Si la requête est réussie, on traite les données reçues.
  xhr.done(function (data) {
    // On sépare les enregistrements par retour à la ligne.
    let tRecords = data.split("\n");

    // On définit la taille de la liste en fonction du nombre d'enregistrements.
    $("#listeBD").attr("size", tRecords.length);

    // Pour chaque enregistrement, on ajoute une option à la liste.
    for (let i = 1; i < tRecords.length; i++) {
      let opt = $("<option>");
      opt.val(tRecords[i]);
      opt.html(tRecords[i]);
      $("#listeBD").append(opt);
    }
  });

  // Si la requête échoue, on affiche un message d'erreur.
  xhr.fail((xhr) => {
    $("#lbMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// showBD

// Cette fonction permet de créer un fichier "Database.php".
function createDBClass() {
  console.log("--- create Database.php ---");

  $("#lblCreateDbOK").removeAttr("hidden");
  $("#lblCreateDbOK").text("Le fichier Database.php a été crée !");

  // On cache le div qui affiche le formulaire pour la création de la base de données.
  $("#divCreateDb").prop("hidden", true);

  // On récupère l'URL actuelle.
  url = document.location.href;
  // On remplace la partie de l'URL pour accéder au contrôleur "createDbClass.php".
  let url1 = url.replace("views/showBD.phtml", "controllers/createDbClass.php");

  // On récupère le nom de la base de données sélectionnée.
  let dbName = $("#listeBD option:selected").text();

  // On envoie une requête POST pour créer le fichier "Database.php".
  let xhr = $.post(url1, { dbName: dbName }); /// $.post

  xhr.done(function (data) {
    // Si la réponse est 1, cela signifie que le fichier a été créé avec succès.
    console.log("data" + data);
    if (data == 1) {
      console.log("Le fichier à été crée" + data);
    }
  });

  xhr.fail((xhr) => {
    // En cas d'erreur, on affiche le statut et le message d'erreur dans lbMessage.
    $("#lbMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// createDBClass

// Cette fonction permet de ne pas créer le fichier "Database.php".
function createNoDBClass() {
  console.log("--- createNoDatabase.php ---");

  $("#lblCreateDbOK").removeAttr("hidden");
  $("#lblCreateDbOK").text("Le fichier Database.php n'a été crée !");

  // On cache le div qui affiche le formulaire pour la création de la base de données.
  $("#divCreateDb").prop("hidden", true);
}

/**
 * Fonction pour choisir une base de données
 * et afficher les tables disponibles dans la liste déroulante.
 */
function choisirBD() {
  // Efface les éléments précédents dans la liste de tables
  $("#listeTable").empty();
  console.log("--- choisirBD ---");

  // Récupère l'URL actuelle
  url = document.location.href;
  let url2 = url.replace("views/showBD.phtml", "controllers/showTable.php");

  // Cache certains éléments de l'interface utilisateur
  $("#slctListeBD").prop("hidden", true);
  $("#btnChoisir").prop("hidden", true);
  $("#lblCreateDbOK").prop("hidden", true);
  $("#textAreaMessage").prop("hidden", true);
  $("#btnChoixCreate").prop("hidden", true);
  $("#divValidation").prop("hidden", true);

  // Affiche certains éléments de l'interface utilisateur
  $("#slctListeTable").removeAttr("hidden");
  $("#createFile").removeAttr("hidden");

  // Récupère le nom de la base de données sélectionnée par l'utilisateur
  let bdd = $("#listeBD option:selected").text();

  // Envoie une requête POST pour obtenir les tables disponibles
  let xhr = $.post(url2, { bdd: bdd });

  // Traite la réponse de la requête
  xhr.done(function (data) {
    let tRecords = data.split("\n");
    // Définit la taille de la liste déroulante en fonction du nombre de tables
    $("#listeTable").attr("size", tRecords.length);
    for (let i = 1; i < tRecords.length; i++) {
      // Crée une option pour chaque table disponible
      let opt = $("<option>");
      opt.val(tRecords[i]);
      opt.html(tRecords[i]);
      // Ajoute l'option à la liste déroulante
      $("#listeTable").append(opt);
    }
  });

  // Traite une éventuelle erreur de la requête
  xhr.fail((xhr) => {
    $("#lbMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// choisirBD

function createFileClass() {
  console.log("--- createFileClass ---");

  url = document.location.href;
  let url3 = url.replace("views/showBD.phtml", "controllers/showAttribut.php");

  $("#slctListeTable").prop("hidden", true);
  $("#createFile").prop("hidden", true);

  $("#textAreaMessage").removeAttr("hidden");
  $("#btnChoixCreate").removeAttr("hidden");

  let listeBD = $("#listeBD option:selected").text();
  let listeTable = $("#listeTable option:selected").text();
  let radioValue = $("input[name='radio']:checked").val();

  console.log("checkbox result : " + radioValue);

  let xhr = $.post(url3, {
    listeBD: listeBD,
    listeTable: listeTable,
    class: radioValue,
  }); /// $.get

  xhr.done(function (data) {
    if (data != "") {
      console.log(data);
      $("#pMessage").text(data);
    }
  });

  xhr.fail((xhr) => {
    $("#pMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// createFileClass

function createFichier() {
  console.log("--- createFichier ---");

  url = document.location.href;
  let url4 = url.replace("views/showBD.phtml", "controllers/createFichier.php");

  $("#divValidation").removeAttr("hidden");
  // Recuperation de la valeur du radio (DAO ou metier)
  let radioValue = $("input[name='radio']:checked").val();

  // Recuperation de nom de la table pour le nom de fichier
  let listeTable = $("#listeTable option:selected").text();
  // Permet de mettre en Maj la 1ere lettre
  listeTable = listeTable[0].toUpperCase() + listeTable.slice(1);

  let nomFichierCree = listeTable + ".php";
  // Recuperation du texte
  let textFichier = $("#pMessage").text();

  let xhr = $.post(url4, {
    nomFichier: nomFichierCree,
    contenu: textFichier,
    class: radioValue,
  }); /// $.get

  xhr.done(function (data) {
    console.log(data);
    if (data) {
      $("#lblMessageValidation").text(
        "Le fichier " +
          nomFichierCree +
          " a été crée voulez vous le récuperer! ?"
      );
    }
  });

  xhr.fail((xhr) => {
    $("#pMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// createFichier

function createArchive() {
  console.log("--- createArchive ---");

  $("#recupFile").removeAttr("hidden");
}

function noCreateArchive() {
  console.log("--- noCreateArchive ---");

  $("#divValidation").prop("hidden", true);
}

// ------------------
$(document).ready(init);
var url = "";
