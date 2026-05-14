// Seleciona os elementos
const perfilBtn = document.querySelector(".perfil-btn");
const dropdown = document.querySelector(".dropdown");

// Alterna mostrar/esconder ao clicar no botão
perfilBtn.addEventListener("click", (event) => {
  event.stopPropagation(); // impede que o clique "suba" pro documento
  dropdown.classList.toggle("show");
});

// Fecha o dropdown ao clicar fora
document.addEventListener("click", (event) => {
  // Se o clique NÃO foi dentro do botão nem do dropdown, fecha
  if (!perfilBtn.contains(event.target) && !dropdown.contains(event.target)) {
    dropdown.classList.remove("show");
  }
});