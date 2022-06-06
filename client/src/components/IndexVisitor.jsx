// Pour les composants React, toujours commencer par importer la librairie afin d'utiliser toutes ses fonctionnalités :
import React from 'react';
import './IndexVisitor.css';
import ImgScout from '.././assets/logoScout.png'

function IndexVisitor() {
    return (
        <div className='IndexVisitor'>
            <h1>Bienvenue sur ModuloScout !</h1>
            <h2>Veuillez vous connecter pour accéder à votre espace.</h2>
            <h3>Pas encore de compte ? S'inscrire</h3>
        </div>
    );
}

// Pour utiliser ce composant à travers toute l'application, on va l'exporter (le rendre disponible) aux autres composants :
export default IndexVisitor;