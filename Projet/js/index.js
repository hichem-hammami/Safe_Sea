
//flag pour connaitre le thème courant du site.
var themeCourant = "DARK";
//Les différents éléments HTML à affecter par le changement du thème du site.
var body = document.getElementById("corps");
var miniature = document.getElementById("miniature");
var panier = document.getElementById("panier");
var miniatures = document.querySelectorAll(".thumbnail");
var entetes = document.querySelectorAll("th");
var cellules = document.querySelectorAll("td");
var carte = document.getElementById("carte");

//Variables correspondants aux éléments img à animer
var animation1 = document.getElementById("animation1");
var animation2 = document.getElementById("animation2");
//Identifiant du timer
var id = null;
//Élément HTML qui, s'il existe (n'est pas null), indique que le panier est vide.
var vide = document.getElementById("vide");

if(vide !== null){
    //Ici, on est en présence d'un panier vide. On affiche alors une image
    document.getElementById("radin").style.display = "inline";
}


//Fonction de modification du thème du site.
function changerTheme(source){
    if(themeCourant === "DARK"){
        toggleElementClasses(body, "fond-dark", "fond-light", "text-dark", "text-light");
        if(panier !== null){
            toggleElementClasses(panier, "fond-dark", "fond-light", "text-dark", "text-light");
        }

        if(miniatures !== null){
            toggleCollectionClasses(miniatures, "fond-dark", "fond-light", "text-dark", "text-light");
            if(document.querySelectorAll("h4.nom") !== null)
                toggleCollectionClasses(document.querySelectorAll("h4.nom"), "fond-dark", "fond-light", "text-dark", "text-light");
        }
        if(entetes !== null && cellules !== null){
            toggleCollectionClasses(entetes, "fond-dark", "fond-light", "text-dark", "text-light");
            toggleCollectionClasses(cellules, "fond-dark", "fond-light", "text-dark", "text-light");
        }
        if(carte !== null){
            changerCouleurFond(carte, "fond-dark", "fond-light");
            changerCouleurTexte(carte, "text-dark", "text-light");
        }
        themeCourant = "LIGHT";
        source.innerHTML = "Passer au thème dark";
        animerBonhomme(animation2);

    }else{
        toggleElementClasses(body, "fond-light", "fond-dark", "text-light", "text-dark");
        if(panier !== null){
            toggleElementClasses(panier, "fond-light", "fond-dark", "text-light", "text-dark");
        }
        if(miniatures !== null){
            toggleCollectionClasses(miniatures, "fond-light", "fond-dark", "text-light", "text-dark");
            if(document.querySelectorAll("h4.nom") !== null)
                toggleCollectionClasses(document.querySelectorAll("h4.nom"), "fond-light", "fond-dark", "text-light", "text-dark");
        }
        if(entetes !== null && cellules !== null){
            toggleCollectionClasses(entetes, "fond-light", "fond-dark", "text-light", "text-dark");
            toggleCollectionClasses(cellules, "fond-light", "fond-dark", "text-light", "text-dark");
        } 

        if(carte !== null){
            changerCouleurFond(carte, "fond-light", "fond-dark");
            changerCouleurTexte(carte, "text-light", "text-dark");
        }
        themeCourant = "DARK";
        source.innerHTML = "Passer au thème light";
        animerBonhomme(animation1);
    }
    
}

function toggleElementClasses(element, fond1, fond2, texte1, texte2){
    element.classList.toggle(fond1);
    element.classList.toggle(fond2);
    element.classList.toggle(texte1);
    element.classList.toggle(texte2);
}
function toggleCollectionClasses(elements, fond1, fond2, texte1, texte2){
    for(var i = 0; i < elements.length; i++){
        toggleElementClasses(elements[i], fond1, fond2, texte1, texte2);
    }
}

function changerCouleurTexte(element, texte1, texte2){
    element.classList.toggle(texte1);
    element.classList.toggle(texte2);
}

function changerCouleurFond(element, fond1, fond2){
    element.classList.toggle(fond1);
    element.classList.toggle(fond2);
}


//Fonction pour afficher une image animée
function animerBonhomme(animation){
    var position = 0;
    const largeurPage = document.documentElement.scrollWidth;
    clearInterval(id);
    if(animation == animation1)
        animation2.style.display = "none";
    else
        animation1.style.display = "none";
    animation.style.display = "inline";
    id = setInterval(frame, 10);
    function frame() {
      if (position == largeurPage - animation.scrollWidth) 
        clearInterval(id);
      else{
        position ++; 
        animation.style.left = position + "px"; 
      }
    }
}
