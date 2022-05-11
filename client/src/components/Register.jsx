// Pour les composants React, toujours commencer par importer la librairie afin d'utiliser toutes ses fonctionnalités :
import React from 'react';
import './Register.css';
import 'bootstrap/dist/css/bootstrap.min.css';

function Register() {
    return (
        <div class="container-fluid">
            <div className='LoginForm'>
                <div className='welcome'>
                    <h1>Bienvenue sur ModuloScout !</h1>
                    <h2>Veuillez vous connecter afin d'accéder à votre espace.</h2>
                </div>
                <form>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">N° adhérent</label>
                        <input type="email" id="form2Example1" class="form-control" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Mot de passe</label>
                        <input type="password" id="form2Example2" class="form-control" />
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <a href="#!">Mot de passe oublié ?</a>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-block mb-4">Connexion</button>

                    <div class="text-center">
                        <p>Vous n'êtes pas membre ? <a href="./Register.jsx">S'inscrire</a></p>
                    </div>
                    </form>
            </div>
        </div>
    );
}

// Pour utiliser ce composant à travers toute l'application, on va l'exporter (le rendre disponible) aux autres composants :
export default Register;