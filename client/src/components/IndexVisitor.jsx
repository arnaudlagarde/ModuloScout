// Pour les composants React, toujours commencer par importer la librairie afin d'utiliser toutes ses fonctionnalités :
import React from 'react';
import { Link } from 'react-router-dom';
import './IndexVisitor.css';
import ImgScout from '.././assets/logoScout.png'

function IndexVisitor() {
    return (
        <div className='IndexVisitor'>
            <h1>Bienvenue sur ModuloScout !</h1>
            <h2>Veuillez vous <a><Link to="/login">connecter</Link></a> pour accéder à votre espace.</h2>
        </div>
    );
}

// Pour utiliser ce composant à travers toute l'application, on va l'exporter (le rendre disponible) aux autres composants :
export default IndexVisitor;