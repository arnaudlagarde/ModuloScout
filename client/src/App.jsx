import React from 'react';
import './App.css';
import { HashRouter, Route, Switch } from 'react-router-dom';
import Header from './components/Header';
import IndexVisitor from './components/IndexVisitor';
import Login from './components/Login';
import ForgotPassword from './components/ForgotPassword';
import Footer from './components/Footer';
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  return (
    <div>
      <HashRouter>
        <div>
        <Header />
        <Switch>
          <Route exact path="/" component={IndexVisitor} />
          <Route exact path="/login" component={Login} />
          <Route exact path="/forgotpassword" component={ForgotPassword} />
        </Switch>
        <Footer />
        </div>
      </HashRouter>
    </div>
  );
}

export default App;
