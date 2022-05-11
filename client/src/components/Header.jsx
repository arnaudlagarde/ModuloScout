// Pour les composants React, toujours commencer par importer la librairie afin d'utiliser toutes ses fonctionnalités :
import React from 'react';
import './Header.css';
import { NavLink } from 'react-router-dom';
import ImgScout from '.././assets/logoScout.png'
import { render } from "react-dom";

// get our fontawesome imports
import { faCircleUser } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

function Header() {
    return (
        <div className='Header'>
            <nav class="navbar navbar-expand-lg navbar-light">
                <NavLink className="nav-link" to="/"><img className="Header-logo" src={ImgScout} alt="logo" /></NavLink>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Agenda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Documents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Messagerie</a>
                        </li>
                        <li class="nav-item">
                            <NavLink className="nav-link" to="/login">Connexion</NavLink>
                        </li>
                        <li class="nav-item">
                            <NavLink className="nav-link" to="/register">Inscription</NavLink>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    );
}

// Pour utiliser ce composant à travers toute l'application, on va l'exporter (le rendre disponible) aux autres composants :
export default Header;