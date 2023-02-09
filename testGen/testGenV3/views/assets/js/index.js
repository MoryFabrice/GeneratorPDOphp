/*
 * index.js
 */

// ------------
function init() {
  $("#btnValider").on("click", createDBIni);
} /// init

function createDBIni() {
  console.log("--- createDBIni ---");

  let host = $("#host").val();
  let port = $("#port").val();
  let utilisateur = $("#utilisateur").val();
  let mdp = $("#mdp").val();

  let url = document.location.href;
  console.log(url);

  // Test en local
  let url1 = url.replace("index.php", "controllers/createDBIni.php");

  // Test sur le net
  //let url1 = url.replace("GenPhp/", "GenPhp/controllers/createDBIni.php");
  console.log(url1);

  let xhr = $.post(url1, {
    host: host,
    port: port,
    utilisateur: utilisateur,
    mdp: mdp,
  }); /// $.post
  //console.log(host + " / " + port + " / " + utilisateur + " / " + mdp);

  xhr.done(function (data) {
    if (data != "") {
      // console.log(data);
      console.log("Connection OK");
    } else {
      console.log("Connection KO");
    }
  });

  xhr.fail((xhr) => {
    $("#pMessage").html(xhr.status + " : " + xhr.statusText);
  });
} /// createDBIni

// ------------------
$(document).ready(init);
