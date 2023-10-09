import './styles/findPlante.css';

alert("ggg");



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


        let sectionPlante = document.querySelector(".fiches");

        // parcourir l'array d'objets reçu (car le JSON a été déjà parsé par AXIOS)
        let arrayPlantes = response.data;

        console.log(arrayPlantes);


        sectionPlante.innerHTML = "";


        arrayPlantes.forEach(function (plante) { // manipuler le DOM. Ex: vider un div et le remplir avec les résultats
            console.log(plante);
            const planteElement = document.createElement("article");

            // nom de la plante
            const nomPlante = document.createElement("P");
            nomPlante.innerText = plante.nom + " " + plante.exposition + "   " + plante.besoinEau + "   " + plante.lieuCultive;

            const imagePlante = document.createElement("img");
            // image de la plante
            plante.images.forEach(function (url) {
                imagePlante.src = "/" + url;
            });


            sectionPlante.appendChild(planteElement);

            planteElement.appendChild(imagePlante);
            planteElement.appendChild(nomPlante);


        });


    }).catch(error => {
        console.error(error);
    });
});


// Axiox pour ajouter au liste de souhait
var boutons = document.querySelectorAll('.add_wish_list');

// Parcourez la liste des boutons et ajoutez un écouteur d'événements à chacun
boutons.forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        // Code à exécuter lorsque le bouton est cliqué
        console.log("Bouton cliqué !");

        event.preventDefault();
        const planteId = event.target.getAttribute('data-id');

        // Envoyez une requête Axios pour ajouter la plante à la liste de souhaits
        axios.post(`/plante/listSouhait/${planteId}`).then(function (response) { // Gérez la réponse du serveur (par exemple, actualisez l'interface utilisateur)
            console.log(response);
        }).catch(function (error) {
            console.error('Une erreur s\'est produite lors de l\'ajout à la liste de souhaits', error);
        });


    });
});
