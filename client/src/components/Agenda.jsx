// Pour les composants React, toujours commencer par importer la librairie afin d'utiliser toutes ses fonctionnalités :
import React, { useState, useContext, useEffect } from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import { getMonth } from "../util";
import CalendarHeader from "./CalendarHeader";
import Sidebar from "./Sidebar";
import Month from "./Month";
import GlobalContext from "../context/GlobalContext";
import EventModal from "./EventModal";

function Agenda() {

    const [currenMonth, setCurrentMonth] = useState(getMonth());
    const { monthIndex, showEventModal } = useContext(GlobalContext);
  
    useEffect(() => {
      setCurrentMonth(getMonth(monthIndex));
    }, [monthIndex]);

    return (
        <React.Fragment>
      {showEventModal && <EventModal />}

      <div className="h-screen flex flex-col">
        <CalendarHeader />
        <div className="flex flex-1">
          <Sidebar />
          <Month month={currenMonth} />
        </div>
      </div>
    </React.Fragment>
    );
}

// Pour utiliser ce composant à travers toute l'application, on va l'exporter (le rendre disponible) aux autres composants :
export default Agenda;