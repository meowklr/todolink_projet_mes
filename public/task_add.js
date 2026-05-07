// Elements du menu de selection des collaborateurs.
const dropdownBtn = document.getElementById("dropdownBtn");
const dropdownList = document.getElementById("dropdownList");
const collabItems = document.querySelectorAll(".collab-item");
const boxCollaborateur = document.querySelector(".boxCollaborateur");
const usernameInput = document.getElementById("username");
// Liste des collaborateurs choisis: c'est elle qui sert de source principale.
const selectedCollaborateurs = [];

// Met a jour le champ cache et le texte du bouton.
function updateUsernameField() {
  const joined = selectedCollaborateurs.join(", ");

  usernameInput.value = joined;

  dropdownBtn.textContent = selectedCollaborateurs.length
    ? "Collaborateurs (" + selectedCollaborateurs.length + ")"
    : "S\u00e9lectionner un collaborateur";
}

// Affiche la liste des collaborateurs choisis.
// On reconstruit tout le bloc a chaque fois pour garder l'affichage simple.
function renderSelectedCollaborateurs() {
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

// Supprime un collaborateur quand on clique sur son bouton.
// On enlève le nom du tableau, puis on met a jour l'affichage et le champ cache.
function removeCollaborateur(name) {
  const index = selectedCollaborateurs.indexOf(name);

  if (index > -1) {
    selectedCollaborateurs.splice(index, 1);
    updateUsernameField();
    renderSelectedCollaborateurs();
    addRemoveButtonsListeners();
  }
}

// Repose les evenements sur les boutons X apres chaque rendu de la liste.
// Comme innerHTML recrée les boutons, il faut rattacher les clics après chaque rendu.
function addRemoveButtonsListeners() {
  const removeButtons = boxCollaborateur.querySelectorAll(".remove-collab");

  removeButtons.forEach((button) => {
    button.addEventListener("click", () => {
      removeCollaborateur(button.getAttribute("data-name"));
    });
  });
}

updateUsernameField();
renderSelectedCollaborateurs();
<<<<<<< HEAD
if (dropdownBtn) {
  dropdownBtn.addEventListener("click", () => {
    dropdownList.classList.toggle("active");
=======
addRemoveButtonsListeners();

// Ouvre ou ferme la liste deroulante.
dropdownBtn.addEventListener("click", () => {
  dropdownList.classList.toggle("active");
});

// Ajoute un collaborateur quand on clique sur une entree du menu.
// Le test includes empeche les doublons dans la selection.
items.forEach(item => {
  item.addEventListener("click", () => {
    const name = (item.getAttribute("data-name") || item.textContent).trim();

    if (!selectedCollaborateurs.includes(name)) {
      selectedCollaborateurs.push(name);
    }

    updateUsernameField();

    renderSelectedCollaborateurs();

    dropdownList.classList.remove("active");
>>>>>>> b4694e3fc501fc670a7f5668b9481273415c08c0
  });

  collabItems.forEach(item => {
    item.addEventListener("click", () => {
      const name = (item.getAttribute("data-name") || item.textContent).trim();

      if (!selectedCollaborateurs.includes(name)) {
        selectedCollaborateurs.push(name);
      }

      updateUsernameField();

      renderSelectedCollaborateurs();

      dropdownList.classList.remove("active");
    });
  });
}

// Apercu du fichier joint: on affiche une icone + le nom du fichier selectionne.
// C'est juste une aide visuelle pour l'utilisateur avant l'envoi du formulaire.
const inputFichier = document.getElementById('piece_jointe');
const previewFichier = document.getElementById('fichier_selectionne');

// Des qu'un fichier change, on met a jour le texte d'aperçu.
inputFichier.addEventListener('change', function () {
    if (inputFichier.files && inputFichier.files.length > 0) {
        previewFichier.innerHTML = '<img src="/images/image_fichier_TODOLINK.png" alt="Fichier" class="file_icon"> ' + inputFichier.files[0].name;
    } else {
        // Si aucun fichier n'est choisi, on remet un message simple.
        previewFichier.textContent = 'Aucun fichier selectionne';
  }
});
