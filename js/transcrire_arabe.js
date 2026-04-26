// script_arabe_ameliore.js

// Correspondances avancées (sons composés d'abord !)
const sonsComposes = {
    'ch': 'ش',
    'sh': 'ش',
    'kh': 'خ',
    'gh': 'غ',
    'th': 'ث',
    'dh': 'ذ',
    'ph': 'ف',
    'ou': 'و',
    'aa': 'ا',
    'ee': 'ي'
};

// Correspondance lettres simples
const alphabetArabe = {
    'a': 'ا', 'b': 'ب', 'c': 'ك', 'd': 'د', 'e': 'ي', 'f': 'ف',
    'g': 'ج', 'h': 'ه', 'i': 'ي', 'j': 'ج', 'k': 'ك', 'l': 'ل',
    'm': 'م', 'n': 'ن', 'o': 'و', 'p': 'ب', 'q': 'ق', 'r': 'ر',
    's': 'س', 't': 'ت', 'u': 'و', 'v': 'ف', 'w': 'و', 'x': 'كس',
    'y': 'ي', 'z': 'ز'
};

// Fonction pour transcrire le prénom
function transcrires() {
    let prenoms = document.getElementById("prenoms").value.toLowerCase();
    let transcription = "";

    let i = 0;

    while (i < prenoms.length) {

        // Vérifie les sons composés (2 lettres)
        let deuxLettres = prenoms.substring(i, i + 2);

        if (sonsComposes[deuxLettres]) {
            transcription += sonsComposes[deuxLettres];
            i += 2; // saute 2 lettres
        } else {
            let lettre = prenoms[i];

            if (alphabetArabe[lettre]) {
                transcription += alphabetArabe[lettre];
            } else {
                transcription += lettre;
            }

            i++;
        }
    }

    document.getElementById("resultats").innerText = transcription;
}

// Copier le résultat
function copierTexte() {
    const texte = document.getElementById("resultats").innerText;

    if (texte) {
        navigator.clipboard.writeText(texte);
        alert("Texte copié !");
    }
}

// Effacer les champs
function effacer() {
    document.getElementById("prenoms").value = "";
    document.getElementById("resultats").innerText = "";
}

function telechargerImage() {
    const texte = document.getElementById("resultats").innerText;

    if (!texte) {
        alert("Rien à télécharger !");
        return;
    }

    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    // Taille de l'image
    canvas.width = 1000;
    canvas.height = 800;

    // Fond blanc
    ctx.fillStyle = "#f7ffd1";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Style texte arabe
    ctx.fillStyle = "#004f31";
    ctx.font = "bold 180px 'Amiri', serif";
    ctx.textAlign = "center";
    ctx.direction = "rtl";

    // Dessin du texte
    ctx.fillText(texte, canvas.width / 2, canvas.height / 2);

    // Télécharger l'image
    const lien = document.createElement("a");
    lien.download = "prenom_arabe.png";
    lien.href = canvas.toDataURL("image/png");
    lien.click();
}