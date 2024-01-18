import {useParams, useNavigate} from "react-router-dom";
import React from 'react';
import axios from 'axios';
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';

function DeletePage(props) {
	const params = useParams();
    const navigate = useNavigate();
    const id = params.id;
    const nombre = params.nombre;

	const deleteEndpoint = async () => {
        try {
            const response = await axios.delete("http://localhost:8000/plataformas/"+id);
            console.log(response.data);  
            if (response.status == 201) {
                alert(response.data);
                navigate("/plataformas"); 
            } else {
                alert(response.data);
                navigate("/plataformas"); 
            }  
        } catch (error) {
            console.log(error);
        }
    }

    function navigateToPlatforms(){
        alert("La plataforma "+nombre+" no se ha eliminado");
        window.location.href = "/plataformas";
      }

	return (
        <div>
            <HeaderComponent />
            <NavBarComponent />
                <div>
                    <p className='titulo-pages'> ELIMINAR PLATAFORMA </p>
                    <p className='parrafo-pages'> Esta seguro que desea eliminar la plataforma "{nombre}"?  
                    <button id="button-b" onClick={deleteEndpoint} > SI </button>
                    <button id="button-b" onClick={navigateToPlatforms} > NO </button>
                    </p>
                </div>
            <FooterComponent />
        </div>
		);
}

export default DeletePage;