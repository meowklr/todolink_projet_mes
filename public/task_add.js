

// Bouton selectioner un collaborateur avec la bare deroulante
const dropdownBtn = document.getElementById("dropdownBtn");
const dropdownList = document.getElementById("dropdownList");
const items = document.querySelectorAll(".dropdown-item");
const boxCollaborateur = document.querySelector(".boxCollaborateur");
const selectedCollaborateurs = [];

function renderSelectedCollaborateurs() {
  if (!boxCollaborateur) return;

  if (selectedCollaborateurs.length === 0) {
    boxCollaborateur.innerHTML = "";
    return;
  }

  boxCollaborateur.innerHTML = selectedCollaborateurs
    .map((name) => `
      <div class="selected-collab-row">
        <span>${name}</span>
        <button type="button" class="remove-collab" data-name="${name}">X</button>
      </div>
    `)
    .join("");
}

dropdownBtn.addEventListener("click", () => {
  dropdownList.classList.toggle("active");
});

items.forEach(item => {
  item.addEventListener("click", () => {
    const name = item.textContent.trim();

    if (!selectedCollaborateurs.includes(name)) {
      selectedCollaborateurs.push(name);
    }

    renderSelectedCollaborateurs();

    dropdownList.classList.remove("active");
  });
});

if (boxCollaborateur) {
  boxCollaborateur.addEventListener("click", (event) => {
    const removeButton = event.target.closest(".remove-collab");
    if (!removeButton) return;

    const name = removeButton.getAttribute("data-name");
    const index = selectedCollaborateurs.indexOf(name);
    if (index > -1) {
      selectedCollaborateurs.splice(index, 1);
      renderSelectedCollaborateurs();
    }
  });
}



// Systeme de fichier avec petite icone
const inputFichier = document.getElementById('piece_jointe');
const previewFichier = document.getElementById('fichier_selectionne');

if (inputFichier && previewFichier) {
    inputFichier.addEventListener('change', function () {
        if (inputFichier.files && inputFichier.files.length > 0) {
            previewFichier.innerHTML = '<img src="/images/image_fichier_TODOLINK.png" alt="Fichier" class="file_icon"> ' + inputFichier.files[0].name;
        } else {
            previewFichier.textContent = 'Aucun fichier selectionne';
        }
    });
}
