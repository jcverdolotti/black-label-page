import React, {useState, useEffect} from 'react';
import axios from 'axios';
import {Link} from "react-router-dom";
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';
import Plataforma from './Plataforma';

const PlataformasPage = () => {
    const [plataformas, setPlataformas] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
          try {
            const response = await axios.get(`http://localhost:8000/plataformas`);
            setPlataformas(response.data); 
          } catch (error) {
            console.error(error);
          }
        }
        
        fetchData();   
    }, []);
       

    //console.log(plataformas);
    return (
            <div>
                <HeaderComponent />
                <NavBarComponent />
                <div className="boton-agregar">
                    <Link to="/plataformas/new"  id="button">AGREGAR PLATAFORMA</Link>
                </div>
                {plataformas.map(plataforma => <Plataforma key={plataforma.id} nombre={plataforma.nombre} id={plataforma.id}/>)}
                <FooterComponent />
            </div>
    );
};

export default PlataformasPage;