// script2.js

// Tableau de correspondance entre alphabet latin et Tifinagh
const alphabetTifinagh = {
    'a': 'ⴰ', 'b': 'ⴱ', 'c': 'ⵛ', 'd': 'ⴷ', 'e': 'ⴻ', 'f': 'ⴼ', 
    'g': 'ⴳ', 'h': 'ⵀ', 'i': 'ⵉ', 'j': 'ⵊ', 'k': 'ⴽ', 'l': 'ⵍ', 
    'm': 'ⵎ', 'n': 'ⵏ', 'o': 'ⵓ', 'p': 'ⵃ', 'q': 'ⵇ', 'r': 'ⵔ', 
    's': 'ⵙ', 't': 'ⵜ', 'u': 'ⵓ', 'v': 'ⴼ', 'w': 'ⵡ', 'x': 'ⵅ', 
    'y': 'ⵢ', 'z': 'ⵣ'
};

// Fonction pour transcrire le prénom
function transcrire() {
    const prenom = document.getElementById("prenom").value.toLowerCase(); // Récupère le prénom et le met en minuscule
    let transcription = "";

    // Boucle à travers chaque lettre du prénom
    for (let i = 0; i < prenom.length; i++) {
        let lettre = prenom[i];
        if (alphabetTifinagh[lettre]) {
            transcription += alphabetTifinagh[lettre]; // Ajoute la lettre Tifinagh correspondante
        } else {
            transcription += lettre; // Si pas de correspondance, garde la lettre telle quelle
        }
    }

    // Affiche le résultat
    document.getElementById("resultat").innerText = transcription;
}

// Copier le résultat
function copieTexte() {
    const texte = document.getElementById("resultat").innerText;

    if (texte) {
        navigator.clipboard.writeText(texte);
        alert("Texte copié !");
    }
}

// Effacer les champs
function efface() {
    document.getElementById("prenom").value = "";
    document.getElementById("resultat").innerText = "";
}


function telechargeImage() {
    const texte = document.getElementById("resultat").innerText;

    if (!texte) {
        alert("Rien à télécharger !");
        return;
    }

    const canvas2 = document.getElementById("canvas2");
    const ctx = canvas2.getContext("2d");

    // Taille de l'image
    canvas2.width = 1300;
    canvas2.height =1500;

    // Fond blanc
    ctx.fillStyle = "#f7ffff";
    ctx.fillRect(0, 0, canvas2.width, canvas2.height);

    // Style texte arabe
    ctx.fillStyle = "#ba0202";
    ctx.font = "bold 190px 'Arial', serif";
    ctx.textAlign = "center";
    ctx.direction = "rtl";

    // Dessin du texte
    ctx.fillText(texte, canvas2.width / 2, canvas2.height / 2);

    // Télécharger l'image
    const lien = document.createElement("a");
    lien.download = "prenom_kabyle.png";
    lien.href = canvas2.toDataURL("image/png");
    lien.click();
}
