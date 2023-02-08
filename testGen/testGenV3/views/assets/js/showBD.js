/*
 * showBD
 */

// ------------
function init() {
  showBD();

  $("#btnCreateDb").on("click", createDBClass);
  $("#btnNoCreateDb").on("click", createNoDBClass);
  $("#btnChoisir").on("click", choisirBD);
  $("#btnValider").on("click", createFileClass);
  $("#btnOui").on("click", createFichier);
} /// init

function showBD() {
  $("#listeBD").empty();
  url = document.location.href;
  let url1 = url.replace("views/showBD.phtml", "controllers/showBD.php");

  console.log(url1);

  let xhr = $.get(url1); /// $.get

  xhr.done(function (data) {
    let tRecords = data.split("\n");
    $("#listeBD").attr("size", tRecords.length);
    for (let i = 1; i < tRecords.length; i++) {
      let opt = $("<option>");
      opt.val(tRecords[i]);
      opt.html(tRecords[i]);
      $("#listeBD").append(opt);
    }
  });

  xhr.fail((xhr) => {
    $("#lbMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// showBD

function createDBClass() {
  console.log("--- create Database.php ---");

  $("#divCreateDb").prop("hidden", true);

  url = document.location.href;
  let url1 = url.replace("views/showBD.phtml", "controllers/createDbClass.php");

  let dbName = $("#listeBD option:selected").text();

  let xhr = $.post(url1, { dbName: dbName }); /// $.post

  xhr.done(function (data) {
    if (data == 1) {
      console.log("Le fichier à été crée" + data);
    }
  });

  xhr.fail((xhr) => {
    $("#lbMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// createDBClass

function createNoDBClass() {
  console.log("--- createNoDatabase.php ---");

  $("#divCreateDb").prop("hidden", true);
}

function choisirBD() {
  $("#listeTable").empty();
  console.log("--- choisirBD ---");

  url = document.location.href;
  let url2 = url.replace("views/showBD.phtml", "controllers/showTable.php");
  $("#listeTable").removeAttr("hidden");
  $("#btnValider").removeAttr("hidden");
  $("#chkMetier").removeAttr("hidden");
  $("#chkDAO").removeAttr("hidden");
  $("#lblMetier").removeAttr("hidden");
  $("#lblDAO").removeAttr("hidden");

  let bdd = $("#listeBD option:selected").text();

  let xhr = $.post(url2, { bdd: bdd }); /// $.get

  xhr.done(function (data) {
    let tRecords = data.split("\n");
    $("#listeTable").attr("size", tRecords.length);
    for (let i = 1; i < tRecords.length; i++) {
      let opt = $("<option>");
      opt.val(tRecords[i]);
      opt.html(tRecords[i]);
      $("#listeTable").append(opt);
    }
  });

  xhr.fail((xhr) => {
    $("#lbMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// choisirBD

function createFileClass() {
  console.log("--- createFileClass ---");

  url = document.location.href;
  let url3 = url.replace("views/showBD.phtml", "controllers/showAttribut.php");

  $("#pMessage").removeAttr("hidden");
  $("#lblMessage").removeAttr("hidden");
  $("#btnOui").removeAttr("hidden");
  $("#btnNon").removeAttr("hidden");

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

  $("#lblMessageValidation").prop("hidden", false);
  $("#btnRecupFile").prop("hidden", false);
  $("#btnNoRecupFile").prop("hidden", false);
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
// ------------------
$(document).ready(init);
var url = "";
