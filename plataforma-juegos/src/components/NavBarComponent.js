import React from 'react';
import {Link} from "react-router-dom";
import DashboardPage from '../pages/dashboard/DashboardPage';
import GenerosPage from '../pages/generos/GenerosPage';
import PlataformasPage from '../pages/plataformas/PlataformasPage';

function NavBarComponent(){
    return (
        <nav className="navCabecera">
			<Link to="/" className="nav-link">INICIO</Link>
            <Link to="/generos" className="nav-link">GÉNEROS</Link>
            <Link to="/plataformas" className="nav-link">PLATAFORMAS</Link>
		</nav>
    );
}


export default NavBarComponent;