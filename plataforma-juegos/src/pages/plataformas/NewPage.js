import React, {useState, useEffect} from 'react';
import axios from 'axios';
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';
import { useNavigate } from "react-router-dom";

const NewPage = () => {
    const [plataformas, setPlataformas] = useState();
    const navigate = useNavigate();

    const postEndpoint = async (event) => {
        try {
            event.preventDefault();
            //validar que no este vacio plataformas
            if(plataformas && plataformas.length > 0){
                const response = await axios.post('http://localhost:8000/plataformas', {nombre:plataformas});
                //alert si se creo correctamente
                if(response.status == 201) {
                    alert(response.data);
                    navigate("/plataformas");
                } else {
                    alert(response.data);
                }
            } else {
                alert('Debe escribir el campo nombre de plataforma');
            }  
            console.log(plataformas);
        } catch (error) {
            console.log(error);
        }
    }
    
    
    return (
            <div>
                <HeaderComponent />
                <NavBarComponent />
                <p className='titulo-pages'> CREAR NUEVA PLATAFORMA </p>
                <form id="frm1" className="formulario">	
                <p className='parrafo-pages'> Nombre de Plataforma 
                    <input type="text" className="inputs" id="nombre" name="nombre" onChange={(e)=>{setPlataformas(e.target.value)}}></input>
                    <button id="button" onClick={postEndpoint} > AGREGAR </button>
                </p>
                </form>	
				
                <FooterComponent />
            </div>
    );
};

export default NewPage;