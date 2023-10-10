import './styles/findPlante.css';





// Axiox pour filtrer les plantes
// on obtient le formulaire pour
const form = document.getElementById('filtre-form-plante');

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

        genererPlante(arrayPlantes);



    }).catch(error => {
        console.error(error);
    });
});


// Axios pour ajouter au liste de souhait
let boutons = document.querySelectorAll('.favorite-button');

// Parcourez la liste des boutons et ajoutez un écouteur d'événements à chacun
boutons.forEach(function (bouton) {
    bouton.addEventListener('click', function (event) {


        event.preventDefault();
        let fovorits = document.getElementById("favorite_list");
        fovorits.innerText = +fovorits.innerText + 1;
        const planteId = bouton.dataset.id;
console.log(planteId);
        // on prend la route generee avec path du data-route du form
        let formLike = new FormData();
        formLike.append("id",planteId);
        axios.post( bouton.dataset.route,formLike,{
        headers: {
            'Content-Type': 'multipart/form-data'
        },
    }).then(function (response) { // Gérez la réponse du serveur (par exemple, actualisez l'interface utilisateur)
        if (response.data.success) {
   
            console.log('Like réussi');
        }
        }).catch(function (error) {
            console.error('Une erreur s\'est produite lors de l\'ajout à la liste de souhaits', error);
        });


    });
});






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
        else
        {
        let arrayPlantes = response.data;

        genererPlante(arrayPlantes);}


    }).catch(error => {
        console.error(error);
    });
});









/*fonction pour générer les plantes sur la page*/

function genererPlante(arrayPlantes) {
    let sectionPlante = document.querySelector(".fiches");

    // parcourir l'array d'objets reçu (car le JSON a été déjà parsé par AXIOS)
    sectionPlante.innerHTML = "";
    arrayPlantes.forEach(function (plante) { // manipuler le DOM. Ex: vider un div et le remplir avec les résultats
        console.log(plante);
        const planteElement = document.createElement("article");



        const imagePlante = document.createElement("img");
        // image de la plante
        plante.images.forEach(function (url) {
            imagePlante.src = "/" + url;
        });
        // nom de la plante
        const nomPlante = document.createElement("P");
        nomPlante.innerText = plante.nom;

        sectionPlante.appendChild(planteElement);


        planteElement.appendChild(nomPlante);
        planteElement.appendChild(imagePlante);


    });

}



