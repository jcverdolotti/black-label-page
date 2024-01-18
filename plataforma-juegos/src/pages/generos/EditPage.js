import React, {useState, useEffect } from 'react';
import { useParams , useNavigate} from 'react-router-dom';
import axios from 'axios';
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';

const EditPage = (props) => {
    const params = useParams();
    const navigate = useNavigate();
    const [generos, setGeneros] = useState();
    const id = params.id;
    
    

    const putEndpoint = async (event) => {
        try {
            //validar que no este vacio generos
            event.preventDefault();
            if(generos && generos.length > 0){
                
                const response = await axios.put("http://localhost:8000/generos/"+id, {nombre:generos});
                console.log(response.data);  
                if (response.status == 201) {
                    alert(response.data);
                    navigate("/generos");
                } else {
                    alert(response.data);
                    navigate("/generos");
                }  
            } else {
                alert('Debe escribir el campo nombre de género');
            }  
        } catch (error) {
            console.log(error);
        }
    }


    return (
            <div>
                <HeaderComponent />
                <NavBarComponent />
                <p className='titulo-pages'> EDITAR GENERO </p>
                <form id="frm1" className="formulario">	
                <p className='parrafo-pages'> Nombre de Género 
                    <input type="text" className="inputs" id="nombre" name="nombre" onChange={(e)=>{setGeneros(e.target.value)}}></input>
                    <button id="button" onClick={putEndpoint} > ACTUALIZAR </button>
                </p>
                </form>	
                <FooterComponent />
            </div>
    );
};

export default EditPage;