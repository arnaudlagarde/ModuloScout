// Pour les composants React, toujours commencer par importer la librairie afin d'utiliser toutes ses fonctionnalités :
import React from 'react';
import './ChoosePassword.css';

function ChoosePassword() {
    return (
        <div class="container">
            <div className='ChoosePasswordForm'>
                <div className='choose'>
                    <h1>Nouveau mot de passe</h1>
                    <p>
                        Choisissez votre nouveau mot de passe<br/>
                        et tapez-le une seconde fois pour confirmer.
                    </p>
                </div>
                <form>
                    <div class="form-outline">
                        <label class="form-label" for="form2Example2">Nouveau mot de passe</label>
                        <input type="password" id="form2Example2" class="form-control" />
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="form2Example2">Confirmation nouveau mot de passe</label>
                        <input type="password" id="form2Example2" class="form-control" />
                    </div>

                    <button type="button" class="btn btn-primary btn-block mb-4">Confirmer</button>

                    </form>
            </div>
        </div>
    );
}

// Pour utiliser ce composant à travers toute l'application, on va l'exporter (le rendre disponible) aux autres composants :
export default ChoosePassword;