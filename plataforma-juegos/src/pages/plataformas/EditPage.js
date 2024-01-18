import React, {useState, useEffect } from 'react';
import { useParams , useNavigate} from 'react-router-dom';
import axios from 'axios';
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';

const EditPage = (props) => {
    const params = useParams();
    const navigate = useNavigate();
    const [plataformas, setPlataformas] = useState();
    const id = params.id;
    

    const putEndpoint = async (event) => {
        try {
            event.preventDefault();
            //validar que no este vacio generos
            if(plataformas && plataformas.length > 0){        
                const response = await axios.put("http://localhost:8000/plataformas/"+id, {nombre:plataformas});
                console.log(response.data);  
                if (response.status == 201) {
                    alert(response.data);
                    navigate("/plataformas");
                } else {
                    alert(response.data);
                    navigate("/plataformas");
                }  
            } else {
                alert('Debe escribir el campo nombre de plataforma');
            }  
        } catch (error) {
            console.log(error);
        }
    }


    return (
            <div>
                <HeaderComponent />
                <NavBarComponent />
                <p className='titulo-pages'> EDITAR PLATAFORMA </p>
                <form id="frm1" className="formulario">	
                <p className='parrafo-pages'> Nombre de Plataforma
                    <input type="text" className="inputs" id="nombre" name="nombre" onChange={(e)=>{setPlataformas(e.target.value)}}></input>
                    <button id="button" onClick={putEndpoint} > ACTUALIZAR </button>
                </p>
                </form>	
                <FooterComponent />
            </div>
    );
};

export default EditPage;