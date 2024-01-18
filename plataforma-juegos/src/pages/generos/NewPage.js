import React, {useState, useEffect} from 'react';
import axios from 'axios';
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';
import { useNavigate } from "react-router-dom";

const NewPage = () => {
    const [generos, setGeneros] = useState();
    const navigate = useNavigate();

    const postEndpoint = async (event) => {
        try {
            //validar que no este vacio generos
            event.preventDefault();
            if(generos && generos.length > 0){
                const response = await axios.post('http://localhost:8000/generos', {nombre:generos});
                //alert si se creo correctamente
                if(response.status == 201) {
                    alert(response.data);
                    //window.location.href = "/generos";
                    navigate("/generos");
                    //averiguar navegation o link, para que nos mande a /generos despues de la alerta
                } else {
                    alert(response.data);
                }
            } else {
                alert('Debe escribir el campo nombre de género');
            }  
            console.log(generos);
        } catch (error) {
            console.log(error);
        }
    }
    
    
    return (
            <div>
                <HeaderComponent />
                <NavBarComponent />
                <p className='titulo-pages'> CREAR NUEVO GENERO </p>
                <form id="frm1" className="formulario">	
                <p className='parrafo-pages'> Nombre de Género 
                    <input type="text" className="inputs" id="nombre" name="nombre" onChange={(e)=>{setGeneros(e.target.value)}}></input>
                    <button id="button" onClick={postEndpoint} > AGREGAR </button>
                </p>
                </form>	
				
                <FooterComponent />
            </div>
    );
};

export default NewPage;