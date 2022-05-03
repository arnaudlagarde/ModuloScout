## Modulo back

#### Quelques instructions propres à la config Docker utilisée (https://github.com/dunglas/symfony-docker/blob/main/README.md)

1. [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker-compose build --pull --no-cache` to build fresh images
3. Run `docker-compose up` (the logs will be displayed in the current shell)
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker-compose down --remove-orphans` to stop the Docker containers.

La mise en route peut demander pas mal de temps.

Il y a aussi un makefile (voir [ici](https://github.com/dunglas/symfony-docker/blob/main/docs/makefile.md)) qui offre quelques commandes utiles. Attention le `make start` refait un build complet avant de lancer le conteneur.

- Une fois le projet lancé, https://localhost devrait afficher le formulaire de connexion au back.
- Normalement un mailcatcher tourne, il devrait être accessible sur http://localhost:1080/

#### Créer un utilisateur

Vous pouvez créer un admin avec cette commande :

`docker-compose exec php bin/console app:user:create Nicolas Pineau H 123456789 ``adresse@mail.com`` -a`

H est juste le genre, 123456789 correspond au numéro d'adhérent qui doit être unique. L'option -a permet d'attribuer un mot de passe automatique.

L'utilisation de la commande doit normalement envoyer un mail que vous pouvez consulter dans mailcatcher, il vous donnera le mot de passe. Le login sera le numéro d'adhérent.

Si vous vous connectez via le formulaire vous arriverez sur la page d'accueil d'EasyAdmin, mais il n'y a rien pour le moment.

#### Fixtures

Les fixtures intégrées sont les tranches d'âge, les rôles, les structures, les scopes et les utilisateurs. Les utilisateurs sont tous créés avec le mot de passe "password".

#### API Platform

API platform fournit un swagger accessible à l'adresse https://localhost/api/docs. Vous pouvez l'utiliser pour tester vos endpoints. La connexion se fait avec l'endpoint "**POST **/api/auth-token". Sa configuration par défaut correspond à un utilisateur des fixtures, normalement elle fonctionne. Vous pouvez ensuite copier le token obtenu, cliquer sur le bouton "Authorize" en haut et le coller dans la zone de texte précédé du texte "Bearer ". Ensuite vous serez authentifié pour utiliser les autres endpoints depuis le swagger.

Les token doivent être signés. Il faut générer la clé privée et la clé publique comme expliqué [ici](https://api-platform.com/docs/core/jwt/) : 

```console
docker-compose exec php sh -c '
    set -e
    apk add openssl
    php bin/console lexik:jwt:generate-keypair
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
'
```



#### Exemple de connexion

Voici un exemple de code rapide pour se connecter à l'API inspiré de https://github.com/vlki/refresh-fetch. Il nécessite l'installation de 3 dépendances : `npm i lodash js-cookie refresh-fetch`. Je n'ai pas testé la partie rafraîchissement du token, mais je présume qu'elle fonctionne. Les dépendances proposées ne sont en aucun cas une nécessité, c'était pour gagner du temps. Il existe d'ailleurs peut-être des autres solutions meilleures que celle-ci. 



`lib/api.js`
-
```javascript
import { merge } from 'lodash'
import Cookies from 'js-cookie'
import { configureRefreshFetch, fetchJSON } from 'refresh-fetch'

const COOKIE_NAME = 'MODULO'

const retrieveToken = () => Cookies.get(COOKIE_NAME)
const saveToken = token => Cookies.set(COOKIE_NAME, token)
const clearToken = () => Cookies.remove(COOKIE_NAME)

const fetchJSONWithToken = (url, options = {}) => {
  const token = retrieveToken()

  let optionsWithToken = options
  if (token != null) {
    optionsWithToken = merge({}, options, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
  }

  return fetchJSON(url, optionsWithToken)
}

const login = (uuid, password) => {
  return fetchJSON('https://localhost/api/auth-token', {
    method: 'POST',
    body: JSON.stringify({
      uuid,
      password
    })
  })
    .then(response => {
      saveToken(response.body.token)
    })
}

const logout = () => {
  clearToken();
}

const shouldRefreshToken = error =>
  error.response.status === 401 &&
  error.body.message === 'Token has expired'

const refreshToken = () => {
  return fetchJSONWithToken('https://localhost/api/token/refresh', {
    method: 'POST'
  })
    .then(response => {
      saveToken(response.body.token)
    })
    .catch(error => {
      clearToken()
      throw error
    })
}

const fetch = configureRefreshFetch({
  fetch: fetchJSONWithToken,
  shouldRefreshToken,
  refreshToken
})

export {
  fetch,
  login,
  logout
}
```

`test.js`
-
```javascript
import { fetch, login } from './lib/api';

login('152269767', 'password')
  .then(() => { console.log('Logged in, token saved to cookie'); })
  .catch(error => { console.log('Login error', error); })

fetch('https://localhost/api/structures')
  .then(response => { console.log('Got the data!', response); })
  .catch(error => { console.log('Error getting data', error); })
```