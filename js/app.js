if (!navigator.onLine) {
  alert("Internet bağlantınız yok. Lütfen internet bağlantınızı kontrol edin.");
}

document
  .getElementById("toggleBtn")
  .addEventListener("click", function toggleMenu() {
    const menu = document.getElementById("menu");
    menu.classList.toggle("hidden");
  });
