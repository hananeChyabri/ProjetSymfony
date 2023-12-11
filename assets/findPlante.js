import './styles/findPlante.css';

// Axiox pour filtrer les plantes
// on obtient le formulaire pour
const form = document.getElementById('filtre-form-plante');
const urlDetailPlante = document.querySelector('.detaillePlante').dataset.route;
const urlAddFavorit = document.querySelector('.favorite-button').dataset.route;

// on detectera tous les inputs du form, peu importe quel fitre on change
form.addEventListener('change', function (event) {


    event.preventDefault();
    // obtenir le div pour afficher les résultats

    axios({
        // on prend la route generee avec path du data-route du form
        url: form.dataset.route,
        method: 'POST',
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        data: new FormData(document.getElementById("filtre-form-plante"))
    }).then(function (response) {




        // parcourir l'array d'objets reçu (car le JSON a été déjà parsé par AXIOS)
        let arrayPlantes = response.data;

        genererPlantes(arrayPlantes);



    }).catch(error => {
        console.error(error);
    });
});



/*fonction pour générer les plantes sur la page*/

function genererPlantes(arrayPlantes) {


    let container = document.querySelector('.plante'); // le conteneur de plantes

    container.innerHTML = "";

    // Parcourir la liste de plantes
    arrayPlantes.forEach(function (plante) {


        let cardcontainerDiv = document.createElement('div');
        cardcontainerDiv.className = 'cardcontainer border mb-4';

        var photoDiv = document.createElement('div');
        photoDiv.className = 'photo';
        var a = document.createElement('a');
        a.href = urlDetailPlante.substring(0, urlDetailPlante.length - 1) + plante.id;
        a.className = 'detaillePlante cat-img position-relative overflow-hidden mb-3';

        var img = document.createElement('img');

        img.src = "/" + plante.images[0];
        // img.src = "/project1/public/" + plante.images[0];

        a.appendChild(img);
        photoDiv.appendChild(a);
        //});

        var photosDiv = document.createElement('div');
        photosDiv.className = 'nomPlante';
        photosDiv.textContent = plante.nom;

        var contentDiv = document.createElement('div');
        contentDiv.className = 'content';

        var txt4Exposition = document.createElement('p');
        txt4Exposition.className = 'txt4';
        txt4Exposition.textContent = 'exposition: ' + plante.exposition;

        var txt4BesoinEau = document.createElement('p');
        txt4BesoinEau.className = 'txt4';
        txt4BesoinEau.textContent = 'besoin Eau: ' + plante.besoinEau;

        var txt4NiveauSoin = document.createElement('p');
        txt4NiveauSoin.className = 'txt4';
        txt4NiveauSoin.textContent = 'niveau Soin: ' + plante.niveauSoin;

        var footerDiv = document.createElement('div');
        footerDiv.className = 'footer';


        let paralikebutton = document.createElement('p');
        // Créez un nouvel élément span poyr le prix de la plante
        var spanPrix = document.createElement('span');

        // Ajoutez les classes au nouvel élément
        spanPrix.classList.add('waves-effect', 'waves-light', 'btnPrice');

        // Définissez le contenu texte de l'élément
        spanPrix.textContent = '123 $';

        // Ajoutez l'élément au document (par exemple, au corps du document)
        paralikebutton.appendChild(spanPrix);

        let favoriteButtonLink = document.createElement('a');
        favoriteButtonLink.className = 'favorite-button like'

        favoriteButtonLink.setAttribute('data-route', urlAddFavorit);
        favoriteButtonLink.setAttribute('data-id', plante.id);
        favoriteButtonLink.id = 'heart';

        favoriteButtonLink.addEventListener("click", AjouterListFavoris);



        // afficher en fonction de si la plante a ete like
        var gratipayIcon = document.createElement('i');
        gratipayIcon.className = 'fab fa-gratipay';
        if (plante.like) {

            gratipayIcon.classList.add("fa-gratipay-like");
        }

        favoriteButtonLink.appendChild(gratipayIcon);
        paralikebutton.appendChild(favoriteButtonLink);

        let buttonAcheterParagraph = document.createElement('p');

        let buyButton = document.createElement('button');
        buyButton.classList.add('btnAddCart');
        buyButton.textContent = 'Acheter';

        // Créez une icône de panier
        var cartIcon = document.createElement('i');
        cartIcon.classList.add('fas', 'fa-shopping-cart', 'text-primary');

        // Ajoutez l'icône au bouton d'achat
        buyButton.appendChild(cartIcon);
        buttonAcheterParagraph.appendChild(buyButton);

        footerDiv.appendChild(paralikebutton);
        footerDiv.appendChild(buttonAcheterParagraph);

        contentDiv.appendChild(txt4Exposition);
        contentDiv.appendChild(txt4BesoinEau);
        contentDiv.appendChild(txt4NiveauSoin);

        cardcontainerDiv.appendChild(photoDiv);
        cardcontainerDiv.appendChild(contentDiv);
        cardcontainerDiv.appendChild(footerDiv);
        container.appendChild(cardcontainerDiv);

    });
}

