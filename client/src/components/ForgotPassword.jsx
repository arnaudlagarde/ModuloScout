// Pour les composants React, toujours commencer par importer la librairie afin d'utiliser toutes ses fonctionnalités :
import React from 'react';
import './ForgotPassword.css';

function ForgotPassword() {
    return (
        <div class="container">
            <div className='ForgotPasswordForm'>
                <div className='forget'>
                    <h1>Mot de passe oublié ?</h1>
                    <p>
                        Si l'adresse mail saisie correspond à un compte existant, <br/>
                        vous allez recevoir un email pour réinitialiser votre mot de passe.
                    </p>
                </div>
                <form>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Adresse mail</label>
                        <input type="email" id="form2Example1" class="form-control" />
                    </div>

                    <button type="button" class="btn btn-primary btn-block mb-4">Confirmer</button>

                    </form>
            </div>
        </div>
    );
}

// Pour utiliser ce composant à travers toute l'application, on va l'exporter (le rendre disponible) aux autres composants :
export default ForgotPassword;