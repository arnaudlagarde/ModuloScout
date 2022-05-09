// Pour les composants React, toujours commencer par importer la librairie afin d'utiliser toutes ses fonctionnalités :
import React from 'react';
import './Footer.css';

function Footer() {
    return (
        <div className='Footer'>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Aide</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mentions légales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Gestion des cookies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">À propos</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    );
}

// Pour utiliser ce composant à travers toute l'application, on va l'exporter (le rendre disponible) aux autres composants :
export default Footer;