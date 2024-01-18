import React, {useState, useEffect} from 'react';
import axios from 'axios';
import {Link} from "react-router-dom";
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';
import Genero from './Genero';

const GenerosPage = () => {
    const [generos, setGeneros] = useState([]);

    useEffect(() => {
        const fetchData = async () => {
          try {
            const response = await axios.get(`http://localhost:8000/generos`);
            setGeneros(response.data); 
          } catch (error) {
            console.error(error);
          }
        }
        
        fetchData();   
    }, []);
       

    //console.log(generos);
    return (
            <div>
                <HeaderComponent />
                <NavBarComponent />
                <div className="boton-agregar">
                    <Link to="/generos/new"  id="button">AGREGAR GÉNERO</Link>
                </div>
                {generos.map(genero => <Genero key={genero.id} nombre={genero.nombre} id={genero.id}/>)}
                <FooterComponent />
            </div>
    );
};

export default GenerosPage;