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
