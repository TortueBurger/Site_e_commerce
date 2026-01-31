const dropDate = new Date("Feb 20, 2026 00:00:00").getTime();

// 2. Mettre à jour le compte à rebours chaque seconde (1000 millisecondes)
const x = setInterval(function() {

  // Obtenir la date et l'heure actuelles
  const now = new Date().getTime();

  // Calculer la distance entre maintenant et la date du drop
  const distance = dropDate - now;

  // Calculs mathématiques pour les jours, heures, minutes et secondes
  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Afficher le résultat dans les éléments HTML correspondants
  document.getElementById("days").innerText = days < 10 ? "0" + days : days;
  document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
  document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
  document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;

  // Si le compte à rebours est terminé
  if (distance < 0) {
    clearInterval(x);
    document.querySelector(".countdown").innerHTML = "<div>LE DROP EST EN LIGNE !</div>";
  }
}, 1000);