// Axios pour ajouter au liste de souhait
const boutons = document.querySelectorAll('.favorite-button');
// Parcourez la liste des boutons et ajoutez un écouteur d'événements à chacun
boutons.forEach(function (bouton) {
    bouton.addEventListener("click", AjouterListFavoris);
});
function AjouterListFavoris(event) {
    event.preventDefault();
    let fovorits = document.getElementById("favorite_list");

    const planteId = event.target.parentElement.dataset.id;

    // on prend la route generee avec path du data-route du form
    let formLike = new FormData();
    formLike.append("id", planteId);


    axios.post(event.target.parentElement.dataset.route, formLike, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
    }).then(function (response) { // Gérez la réponse du serveur (par exemple, actualisez l'interface utilisateur)

        // on rajoute la plante
        if (response.data.rajoute) {
            fovorits.innerText = +fovorits.innerText + 1;
            var heartElement = event.target.parentElement.querySelector('.like .fab.fa-gratipay');

            heartElement.classList.add("fa-gratipay-like");
            console.log('rajoute');
        }
        // on enleve la plante
        else {
            fovorits.innerText = +fovorits.innerText - 1;
            var heartElement = event.target.parentElement.querySelector('.like .fab.fa-gratipay');

            heartElement.classList.remove("fa-gratipay-like");
            heartElement.classList.remove("fa-gratipay-like");
            console.log('enleve');

        }

    }).catch(function (error) {

        if (error.response) {
            if (error.response.status === 404) {
                alert(error.response.data.message);
            }
        }

    });




}

/*Axios pour afficher les plantes favories*/
let bouton_favorits = document.getElementById('favorite_list_button');
bouton_favorits.addEventListener('click', function (event) {
    event.preventDefault();
    // obtenir le div pour afficher les résultats

    axios({
        // on prend la route generee avec path du data-route du form
        url: bouton_favorits.dataset.route,
        method: 'POST',
        headers: {
            'Content-Type': 'multipart/form-data'
        },
        data: new FormData()
    }).then(function (response) {


        if (response.status === 404) {
            // L'utilisateur n'est pas connecté, affichez un message d'erreur ou redirigez-le vers la page de connexion
            console.log('Erreur : L\'utilisateur n\'est pas connecté');
        }
        else {
            let arrayPlantes = response.data;

            genererPlantes(arrayPlantes);
        }


    }).catch(error => {
        console.error(error);
    });
});


/* axiox pour la recherche*/
let inputRecherche = document.querySelector('.inputRecherche');
inputRecherche.addEventListener("input", RecherchePlante);
function RecherchePlante(event) {
    event.preventDefault();
    let formLike = new FormData();
    formLike.append("nom", inputRecherche.value);
    axios.post(inputRecherche.dataset.route, formLike, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
    }).then(function (response) { // Gérez la réponse du serveur (par exemple, actualisez l'interface utilisateur)

        // parcourir l'array d'objets reçu (car le JSON a été déjà parsé par AXIOS)
        let arrayPlantes = response.data;

        genererPlantes(arrayPlantes);


    }).catch(function (error) {

        if (error.response) {

            alert(error.response.data.message);

        }

    });


}


/* Ajouter au panier */
let btnsAddCart = document.querySelectorAll('.btnAddCart');
btnsAddCart.forEach(function (bouton) {
    bouton.addEventListener("click", AjouterPanier);
});
function AjouterPanier(event) {
   
    event.preventDefault();
    let paniers = document.getElementById("panier_list");

    const planteId = event.target.dataset.id;

    // on prend la route generee avec path du data-route du form
    let formLike = new FormData();
    formLike.append("id", planteId);
    axios.post(event.target.dataset.route, formLike, {
        headers: {
            'Content-Type': 'multipart/form-data'
        },
    }).then(function (response) { // Gérez la réponse du serveur (par exemple, actualisez l'interface utilisateur)
      
        // on rajoute la plante
        if (response.data.rajoute) {
            paniers.innerText = +paniers.innerText + 1;
            alert("l article est bien ajoute au panier");
        }
        // on enleve la plante
        else {
       
            console.log('probleme');

        }

    }).catch(function (error) {

        if (error.response) {
            if (error.response.status === 404) {
                alert(error.response.data.message);
            }
        }

    });

}


